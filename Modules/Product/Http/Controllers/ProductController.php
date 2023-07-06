<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Review\Entities\Review;
use Modules\Product\Entities\Product;
use Modules\Product\Events\ProductViewed;
use Modules\Product\Filters\ProductFilter;
use Modules\Product\Http\Middleware\SetProductSortOption;
use Illuminate\Http\Request;
use Modules\Product\Entities\ProductVariation;

class ProductController extends Controller
{
    use ProductSearch;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(SetProductSortOption::class)->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Modules\Product\Entities\Product $model
     * @param \Modules\Product\Filters\ProductFilter $productFilter
     * @return \Illuminate\Http\Response
     */
    public function index(Product $model, ProductFilter $productFilter)
    {
        if (request()->expectsJson()) {
            return $this->searchProducts($model, $productFilter);
        }

        return view('public.products.index');
    }

    /**
     * Show the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::findBySlug($slug);
        $relatedProducts = $product->relatedProducts()->forCard()->get();
        $upSellProducts = $product->upSellProducts()->forCard()->get();
        $review = $this->getReviewData($product);

        event(new ProductViewed($product));

        return view('public.products.show', compact('product', 'relatedProducts', 'upSellProducts', 'review'));
    }

    private function getReviewData(Product $product)
    {
        if (! setting('reviews_enabled')) {
            return;
        }

        return Review::countAndAvgRating($product);
    }

        public function checkOptionAvailability(Request $request,Product $product){

            $slug ='';

            $label = $request->label;
         if($request->type == 'color'){
            $product_var = ProductVariation::where('option_value_label',$label)->where('product_parent_id',$product->parent_id)->where('status',1)->first();
            if($product_var){
                $pro_var = Product::find($product_var->product_id);
                $slug =$pro_var->slug;
                  
            }
        } elseif($request->type == 'size'){

            $color = $request->color;
              $product_var = ProductVariation::where('option_value_label',$label)->where('product_parent_id',$product->parent_id)->where('product_id','!=',$product->product_id)->where('status',1)->get();
              foreach($product_var as $value){
               

                       $pro_var = ProductVariation::where('product_id',$value->product_id)->where('option_value_label',$color)->first();

                    if($pro_var){
                              $pro_var1 = Product::find($pro_var->product_id);
                        $slug =$pro_var1->slug;
                    }

                
              }
            //   dd($product_var);
            // if($product_var){
            //        $pro_var = Product::find($product_var->product_id);

            //         if($pro_var){
            //             $pro_var = Product::find($product_var->product_id);
            //             $slug =$pro_var->slug;
            //         }
            // }

        }

          
        if($slug){

        return response()->json(['status'=>200,'success'=>true,'slug'=>$slug,'message'=>'Product Found']);        
        }else{
         
        return response()->json(['status'=>201,'success'=>false,'message'=>'Product Found']);        
             
        }

            


    }
}
