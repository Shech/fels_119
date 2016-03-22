@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ trans('text.category')}}</h1>
        <hr>
        <div class="panel-body">
            @include ('errors.form')
            {{ Form::open(['method' => 'POST', 'action' => 'CategoryController@store', 'files' => true, 'class' => 'form-horizontal']) }}
                <div class="form-group">
                    {{ Form::label('name', trans('text.name')) }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('description', trans('text.description')) }}
                    {{ Form::textarea('description', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('image_category', trans('text.upload_image')) }}
                    {{ Form::file('image_category', ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::submit('Submit', ['class' => 'btn btn-success pull-right']) }}
                    {{ link_to('categories', trans('text.cancel'), ['class' => 'btn btn-primary pull-left']) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
