@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('text.profile')}}</div>
                    <div class="panel-body">
                        {{ Form::open(['method' => 'PATCH', 'action' => ['UserController@update', $user->id], 'files' => true, 'class' => 'form-horizontal']) }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                {{ Form::label('name', trans('text.name'), ['class' => 'col-md-4 control-label']) }}
                                <div class="col-md-6">
                                    {{ Form::text('name', $user->name, ['class' => 'form-control']) }}
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                {{ Form::label('email', trans('text.email'), ['class' => 'col-md-4 control-label']) }}
                                <div class="col-md-6">
                                    {{ Form::email('email', $user->email, ['class' => 'form-control']) }}
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('image_user') ? ' has-error' : '' }}">
                                {{ Form::label('image_user', trans('text.upload_image'), ['class' => 'col-md-4 control-label']) }}
                                <div class="col-md-6">
                                    {{ Form::file('image_user', ['class' => 'form-control']) }}
                                    @if ($errors->has('image_user'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('image_user') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-6">
                                    {{ Form::button('<i class="fa fa-btn fa-user"></i>' . trans('text.register'), ['class' => 'btn btn-primary', 'type' => 'submit']) }}
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
