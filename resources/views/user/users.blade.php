@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('text.users') }}
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            @forelse ($users as $user)
                                <div class="col-md-4">
                                    <div class="media">
                                        <div class="media-left">
                                            {{ Html::image('/pictures/user_profile/' . $user->image, '', ['class' => 'media-object', 'width' => 50, 'height' => 50 ]) }}
                                         </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                {{ link_to('/user/' . $user->id, $user->name) }}
                                            </h4>
                                            {{ Form::open(['method' => 'DELETE', 'action' => ['UserController@destroy', $user->id]]) }}
                                                {{ Form::hidden('user_id', $user->id) }}
                                                {{ Form::submit(trans('text.delete'), ['class' => 'btn btn-danger btn-sm']) }}
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-4">{{ trans('text.no_result') }}</div>
                            @endforelse
                        </div>
                        <h6>{{ $users->render() }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
