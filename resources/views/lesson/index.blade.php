@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('text.category') }}
                    </div>
                    <div class="panel-body">
                        @forelse ($wordsPerCategory as $category)
                            <div class="media col-md-8">
                                <div class="media-left media-middle">
                                    @if (!empty($category->image))
                                        {{ Html::image('/pictures/category/' . $category->image, '', ['class' => 'media-object', 'data-holder-rendered' => 'true', 'width' => 100, 'height' => 100 ]) }}
                                    @endif
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ $category->name }}</h4>
                                    <h5>{{ trans('text.learnedword') . ' ' . count($category->words) }}</h5>
                                    {{ $category->description }}
                                </div>
                            </div>
                            <div class="media col-md-4 text-center ">
                                {{ Form::open(['method' => 'POST', 'action' => ['LessonController@store']]) }}
                                    {{ Form::hidden('categoryId', $category->id) }}
                                    {{ Form::submit(trans('text.start') ,['class'=>'btn btn-default btn-lg']) }}
                                {{ Form::close() }}
                            </div>
                        @empty
                            <h3>{{ trans('text.empty_lesson') }}</h3>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
