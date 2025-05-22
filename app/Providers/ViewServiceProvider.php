<?php

namespace App\Providers;

use App\Models\Product;
use App\HelperFront\Helpers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $uri = request()->path() ?? '/';
        $path = parse_url($uri, PHP_URL_PATH);
        $url = array_values(array_filter(explode('/', $path)));
        if (isset($url[0]) && $url[0] === 'home' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $allowedPages = ['shop', 'home', 'something-else'];
            $page = $url[1] ?? null;
            
            if (!in_array($page, $allowedPages) && !in_array($url[0], $allowedPages) ) :
                echo "404 Not Found";
                exit;
            endif;
            $helper = new Helpers();
            $data = $helper->getData();

            $categoryId = isset($url[2]) && is_numeric($url[2]) ? (int)$url[2] : null;
            $subCategoryId = isset($url[3]) && is_numeric($url[3]) ? (int)$url[3] : null;
            $brandId = isset($url[4]) && is_numeric($url[4]) ? (int)$url[4] : null;


            switch ($page):
                case 'shop':
                    if ($categoryId && !$subCategoryId) {
                        $data->products = $data->products->where('category_id', $categoryId)->paginate(6);
                    } elseif ($categoryId && $subCategoryId && !$brandId) {
                        $data->products = $data->products->where('sub_category_id', $subCategoryId)->paginate(6);
                        /* use */
                    } elseif ($categoryId && $subCategoryId && $brandId) {
                        $data->products = $data->products->where('brand_id', $brandId)->paginate(6);
                    } else {
                        $data->products = $data->products->paginate(2);
                    }
                    break;

                default:
                    $data->products = Product::where('showhome', 'yes')
                        ->where('is_featured', 'yes')
                        ->where('status', 1)->get();
                    break;
            endswitch;


            View::share([
                'categories' => $data->categories,
                'sub_categories' => $data->sub_categories,
                'brands' => $data->brands,
                'products' => $data->products,
                'products_latest' => $data->products_latest,
            ]);
        }
    }
}
