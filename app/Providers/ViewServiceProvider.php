<?php

namespace App\Providers;

use App\Models\Product;
use App\HelperFront\Helpers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            return;
        }

        $urlSegments = $this->getUrlSegments();

        if (!$this->isHomeRoute($urlSegments) || $this->isInvalidMethod()) {
            return;
        }

        $page = $urlSegments[1] ?? null;
        if (!$this->isAllowedPage($page, $urlSegments[0])) {
            $this->abortNotFound();
        }

        $helper = new Helpers();
        $data = $helper->getData();

        list($categoryId, $subCategoryId, $brandId, $minPrice, $maxPrice, $operator) =
            $this->parseFilters($urlSegments);

        if ($page === 'shop') {
            $this->applyShopFilters($data, $categoryId, $subCategoryId, $brandId, $minPrice, $maxPrice, $operator);
        } else {
            $data->products = $this->getFeaturedProducts();
        }

        $this->shareViewData($data);
    }

    protected function getUrlSegments(): array
    {
        $path = parse_url(request()->path() ?? '/', PHP_URL_PATH);
        return array_values(array_filter(explode('/', $path), fn($v) => $v !== ''));
    }

    protected function isHomeRoute(array $segments): bool
    {
        return isset($segments[0]) && $segments[0] === 'home';
    }

    protected function isInvalidMethod(): bool
    {
        return $_SERVER['REQUEST_METHOD'] !== 'GET';
    }

    protected function isAllowedPage(?string $page, string $default): bool
    {
        $allowed = ['shop', 'home', 'something-else'];
        if ($page && in_array($page, $allowed)) {
            return true;
        }
        return in_array($default, $allowed);
    }

    protected function abortNotFound(): void
    {
        echo "404 Not Found";
        exit;
    }

    /**
     * @return array [categoryId, subCategoryId, brandId, minPrice, maxPrice, operator]
     */
    protected function parseFilters(array $segments): array
    {
        $categoryId   = isset($segments[2]) && is_numeric($segments[2]) ? (int)$segments[2] : null;
        $subCategoryId = isset($segments[3]) && is_numeric($segments[3]) ? (int)$segments[3] : null;
        $brandId      = isset($segments[4]) && is_numeric($segments[4]) ? (int)$segments[4] : null;
        $minPrice     = isset($segments[5]) && is_numeric($segments[5]) ? (int)$segments[5] : null;
        $maxPrice     = null;
        $operator     = null;

        if (isset($segments[6])) {
            if (is_numeric($segments[6])) {
                $maxPrice = (int)$segments[6];
            } elseif ($segments[6] === '+') {
                $maxPrice = 10000000000;
                $operator = '>=';
            }
        }

        return [$categoryId, $subCategoryId, $brandId, $minPrice, $maxPrice, $operator];
    }

    protected function applyShopFilters($data, $categoryId, $subCategoryId, $brandId, $minPrice, $maxPrice, $operator): void
    {
        if ($categoryId && !$subCategoryId) {
            $data->products = $data->products->where('category_id', $categoryId)->paginate(6);
        } elseif ($categoryId && $subCategoryId && !$brandId) {
            $data->products = $data->products->where('sub_category_id', $subCategoryId)->paginate(6);
        } elseif ($categoryId && $subCategoryId && $brandId && !$minPrice && !$maxPrice && !$operator) {
            $data->products = $data->products->where('brand_id', $brandId)->paginate(6);
        } elseif ($categoryId && $subCategoryId && $brandId && $minPrice > -1 && $maxPrice && !$operator) {
            $data->products = $data->products->whereBetween('price', [$minPrice, $maxPrice])->paginate(6);
        } elseif ($categoryId && $subCategoryId && $brandId && $minPrice > -1 && $maxPrice && $operator) {
            $data->products = $data->products->where('price', $operator, $minPrice)->paginate(6);
        } else {
            $data->products = $data->products->paginate(6);
        }
    }

    protected function getFeaturedProducts()
    {
        return Product::where('showhome', 'yes')
            ->where('is_featured', 'yes')
            ->where('status', 1)
            ->get();
    }

    protected function shareViewData($data): void
    {
        View::share([
            'categories'      => $data->categories,
            'sub_categories'  => $data->sub_categories,
            'brands'          => $data->brands,
            'products'        => $data->products,
            'products_latest' => $data->products_latest,
        ]);
    }
}
