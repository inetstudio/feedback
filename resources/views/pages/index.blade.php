@extends('admin::back.layouts.app')

@php
    $title = 'Обратная связь';
@endphp

@section('title', $title)

@pushonce('styles:datatables')
    <!-- DATATABLES -->
    <link href="{!! asset('admin/css/plugins/datatables/datatables.min.css') !!}" rel="stylesheet">
@endpushonce

@pushonce('styles:feedback_custom')
    <!-- CUSTOM STYLE -->
    <link href="{!! asset('admin/css/modules/feedback/custom.css') !!}" rel="stylesheet">
@endpushonce

@section('content')

    @push('breadcrumbs')
        @include('admin.module.feedback::partials.breadcrumbs')
    @endpush

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="table-responsive">
                            {{ $table->table(['class' => 'table table-striped table-bordered table-hover dataTable']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@pushonce('scripts:datatables')
    <!-- DATATABLES -->
    <script src="{!! asset('admin/js/plugins/datatables/datatables.min.js') !!}"></script>
@endpushonce

@pushonce('scripts:datatables_feedback_index')
    {!! $table->scripts() !!}
@endpushonce
