@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.create', ['resource' => trans('product::products.product')]))

    <li><a href="{{ route('admin.products.index') }}">{{ trans('product::products.products') }}</a></li>
    <li class="active">{{ trans('admin::resource.create', ['resource' => trans('product::products.product')]) }}</li>
@endcomponent

@section('content')

    <form method="POST" action="{{ route('admin.products.store') }}" class="form-horizontal add_pd_form" id="pr_form_create" {{-- id="product-create-form" --}} >
        {{ csrf_field() }}

        <div class="accordion-content" style="padding:40px;">
            <div class="row">
                
            <div class="col-md-8">
                

        {{-- {!! $tabs->render(compact('product')) !!} --}}

        {{ Form::text('name', trans('product::attributes.name'), $errors, $product, ['labelCol' => 5, 'required' => true]) }}


        {{ Form::select('categories', trans('product::attributes.categories'), $errors, $categories, $product, ['labelCol' => 5,'class' => 'selectize prevent-creation', 'multiple' => true]) }}

         {{ Form::checkbox('is_product_configurable', 'Is Product Configurable', 'Is Product Configurable', $errors, $product,['labelCol' => 5,'id' => 'is_configurable']) }}


            <div class="optionSelect" id="product-option-list"  @if(!$errors->has('option_id')) style="display:none;" @endif >
            
             @foreach($options as $key => $option)
                 <div class="form-group row">
                     <label for="option_id" class="col-md-5 control-label text-left">{{$option->translation->name}}</label>
                   
                     <div class="col-md-7">
                        @if($errors->has('option_id')) <span class="help-block text-red">The {{$option->translation->name}} is required.</span> @endif
                         <select name="option_id[{{$option->id}}][]" class="selectize  product-option prevent-creation " data-id="{{$option->id}}" id="option_id-{{$key}}"  id="option_id" multiple="multiple" tabindex="-1">
                            @foreach($option->values as $option_value)
                                <option  value="{{ $option_value->id }}" >{{ $option_value->translation->label }}</option>

                            @endforeach
                         </select>
                     </div>
                 </div>
            @endforeach
            </div>
            <div id="productOptionDiv" style="display: none;">
                <div class="row">
                      <div class="col-md-5">
                             <label for="option_id" class="col-md-5 control-label text-left">Options</label>
                    </div>
                 
                        <div class="col-md-7"  >
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
                            <div  id="productOption"></div>
                        </div>
                      
                </div>
            </div>
            <div class="row">
                
                <div class="col-md-offset-5">
                    
                    <input type="button" class="btn btn-primary pr_submit"  value="Submit">
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


    $('#is_product_configurable').click(function () {

        $('#product-option-list').toggle();

     })

    $('.product-option').change(function () {

           let option_array = [];
        $('.selectized').each(function( index ) {
            if($(this).hasClass('product-option')){
                let select = $(this);
               
                let value_array = select.val();
                let option_id = select.attr('data-id');
             option_array[option_id] = value_array;

            }
       
});

        console.log(option_array);
           $.ajax({
                    type: "POST",
                    url: "{{route('admin.products.option_list')}}",
                    headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       },
                    data: {
                        option_array: option_array
                    },
                    success: function (res) {
                        if(res.success == true){

                         $('#productOptionDiv').show()
                         $('#productOption').html(res.html)
                        } else {
                         $('#productOptionDiv').hide()

                        }
                    }
                });

    });




            $('#productOption').on('change','.op_pr',function(){
                if($(this).val()<100){
                    alert('Price Must be greater than 100');
                }
                
            })
            $('.pr_submit').click(function(){

                var status = true;

                $('.op_pr').each(function(){

                   if($(this).val() <100){
                    alert('Price Must be greater than 100');
                    status = false;
                   }

                })

                if(status){
                    $('#pr_form_create').submit();
                }
            })



</script>
@endpush

