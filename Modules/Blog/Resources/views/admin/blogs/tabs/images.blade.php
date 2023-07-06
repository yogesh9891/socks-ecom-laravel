
{{-- {{ dd($blog) }} --}}
@include('media::admin.image_picker.single', [
    'title' => trans('blog::blogs.form.blog_img'),
    'inputName' => 'files[blog_img]',
    'file' => $blog->blog_img,
])

