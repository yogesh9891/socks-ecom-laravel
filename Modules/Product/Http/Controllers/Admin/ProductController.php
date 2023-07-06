<?php

namespace Modules\Product\Http\Controllers\Admin;

use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductCategory;
use Modules\Category\Entities\Category;
use Modules\Option\Entities\Option;
use Modules\Option\Entities\OptionValue;
use Modules\Option\Entities\OptionValueTranslation;
use Modules\Product\Entities\ProductVariation;
use Modules\Product\Entities\ProductPrice;
use Modules\Admin\Traits\HasCrudActions;
use Modules\Product\Http\Requests\SaveProductRequest;
use Modules\Product\Http\Requests\SaveProductConfigRequest;

use Illuminate\Http\Request;

use Modules\Support\Search\Searchable;
use Modules\Admin\Ui\Facades\TabManager;
use Modules\Product\Entities\ProductOption;
use StdClass,DB;

class ProductController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'product::products.product';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'product::admin.products';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveProductRequest::class;

    public function create()
    {

 
         $data = array_merge([
            'tabs' => TabManager::get($this->getModel()->getTable()),
            $this->getResourceName() => $this->getModel(),

        ], $this->getFormData('create'));

        $options = Option::all();

            $categories =  Category::treeList();

        return view("{$this->viewPath}.create", compact('options','categories'),$data);
    }


    public function store(SaveProductConfigRequest $request)
    {
        
         $validated = $request->validated();


          $entity = $this->getModel()->create($validated);

          if(!$request['is_product_configurable']){
            $id = $entity->id;
            return redirect()->route('admin.products.edit',$id);
        }
          $entity->update(['is_active'=>1]);
           DB::table('product_options')->insert([
                    ['product_id' => $entity->id, 'option_id' => 1],
                    ['product_id' => $entity->id, 'option_id' => 2],
                ]);
         $this->saveMulipleProduct($entity,$request->all());
          return redirect()->route('admin.products.index');
        
    }

    public function saveMulipleProduct($product,$request)
    {

         $options_value_array = $this->generateCombination(array_values($request['option_id']));

       foreach ($request['option_name'] as $key => $name) {
            
            $label  = explode('-',$name);
            $product_array = [
                'parent_id'=>$product->id,
                'price'=>$request['option_price'][$key],
                'qty'=>$request['option_stock'][$key],
                'product_options'=>$request['product_options'],
            ];
            if(empty($request['varition_id'][$key])){
                if(array_key_exists($key,$options_value_array)){

                 $option_value = $options_value_array[$key];
                } else{
                 $option_value = $options_value_array[0];

                }
            

            $product_array['name']=$product->name.' '.$name;
              $new_product = $this->getModel()->create(
                 $product_array
                );
              $new_product->product_partions()->save( new  ProductVariation(['product_parent_id'=>$product->id,'product_id'=>$new_product->id,'option_id'=>1,'option_value_id'=>$option_value[0],'option_value_label'=>$label[0]]));
               $new_product->product_partions()->save( new ProductVariation(['product_parent_id'=>$product->id,'product_id'=>$new_product->id,'option_id'=>2,'option_value_id'=>$option_value[1],'option_value_label'=>$label[1]]));
                   DB::table('product_options')->insert([
                    ['product_id' => $new_product->id, 'option_id' => 1],
                    ['product_id' => $new_product->id, 'option_id' => 2],
                ]);
              
            } else {
                $pid =  $request['varition_id'][$key];
                     $product_array['name']=$name;
                $new_product = $this->getEntity($pid)->update($product_array);
              
            }
            
       }
    }


   

        protected function generateCombination($arrays, $i = 0) {
         
                if (!isset($arrays[$i])) {
                    return array();
                }
                if ($i == count($arrays) - 1) {
                    return $arrays[$i];
                }

                // get combinations from subsequent arrays
                $tmp = $this->generateCombination($arrays, $i + 1);

                $result = array();

                // concat each array from tmp with each element from $arrays[$i]
                foreach ($arrays[$i] as $v) {
                    foreach ($tmp as $t) {
                        $new = [$v,$t];
                          array_push($result,$new); 
                    }
                }

        return $result;
    }


    public function productOption(Request $request)
    {
        $data = new StdClass;
        $option_array =  $request->option_array;

        $html = '';
        if($option_array != 0 ){


             $a =  [];
                $i=0;

                    foreach($option_array as $key => $s){

                         if($s != null){
                        $first = Option::find($key);
                        $a[$i] = $s;
                           $html .= '<input type="hidden" name="product_options[]" value="'.$key.'">'  ;
                        foreach($s as $key2 => $da){
                            $second = OptionValue::find($da);
                            $a[$i][$key2] = $second->label;
                        }

                        $i++;

                        }

                

                    }

                    $b = $this->generateCombination($a);

                    foreach($b as $val){
                            $name = implode('-',$val);

                        $html .= '     <div class="form-group row">
                                <div class="col-md-4 ">
                                     <div class="form-group">
                                          <input type="hidden" name="varition_id[]" value="">
                                        <input type="text" name="option_name[]" class="form-control" value="'.$name.'" readonly="true">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="number" name="option_price[]" class="form-control op_pr" min="100" value="100">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                     <div class="form-group">
                                        <input type="number" name="option_stock[]" class="form-control" min="0" value="0">
                                    </div>
                                </div>
                              
                            </div>';


                        

                    }
                 return response()->json(['success'=> true,'html'=>$html]);
        } 

  
                 return response()->json(['success'=> false]);
    }

        public function edit($id)
    {
        $data = array_merge([
            'tabs' => TabManager::get($this->getModel()->getTable()),
            $this->getResourceName() => $this->getEntity($id),
        ], $this->getFormData('edit', $id));

            $options = Option::all();

        $product  =  $this->getModel()
            ->withoutGlobalScope('active')
            ->findOrFail($id);
   

        if($product->is_product_configurable){
            $multi_products = $this->getModel()
            ->withoutGlobalScope('active')
            ->where('parent_id',$id)->get();

            $categories =  Category::treeList();

            return view("{$this->viewPath}.edit_multiple",compact('options','multi_products','categories'),$data);
        }


        return view("{$this->viewPath}.edit",$data);
    }

      public function checkProductvaration(Request $request)
    {

        $value = $request->value;
        $label = $request->label;
        $parent_id =$request->product_id;

        $vartion = ProductVariation::whereHas('parent', function ($query) use ($value) {
                    $query->where('option_value_id', $value[1]);
                })->where('product_parent_id',$parent_id)->where('option_value_id',$value[0])->get();
    
           if(!$vartion->isEmpty()){
           
         return response()->json(['success'=> false]);
      } else {
    $name = implode('-',$label);

         $html = '   <div class="form-group row ">
                    <div class="col-md-4 ">
                         <div class="form-group">
                          <input type="hidden" name="varition_id[]" value="">
                        
                            <input type="text" name="option_name[]" class="form-control" value="'.$name.'" readonly="true">
                        </div>
                    </div>
                    <div class="col-md-3">
                         <div class="form-group">
                           <input type="number" name="option_price[]" class="form-control op_pr" min="100" value="100">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="number" name="option_stock[]" class="form-control" min="0" value="0">
                        </div>
                    </div>
                     <div class="col-md-2 form-group">
                         
                            <button type="button" class="btn btn-danger" onclick="removeRow(this)"><i class="fa fa-trash"></i>
                     
                    </div>
                  
                </div>';

          return response()->json(['success'=> true,'html'=>$html]);
      }
    }



      public function update(Request $request,$id)
    {
        $entity = $this->getEntity($id);
// dd($entity->is_product_configurable);
        $pro_req = $this->getRequest('update')->all();
        $pro_req['product_options'] = $entity->product_options;
             if(!$entity->is_product_configurable){
            if($pro_req['is_active'] ==1){

                $pro_var = ProductVariation::where('product_id',$id)->update(['status'=>1]);
                
            } else {
                $pro_var = ProductVariation::where('product_id',$id)->update(['status'=>0]);
            }
        } else {

             $this->saveMulipleProduct($entity,$pro_req);
        }

         $entity->update($pro_req);

             if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo($entity)
                ->withSuccess(trans('admin::messages.resource_saved', ['resource' => $this->getLabel()]));
        }
        return redirect()->route("{$this->getRoutePrefix()}.index")
            ->withSuccess(trans('admin::messages.resource_saved', ['resource' => $this->getLabel()]));

    }


}
