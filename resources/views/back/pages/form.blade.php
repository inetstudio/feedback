@extends('admin::back.layouts.app')

@php
    $title = ($item->id) ? 'Просмотр сообщения' : 'Создание сообщения';
@endphp

@section('title', $title)

@section('content')

    @push('breadcrumbs')
        @include('admin.module.feedback::back.partials.breadcrumbs.form')
        <li>
            <a href="{{ route('back.feedback.index') }}">Обратная связь</a>
        </li>
    @endpush

    <div class="row m-sm">
        <a class="btn btn-white" href="{{ route('back.feedback.index') }}">
            <i class="fa fa-arrow-left"></i> Вернуться назад
        </a>
    </div>

    <div class="wrapper wrapper-content">
        {!! Form::info() !!}

        {!! Form::open(['url' => (! $item->id) ? route('back.feedback.store') : route('back.feedback.update', [$item->id]), 'id' => 'mainForm', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}

            @if ($item->id)
                {{ method_field('PUT') }}
            @endif

            {!! Form::hidden('feedback_id', (! $item->id) ? '' : $item->id, ['id' => 'object-id']) !!}

            {!! Form::hidden('feedback_type', get_class($item), ['id' => 'object-type']) !!}

            {!! Form::buttons('', '', ['back' => 'back.feedback.index']) !!}

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

            {!! Form::buttons('', '', ['back' => 'back.feedback.index']) !!}

        {!! Form::close()!!}
    </div>
@endsection
