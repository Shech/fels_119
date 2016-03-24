@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('text.word') }}
                    </div>
                    <div class="panel-body">
                        <div class="text-center">
                            {{ Form::open(['method' => 'POST', 'action' => 'WordController@search', 'files' => true, 'class' => 'form-inline']) }}
                                {{ Form::select('category_id',array_merge(['0' => trans('text.select_category')] + $categories), null, ['id' => 'category_id', 'class' => 'form-control']) }}&nbsp;
                                {{ Form::radio('filter', '1', false) }}
                                {{ Form::label('category_id', trans('text.learned')) }}&nbsp;
                                {{ Form::radio('filter', '2', false) }}
                                {{ Form::label('category_id', trans('text.unlearned')) }}&nbsp;
                                {{ Form::radio('filter', '3', true) }}
                                {{ Form::label('category_id', trans('text.all')) }}&nbsp;
                                {{ Form::submit('Filter', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}<br>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('text.vietnam_word') }}</th>
                                    <th>{{ trans('text.japanese_word') }}</th>
                                    <th>{{ trans('text.sound_file') }}</th>
                                    <th>{{ trans('text.category') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($words as $word)
                                    <tr>
                                        <td>{{ $word->vietnamese_words }}</td>
                                        <td>{{ $word->japanese_words }}</td>
                                        <td>
                                            <audio controls>
                                                <source src="{{ config('path.sound') . $word->sound_file }}" type="audio/mpeg">
                                            </audio>
                                        </td>
                                        <td>{{ $word->category->name }}</td>
                                    </tr>
                                @empty
                                    <h3>{{ trans('text.no_result') }}</h3>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
