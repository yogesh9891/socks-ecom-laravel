@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.edit', ['resource' => trans('blog::blogs.blog')]))
    @slot('subtitle', $blog->title)

    <li><a href="{{ route('admin.blogs.index') }}">{{ trans('blog::blogs.blogs') }}</a></li>
    <li class="active">{{ trans('admin::resource.edit', ['resource' => trans('blog::blogs.blog')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.blogs.update', $blog) }}" class="form-horizontal" id="blog-edit-form" novalidate>
        {{ csrf_field() }}
        {{ method_field('put') }}

        {!! $tabs->render(compact('blog')) !!}
    </form>
@endsection

@include('blog::admin.blogs.partials.shortcuts')
