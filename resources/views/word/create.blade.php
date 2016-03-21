@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ trans('text.word')}}</h1>
        <hr>
        <div class="panel-body">
            @include('errors.form')
            {{ Form::open(['method' => 'POST', 'action' => 'WordController@store', 'files' => true, 'class' => 'form-horizontal']) }}
                <div class="form-group">
                    {{ Form::label('vietnamese_word', trans('text.vietnam_word')) }}
                    {{ Form::text('vietnamese_word', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('japanese_word', trans('text.japanese_word')) }}
                    {{ Form::text('japanese_word', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('word_options', trans('text.word_options')) }}
                    @for ($i = 1; $i <= $countOfOption; $i++ )
                        {{ Form::text('word_options['. $i .']', null, ['class' => 'form-control', 'placeholder' => trans('text.option') . $i ]) }} </br>
                    @endfor
                </div>

                <div class="form-group">
                    {{ Form::label('sound_file', trans('text.sound_file')) }}
                    {{ Form::file('sound_file', ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('category_id', trans('text.category_name')) }}
                    {{ Form::select('category_id', $categories, null, ['id' => 'category_id', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::submit(trans('text.submit'), ['class' => 'btn btn-success pull-right']) }}
                    {{ link_to('/words', trans('text.cancel'), ['class' => 'btn btn-primary pull-left']) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
