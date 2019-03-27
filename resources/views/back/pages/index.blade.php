@extends('admin::back.layouts.app')

@php
    $title = 'Обратная связь';
@endphp

@section('title', $title)

@section('content')

    @push('breadcrumbs')
        @include('admin.module.feedback::back.partials.breadcrumbs.form')
    @endpush

    <div class="wrapper wrapper-content feedback-package" id="feedback_table">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <a href="#" data-url="{{ route('back.feedback.moderate.read') }}" class="btn btn-xs btn-default group-action">Отметить как прочитанное</a>
                        <a href="#" data-url="{{ route('back.feedback.moderate.destroy') }}" class="btn btn-xs btn-danger group-action">Удалить</a>
                        <div class="ibox-tools">
                            <a href="{{ route('back.feedback.export') }}" class="btn btn-xs btn-primary">Экспорт</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="sk-spinner sk-spinner-double-bounce">
                            <div class="sk-double-bounce1"></div>
                            <div class="sk-double-bounce2"></div>
                        </div>
                        <div class="table-responsive">
                            {{ $table->table(['class' => 'table table-striped table-bordered table-hover dataTable']) }}
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
