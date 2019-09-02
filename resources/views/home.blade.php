@extends('layouts.starter')

@section('content')

            <div class="card">
                {{--<div class="card-header">Dashboard</div>--}}

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>{{$user}}</h3>
                                <p>User Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                                </div>
                            {{--<a href="{{route('')}}" class="small-box-footer">--}}
                                {{--More info <i class="fa fa-arrow-circle-right"></i>--}}
                            {{--</a>--}}
                    </div>
            </div>

            </div>


            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Category</span>
                        <span class="info-box-number">{{$category}}</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        {{--<span class="progress-description">--}}
                    {{--70% Increase in 30 Days--}}
                  {{--</span>--}}
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total tag</span>
                        <span class="info-box-number">{{$tag}}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total posts</span>
                        <span class="info-box-number">{{$post}}</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        {{--<span class="progress-description">--}}
                    {{--70% Increase in 30 Days--}}
                  {{--</span>--}}
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

@endsection
