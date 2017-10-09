@extends('admin::layouts.app')

@php
    $title = ($item->id) ? 'Просмотр сообщения' : '';
@endphp

@section('title', $title)

@section('content')

    @push('breadcrumbs')
        @include('admin.module.feedback::partials.breadcrumbs')
        <li>
            <a href="{{ route('back.feedback.index') }}">Обратная связь</a>
        </li>
    @endpush

    <div class="row m-sm">
        <a class="btn btn-white" href="{{ route('back.feedback.index') }}">
            <i class="fa fa-arrow-left"></i> Вернуться назад
        </a>
    </div>

    <div class="wrapper wrapper-content form-horizontal">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel-group float-e-margins" id="mainAccordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <a data-toggle="collapse" data-parent="#mainAccordion" href="#collapseMain" aria-expanded="true">Основная информация</a>
                            </h5>
                        </div>
                        <div id="collapseMain" class="panel-collapse collapse in" aria-expanded="true">
                            <div class="panel-body">

                                {!! Form::string('name', $item->name, [
                                    'label' => [
                                        'title' => 'Имя',
                                    ],
                                    'field' => [
                                        'class' => 'form-control',
                                        'disabled' => true,
                                    ],
                                ]) !!}

                                {!! Form::string('email', $item->email, [
                                    'label' => [
                                        'title' => 'Email',
                                    ],
                                    'field' => [
                                        'class' => 'form-control',
                                        'disabled' => true,
                                    ],
                                ]) !!}

                                {!! Form::wysiwyg('message', $item->message, [
                                    'label' => [
                                        'title' => 'Сообщение',
                                    ],
                                    'field' => [
                                        'class' => 'form-control',
                                        'id' => 'message',
                                        'disabled' => true,
                                    ],
                                ]) !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
