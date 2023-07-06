<div class="row">
    <div class="col-md-8">
        {{ Form::text('title', 'Title', $errors, $membership, ['required' => true]) }}
        {{ Form::text('days', 'Days', $errors, $membership, ['required' => true]) }}
    </div>
</div>

{{ Form::wysiwyg('description', 'Description', $errors, $membership, ['labelCol' => 2, 'required' => true]) }}
{{ Form::checkbox('is_active', 'Status', trans('membership::memberships.form.enable_the_membership'), $errors, $membership) }}
