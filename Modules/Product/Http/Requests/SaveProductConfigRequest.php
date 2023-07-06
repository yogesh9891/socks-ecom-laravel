<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Product\Entities\Product;
use Modules\Core\Http\Requests\Request;

class SaveProductConfigRequest extends Request
{

     protected $availableAttributes = 'product::attributes';
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'slug' => $this->getSlugRules(),
            'name' => 'required',
            'is_product_configurable'=>'required',
        ];
        if(request()->is_product_configurable){
            $rules['option_id'] = 'required';
        }

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
  
    private function getSlugRules()
    {
        $rules = $this->route()->getName() === 'admin.products.update'
            ? ['required']
            : ['sometimes'];

        $slug = Product::withoutGlobalScope('active')->where('id', $this->id)->value('slug');

        $rules[] = Rule::unique('products', 'slug')->ignore($slug, 'slug');

        return $rules;
    }
}
