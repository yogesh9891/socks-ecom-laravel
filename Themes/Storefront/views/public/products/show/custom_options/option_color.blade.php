<div class="col-12 maincolor-div">
     <p id="product-color" class="text_center"></p>
     <div class="row color-row">
           @foreach ($option->values as $value)
               @if($value->varitions($product))
               
             <div class="color-divs">
                 <div class="color-divs-one color_click curser-pointer  @if($product->product_partions[0]->option_value_id == $value->id) focus color-disabled @endif "  style="background-color: {{$value->code}} !important;" color="{{$value->label}}"></div>
             </div>
             @endif
         @endforeach
        
     </div>
     <span
                class="error-message"
                v-if="errors.has('{{ "options.{$product->product_partions[0]->option_value_id}" }}')"
                v-text="errors.get('{{ "options.{$product->product_partions[0]->option_value_id}" }}')"
            >
</div>




