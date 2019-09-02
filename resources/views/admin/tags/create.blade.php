@extends('layouts.starter')

@section('content')

    @if(count($errors)>0)

        <ul class="list-group">
            @foreach($errors->all() as $error )
                <li class="list-group-item text-danger">
                    {{$error}}
                </li>
            @endforeach
        </ul>

    @endif


    <section class="content" style='margin-left: 75px'>
        <div class="row">
            <!-- left column -->

            <!-- right column -->
            <div class="col-md-10">
                <!-- Horizontal Form -->

                <!-- general form elements disabled -->
                <div class="box box-warning">
                    <div class="box-header with-border">
                        {{--<h3 class="box-title">New Tag</h3>--}}
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" action="{{route('tag.store')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <!-- text input -->
                            <div class="form-group">
                                <label>Name of New Tag</label>
                                <input type="text" class="form-control"  name="tag" placeholder="Enter ...">
                            </div>


                            <div class="form-group">
                                <div class="text-center">
                                    <button class="btn btn-success" type="submit">Submit New Tag</button>
                                </div>

                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section>
@endsection