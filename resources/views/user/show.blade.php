@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('text.profile')}}
                        {{ link_to_action('UserController@edit', trans('text.edit'), $user->id, ['class' => 'btn btn-primary pull-right']) }}
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                {{ Html::image(config('path.user_profile') . $user->image, '', ['class' => 'media-object', 'data-holder-rendered' => 'true', 'width' => 100, 'height' => 100]) }}
                                <div>
                                    {{ count($user->followers) . ' ' . trans('text.followers') }}
                                </div>
                            </div>
                            <div class="col-md-9">
                                {{ Form::label('name', trans('text.name'), ['class' => 'control-label']) }}
                                {{ Form::label('name', $user->name, ['class' => 'form-control']) }}
                                {{ Form::label('email', trans('text.email'), ['class' => 'control-label']) }}
                                {{ Form::label('email', $user->email, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <h3>{{ trans('text.following') }}</h3>
                        <div class="col-md-12">
                            @forelse ($user->followings as $follow)
                                <div class="col-md-4">
                                    <div class="media">
                                        <div class="media-left">
                                            {{ Html::image(config('path.user_profile') . $follow->image, '', ['class' => 'media-object', 'width' => 50, 'height' => 50 ]) }}
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                {{ link_to('/user/' . $follow->id, $follow->name) }}
                                            </h4>
                                            {{ Form::open(['method' => 'DELETE', 'action' => ['FollowController@destroy', $user->id]]) }}
                                                {{ Form::hidden('following_id',$follow->id) }}
                                                {{ Form::submit(trans('text.unfollow'), ['class' => 'btn btn-danger btn-sm']) }}
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>{{trans('text.emptyfollow')}}</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
