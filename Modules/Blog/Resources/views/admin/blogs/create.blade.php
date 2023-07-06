@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.create', ['resource' => trans('blog::blogs.blog')]))

    <li><a href="{{ route('admin.blogs.index') }}">{{ trans('blog::blogs.blogs') }}</a></li>
    <li class="active">{{ trans('admin::resource.create', ['resource' => trans('blog::blogs.blog')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.blogs.store') }}" class="form-horizontal" id="blog-create-form" novalidate>
        {{ csrf_field() }}
        {!! $tabs->render(compact('blog')) !!}
    </form>
@endsection

@include('blog::admin.blogs.partials.shortcuts')
