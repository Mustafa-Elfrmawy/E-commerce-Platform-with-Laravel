<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\HelperFront\Helpers;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $url = array_values(array_filter(explode('/', $_SERVER['REQUEST_URI'] ?? '/')));
        if (isset($url[0]) && $url[0] === 'home' && $_SERVER['REQUEST_METHOD'] === 'GET') :
            
            $helper = new Helpers();
            $data = $helper->getData();
            $page = $url[1] ?? null;
            
            $categoryId = isset($url[2]) && is_numeric($url[2]) ? (int)$url[2] : null;
            $subCategoryId = isset($url[3]) && is_numeric($url[3]) ? (int)$url[3] : null;
            
            switch ($page):
                case 'shop':
                    if ($categoryId && !$subCategoryId) {
                        $data->products = $data->products->where('category_id', $categoryId)->paginate(6);
                    } elseif ($categoryId && $subCategoryId) {
                        $data->products = $data->products->where('sub_category_id', $subCategoryId)->paginate(6);
                    } else {
                        $data->products = $data->products->paginate(6);
                    }
                    break;

                default:
                    $data->products = $data->products->latest()->get();
                    break;

            endswitch;

            View::share([
                'categories' => $data->categories,
                'sub_categories' => $data->sub_categories,
                'brands' => $data->brands,
                'products' => $data->products,
                'products_latest' => $data->products_latest,
            ]);
        endif;
    }
}
