@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.create', ['resource' => trans('membership::memberships.membership')]))

    <li><a href="{{ route('admin.memberships.index') }}">{{ trans('membership::memberships.memberships') }}</a></li>
    <li class="active">{{ trans('admin::resource.create', ['resource' => trans('membership::memberships.membership')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.memberships.store') }}" class="form-horizontal" id="membership-create-form" novalidate>
        {{ csrf_field() }}
      
        {!! $tabs->render(compact('membership')) !!}
    </form>
@endsection

@include('membership::admin.memberships.partials.shortcuts')
