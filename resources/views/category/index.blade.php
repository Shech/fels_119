@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('text.category') }}
                        {{ link_to('categories/create', trans('text.add'), ['class' => 'btn btn-success pull-right']) }}
                    </div>
                    <div class="panel-body">
                        @forelse ($categories as $category)
                            <div class="media col-md-8">
                                <div class="media-left media-middle">
                                    @if (!empty($category->image))
                                        {{ Html::image(config('path.category') . $category->image, '', ['class' => 'media-object', 'data-holder-rendered' => 'true', 'width' => 100, 'height' => 100 ]) }}
                                    @endif
                                </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{ $category->name }}</h4>
                                {{ $category->description }}
                            </div>
                            </div>
                            <div class="media col-md-4 ">
                                {{ Form::open(['method' => 'DELETE', 'action' => ['CategoryController@destroy',$category->id]]) }}
                                    {{ Form::submit( trans('text.delete') ,['class'=>'btn btn-danger']) }}
                                    {{ link_to_action('CategoryController@edit', trans('text.edit'), $category->id, ['class'=>'btn btn-default']) }}
                                {{ Form::close() }}
                            </div>
                        @empty
                            <p>There is no data for categories</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
