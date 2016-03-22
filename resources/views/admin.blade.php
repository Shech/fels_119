@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('text.dashboard') }}</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 container-fluid">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-tasks fa-4x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge">12</div>
                                                        <div>{{ trans('text.category') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            {!! Html::decode(link_to('/categories', '
                                             <div class="panel-footer">
                                                <span class="pull-left">'. trans('text.view_details') .'</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>'
                                            )) !!}
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="panel panel-danger">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-list-ul fa-4x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge">124</div>
                                                        <div>{{ trans('text.Words') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            {!! Html::decode(link_to('/words', '
                                             <div class="panel-footer">
                                                <span class="pull-left">' . trans('text.view_details') . '</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>'
                                            )) !!}
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-users fa-4x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge">124</div>
                                                        <div>{{ trans('text.users') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            {!! Html::decode(link_to('/users', '
                                             <div class="panel-footer">
                                                <span class="pull-left">' . trans('text.view_details') . '</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>'
                                            )) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h2>{{ trans('text.latest') .' ' . trans('text.activities') }}</h2>
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>{{ trans('text.activity') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($activities as $activity)
                                                    <tr>
                                                        <td>
                                                            {{ link_to('/user/' . $activity->user->id, $activity->user->name)}}
                                                            {{
                                                            trans('text.learned_lesson') . ' ' .
                                                            $activity->user->lessons->last()->category->name . ' (' .
                                                            $activity->created_at->format('Y/m/d') . ')'
                                                             }}
                                                        </td>
                                                    </tr>
                                                @empty
                                                <tr>
                                                    <td>{{ trans('text.no_result') }}</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">{{ trans('text.top') . ' ' . trans('text.category') }}</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="list-group">
                                                    <table class="table table-bordered table-hover table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ trans('text.rank') }}</th>
                                                                <th>{{ trans('text.category_name') }}</th>
                                                                <th>{{ trans('text.total_lessons') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse($topCategories  as $index => $topCategory)
                                                                <tr>
                                                                    <td>{{ $index + 1 }}</td>
                                                                    <td>{{  $topCategory->category->name }}</td>
                                                                    <td>{{ $topCategory->lesson_count }}</td>

                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="3">{{ trans('text.no_result') }}</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
