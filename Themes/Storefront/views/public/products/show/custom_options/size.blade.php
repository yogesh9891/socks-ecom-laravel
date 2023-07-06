<div class="col-12 size mb-3">
        <div class="row color-row">
               @foreach ($product->varitions_size( $product->product_partions[0]->option_value_id) as $value)
                 <div class="col-2 size-div">
                    <div class="size-containt  @if($product->product_partions[1]->option_value_id == $value->product_size->option_value_id) focus  size-disabled @endif" size="{{$value->product_size->option_value_label}}">
                        <span>{{$value->product_size->option_value_label}}</span>
                    </div>
                </div>
                
        @endforeach
                                          
    </div>
     <span
                class="error-message"
                v-if="errors.has('{{ "options.{$product->product_partions[1]->option_value_id}" }}')"
                v-text="errors.get('{{ "options.{$product->product_partions[1]->option_value_id}" }}')"
            >
</div>