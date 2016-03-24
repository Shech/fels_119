@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('text.lesson') }}
                    </div>
                    <div class="panel-body text-center">
                        <div class="media col-md-6"><br>
                            <h2> {{ $lessonWord->word->vietnamese_words}} </h2><br><br>
                            <audio controls>
                                <source src="{{ config('path.sound') . $lessonWord->word->sound_file }}" type="audio/mpeg">
                            </audio>
                        </div>
                        <div class="media col-md-6">
                            @foreach ($options as $option) <br>
                                {{ Form::open(['method' => 'PATCH', 'action' => ['LessonController@update', $lessonWord->lesson_id]]) }}
                                    {{ Form::hidden('selected_word', $option) }}
                                    {{ Form::submit($option, ['class' => 'btn btn-default btn-lg']) }}
                                {{ Form::close() }}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
