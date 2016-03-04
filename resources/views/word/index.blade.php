@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('text.word') }}
                        {{ link_to('/words/create', trans('text.add'), ['class' => 'btn btn-success pull-right']) }}
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('text.vietnam_word') }}</th>
                                    <th>{{ trans('text.japanese_word') }}</th>
                                    <th>{{ trans('text.words_option') }}</th>
                                    <th>{{ trans('text.sound_file') }}</th>
                                    <th>{{ trans('text.category') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($words as $word)
                                    <tr>
                                        <td>{{ $word->vietnamese_words }}</td>
                                        <td>{{ $word->japanese_words }}</td>
                                        <td>{{ $word->word_options }}</td>
                                        <td>
                                            <audio controls>
                                            <source src="sounds/{{ $word->sound_file }}" type="audio/mpeg">
                                            </audio>
                                        </td>
                                        <td>{{ $word->category->name }}</td>
                                        <td>
                                            {{ Form::open(['method' => 'DELETE', 'action' => ['WordController@destroy', $word->id]]) }}
                                                {{ Form::submit( trans('text.delete'), ['class' => 'btn btn-danger']) }}
                                                {{ link_to_action('WordController@edit', trans('text.edit'), $word->id, ['class' => 'btn btn-default']) }}
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                @empty
                                    <p>{{ trans('text.no_data_words') }}</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
