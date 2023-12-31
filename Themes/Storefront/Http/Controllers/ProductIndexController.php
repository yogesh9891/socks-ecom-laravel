<?php

namespace Themes\Storefront\Http\Controllers;

use Illuminate\Support\Collection;
use Modules\Product\RecentlyViewed;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;

class ProductIndexController
{
    private $recentlyViewed;

    public function __construct(RecentlyViewed $recentlyViewed)
    {
        $this->recentlyViewed = $recentlyViewed;
    }

    protected function getProducts($settingPrefix)
    {
        $type = setting("{$settingPrefix}_product_type", 'custom_products');
        $limit = setting("{$settingPrefix}_products_limit");

        if ($type === 'category_products') {
            $this->categoryProducts($settingPrefix);
        }

        if ($type === 'recently_viewed_products') {
            $products = $this->recentlyViewedProducts($limit);
        }

        $products =  Product::forCard()
            ->when($type === 'latest_products', $this->latestProductsCallback($limit))
            ->when($type === 'custom_products', $this->customProductsCallback($settingPrefix))
            ->where('parent_id',null)
            ->get()
            ->map
            ->clean();

      
    $products = $products->map(function ($object) {
                 if($object['is_product_configurable'] != 0){
                          $p = Product::where('parent_id',$object['id'])->first();
                          $object['slug'] = $p->slug;
                    }

                return $object;
             }); 

       return $products;
    }

    private function categoryProducts($settingPrefix)
    {

        return Category::findOrNew(setting("{$settingPrefix}_category_id"))
            ->products()
            ->forCard()
            ->get();
    }

    private function recentlyViewedProducts($limit)
    {
        return collect($this->recentlyViewed->products())
            ->reverse()
            ->when(! is_null($limit), function (Collection $products) use ($limit) {
                return $products->take($limit);
            })
            ->values();
    }

    private function latestProductsCallback($limit)
    {
        return function ($query) use ($limit) {
            $query->latest()
                ->when(! is_null($limit), function ($q) use ($limit) {
                    $q->limit($limit);
                });
        };
    }

    private function customProductsCallback($settingPrefix)
    {
        return function ($query) use ($settingPrefix) {
            $productIds = setting("{$settingPrefix}_products", []);

            $query->whereIn('id', $productIds)
                ->when(! empty($productIds), function ($q) use ($productIds) {
                    $productIdsString = collect($productIds)->filter()->implode(',');

                    $q->orderByRaw("FIELD(id, {$productIdsString})");
                });
        };
    }
}
