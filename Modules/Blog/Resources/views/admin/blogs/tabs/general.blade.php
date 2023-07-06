<div class="row">
    <div class="col-md-8">
        {{ Form::text('title', trans('blog::attributes.title'), $errors, $blog, ['required' => true]) }}
    </div>
</div>

		{{ Form::wysiwyg('description', trans('blog::attributes.description'), $errors, $blog, ['labelCol' => 2, 'required' => true]) }}
        {{ Form::checkbox('is_active', trans('blog::attributes.is_active'), trans('blog::blogs.form.enable_the_blog'), $errors, $blog) }}
