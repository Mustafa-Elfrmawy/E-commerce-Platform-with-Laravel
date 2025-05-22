<?php

namespace App\HelperFront;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;

class Helpers
{
    protected $categories;
    protected $sub_categories;
    protected $brands;
    protected $products;
    protected $products_latest;



    /**
     * Load data from the database and store in properties
     */
    protected function loadData()
    {
        $this->categories = Category::where('showhome', 'yes')->where('status', 1)->latest()->get();
        $this->sub_categories = SubCategory::where('showhome', 'yes')->where('status', 1)->latest()->get();
        $this->brands = Brand::where([['showhome', 'yes'],  ['status', 1]])->latest()->get();
        $this->products = Product::query()
            ->where('showhome', 'yes')
            ->where('is_featured', 'yes')
            ->where('status', 1);
        $this->products_latest = Product::where([['showhome', 'yes'], ['is_featured', 'no'], ['status', 1]])->latest()->get();
    }

    /**
     * Get all data as an object
     *
     * @return object
     */

    public function getData(): object
    {
        if (is_null($this->categories)) {
            $this->loadData();
        }
        return (object)[
            'categories' => $this->categories,
            'sub_categories' => $this->sub_categories,
            'brands' => $this->brands,
            'products' => $this->products,
            'products_latest' => $this->products_latest,
        ];
    }
}
