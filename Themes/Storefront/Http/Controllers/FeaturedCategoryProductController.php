<?php

namespace Themes\Storefront\Http\Controllers;
use Modules\Category\Entities\Category;

class FeaturedCategoryProductController extends ProductIndexController
{
    /**
     * Display a listing of the resource.
     *
     * @param int $categoryNumber
     * @return \Illuminate\Http\Response
     */
    public function index($categoryNumber)
    {
    	$cat = "storefront_featured_categories_section_category_{$categoryNumber}";
    	$category_id = setting("{$cat}_category_id");
    	   $category = Category::find($category_id);

        return view('public.products.index', [
            'categoryName' => $category->name,
            'categorySlug' => $category->slug,
            'categoryBanner' => $category->banner->path,
        ]);
        return $this->getProducts("storefront_featured_categories_section_category_{$categoryNumber}");
    }
}
