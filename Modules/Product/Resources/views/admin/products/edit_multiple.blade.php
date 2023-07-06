@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.edit', ['resource' => trans('product::products.product')]))
    @slot('subtitle', $product->name)

    <li><a href="{{ route('admin.products.index') }}">{{ trans('product::products.products') }}</a></li>
    <li class="active">{{ trans('admin::resource.edit', ['resource' => trans('product::products.product')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.products.update', $product) }}" class="form-horizontal"  enctype="multipart/form-data" novalidate>
        {{ csrf_field() }}
        {{ method_field('put') }}

          <div class="accordion-content" style="padding:40px;">
            <div class="row">
                
            <div class="col-md-8">
                

        {{-- {!! $tabs->render(compact('product')) !!} --}}

        {{ Form::text('name', trans('product::attributes.name'), $errors, $product, ['labelCol' => 5, 'required' => true]) }}


    
        {{ Form::select('categories', trans('product::attributes.categories'), $errors, $categories, $product, ['labelCol' => 5,'class' => 'selectize prevent-creation', 'multiple' => true]) }}

          <div class="optionSelect"  >
                     @php $option_ids = json_decode($product->option_id) ; @endphp
                 @foreach($options as $key => $option)
                 <div class="form-group row">
                     <label for="option_id" class="col-md-5 control-label text-left">{{$option->translation->name}}</label>
                   <input type="hidden" name="product_options[]" value="{{$option->id}}">
                     <div class="col-md-7">
                        @if($errors->has('option_id')) <span class="help-block text-red">The {{$option->translation->name}} is required.</span> @endif
                           <select name="option_id[{{$option->id}}][]"  class="form-control product-option" id="{{$option->id}}">
                            @foreach($option->values as $option_value)
                                <option  value="{{ $option_value->id }}" >{{ $option_value->translation->label }}</option>

                            @endforeach
                         </select>
                     </div>
                 </div>
            @endforeach

            </div> 

            <div id="productOptionDiv">
                <div class="row">
                      <div class="col-md-5">
                             <label for="option_id" class="col-md-5 control-label text-left">Options</label>
                    </div>
                        <div class="col-md-7"  >
                            <font color="red" id="product_error"></font>
                            <div class="form-group row">
                                <div class="col-md-4">
                                     <div class="form-group">
                                       <label>Option</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                       <label>Price</label>
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                     <div class="form-group">
                                       <label>Stock</label>
                               
                                    </div>
              
                                </div>
                               
                            </div>
                            <div  id="productOption">
                                   @foreach($multi_products as $options)
                                <div class="form-group row">
                                <div class="col-md-4 ">
                                     <div class="form-group">
                                        <input type="hidden" name="varition_id[]" value="{{$options->id}}">
                                        <input type="text" name="option_name[]" class="form-control" value="{{$options->name}}" readonly="true">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="number" name="option_price[]" class="form-control" min="100" value="{{$options->price}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                     <div class="form-group">
                                        <input type="number" name="option_stock[]" class="form-control" min="0" value="{{$options->qty}}">
                                    </div>
                                </div>
                              
                            </div>
                                   @endforeach
                            </div>
                        </div>

                      
                </div>
            </div>
            <div class="row">
                
                <div class="col-md-offset-5">
                    
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                </div>
            </div>

            </div>

            </div>
        </div>

       
    </form>
@endsection

@include('product::admin.products.partials.shortcuts')

@push('scripts')
<script type="text/javascript">

    function removeRow(e) {
       $(e).closest('.row').remove();
    }

    $('.product-option').change(function () {
      
    let option_array = [];
    let option_value_array = [];
    let option_value_label = [];
    let product_id = '{{$product->id}}';

  $(".product-option option").each(function(i){
       

    if($(this).is(':selected')){

        option_value_array.push($(this).val())
        option_value_label.push($(this).text())
        console.log($(this).text() + " : " + $(this).val());
    }
    });

 $.ajax({
                    type: "POST",
                    url: "{{route('admin.products.check-variation')}}",
                    headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       },
                    data: {
                       value:option_value_array,label:option_value_label,product_id:product_id                                                                                                                                     
                    },
                    success: function (res) {
                        if(res.success == true){

                       
                         $('#productOption').append(res.html)
                        } else {
                         $('#product_error').text('This product is already created')
                            setTimeout(function(){  $('#product_error').text('') }, 3000)

                        }
                    }
                });

    })
</script>
@endpush
