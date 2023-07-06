@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('blog::blogs.blogs'))

    <li class="active">{{ trans('blog::blogs.blogs') }}</li>
@endcomponent

@component('admin::components.page.index_table')
    @slot('buttons', ['create'])
    @slot('resource', 'blogs')
    @slot('name', trans('blog::blogs.blog'))

    @component('admin::components.table')
        @slot('thead')
            <tr>
                @include('admin::partials.table.select_all')

                <th>{{ trans('admin::admin.table.id') }}</th>
                <th>{{ trans('blog::blogs.table.blog_img') }}</th>
                <th>{{ trans('blog::blogs.table.title') }}</th>
                <th>{{ trans('admin::admin.table.status') }}</th>
                <th data-sort>{{ trans('admin::admin.table.created') }}</th>
            </tr>
        @endslot
    @endcomponent
@endcomponent

@push('scripts')
    <script>
        new DataTable('#blogs-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'id', width: '5%' },
                { data: 'blog_img', orderable: false, searchable: false, width: '10%' },
                { data: 'title', name: 'translations.title', orderable: false, defaultContent: '' },
                { data: 'status', name: 'is_active', searchable: false },
                { data: 'created', name: 'created_at' },
            ],
        });
    </script>
@endpush
