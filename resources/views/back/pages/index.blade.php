@extends('admin::back.layouts.app')

@php
    $title = 'Обратная связь';
@endphp

@section('title', $title)

@section('content')

    @push('breadcrumbs')
        @include('admin.module.feedback::back.partials.breadcrumbs')
    @endpush

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="table-responsive">
                            {{ $table->table(['class' => 'feedback-package table table-striped table-bordered table-hover dataTable']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@pushonce('scripts:datatables_feedback_index')
    {!! $table->scripts() !!}
@endpushonce
