@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('text.lesson') }}
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('text.vietnam_word') }}</th>
                                    <th>{{ trans('text.japanese_word') }}</th>
                                    <th>{{ trans('text.sound_file') }}</th>
                                    <th>{{ trans('text.result') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lessonResults as $result)
                                    <tr>
                                        <td>{{ $result->word->vietnamese_words }}</td>
                                        <td>{{ $result->word->japanese_words }}</td>
                                        <td>
                                            <audio controls>
                                                <source src="sounds/{{ $result->sound_file }}" type="audio/mpeg">
                                            </audio>
                                        </td>
                                        <td>
                                            @if(empty($result->result))
                                                <i class="fa fa-times fa-4"></i>
                                            @else
                                                <i class="fa fa-circle-o"></i>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <h3>{{ trans('text.empty_result') }}</h3>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection