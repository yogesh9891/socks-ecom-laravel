<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductVariation;

class ProductVariation extends Model
{
    
    protected $guarded = [];
    

     public function parent()
    {
        return $this->belongsTo(ProductVariation::class, 'product_id','product_id');
    }

     public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

     public function product_size()
    {
        return $this->belongsTo(ProductVariation::class, 'product_id','product_id')->where('option_value_id','!=',$this->option_value_id);
    }
   
}
