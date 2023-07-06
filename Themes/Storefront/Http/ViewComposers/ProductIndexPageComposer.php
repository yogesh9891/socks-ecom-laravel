<?php

namespace Themes\Storefront\Http\ViewComposers;

use Modules\Support\Money;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;

class ProductIndexPageComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose($view)
    {
        $view->with([
            'categories' => $this->categories(),
            'maxPrice' => $this->maxPrice(),
            'latestProducts' => $this->latestProducts(),
        ]);
    }

    private function categories()
    {
        return Category::tree();
    }

    private function maxPrice()
    {
        return Money::inDefaultCurrency(Product::max('selling_price'))
            ->convertToCurrentCurrency()
            ->ceil()
            ->amount();
    }

    private function latestProducts()
    {
        $products = Product::forCard()->take(5)->latest()->get()->where('parent_id',null)->map->clean();
         $products = $products->map(function ($object) {
                 // if($object['is_product_configurable'] != 0){
                 //          $p = Product::where('parent_id',$object['id'])->first();
                 //          // $object['slug'] = $p->slug;
                 //    }

                return $object;
             });

        return $products;
    }
}
