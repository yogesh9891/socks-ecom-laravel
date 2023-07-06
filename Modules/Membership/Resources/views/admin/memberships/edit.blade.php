@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.edit', ['resource' => trans('membership::memberships.membership')]))
    @slot('subtitle', $membership->title)

    <li><a href="{{ route('admin.memberships.index') }}">{{ trans('membership::memberships.memberships') }}</a></li>
    <li class="active">{{ trans('admin::resource.edit', ['resource' => trans('membership::memberships.membership')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.memberships.update', $membership) }}" class="form-horizontal" id="membership-edit-form" novalidate>
        {{ csrf_field() }}
        {{ method_field('put') }}

        {!! $tabs->render(compact('membership')) !!}
    </form>
@endsection

@include('membership::admin.memberships.partials.shortcuts')
