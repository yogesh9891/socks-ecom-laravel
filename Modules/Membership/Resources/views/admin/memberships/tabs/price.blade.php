<div class="row">
    <div class="col-md-8">
        {{ Form::number('price', 'Price', $errors, $membership, ['min' => 0, 'required' => true]) }}
    </div>
</div>
