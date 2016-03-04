@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                {{ Html::image(config('path.user_profile') . $user->image, '', ['class' => 'center-image media-object', 'data-holder-rendered' => 'true', 'width' => 100, 'height' => 100 ]) }}
                                <div>
                                    <h4>{{ $user->name }}</h4>
                                    {{ trans('text.learned') . ' ' . $userWordCount . ' ' . trans('text.words') }}
                                </div>
                            </div>
                            <div class="col-md-9 verticalLine">
                                @if (!empty($follow))
                                    {{ Form::open(['method' => 'DELETE', 'action' => ['FollowController@destroy', $user->id]]) }}
                                        {{ Form::hidden('following_id', $user->id) }}
                                        {{ Form::submit(trans('text.unfollow'), ['class' => 'btn btn-primary btn-lg pull-right']) }}
                                    {{ Form::close() }}
                                @else
                                    {{ Form::open(['method' => 'PATCH', 'action' => ['FollowController@update', $user->id]]) }}
                                        {{ Form::hidden('following_id', $user->id) }}
                                        {{ Form::submit(trans('text.follow'), ['class' => 'btn btn-primary btn-lg pull-right']) }}
                                    {{ Form::close() }}
                                @endif
                                <h1>{{ trans('text.activities') }}</h1>
                                <hr>
                                @forelse ($lessons as $lesson)
                                    <div class="media">
                                        <div class="media-left">
                                            {{ Html::image(config('path.category') . $user->image, '', ['class' => 'media-object', 'data-holder-rendered' => 'true', 'width' => 50, 'height' => 50 ]) }}
                                        </div>
                                        <div class="media-body">
                                            <h5>
                                                {{ trans('text.learned') .
                                                ' ' . trans('text.words') .
                                                ' ' . trans('text.in_lesson') .
                                                ' "' . $lesson->category->name .
                                                '". (' . $lesson->created_at->format('Y/m/d') . ')' }}
                                            </h5>
                                        </div>
                                    </div>
                                @empty
                                    <h4>{{ trans('text.no_result') }}</h4>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
