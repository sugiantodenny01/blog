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
                        <form role="form" action="{{route('setting.update')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <!-- text input -->
                            <div class="form-group">
                                <label>Site name</label>
                                <input type="text" class="form-control" value="{{$setting->site_name}}"  name="site_name" placeholder="Enter ...">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" value="{{$setting->address}}"  name="address" placeholder="Enter ...">
                            </div>
                            <div class="form-group">
                                <label>Contact number</label>
                                <input type="text" class="form-control" value="{{$setting->contact_number}}"  name="contact_number" placeholder="Enter ...">
                            </div>
                            <div class="form-group">
                                <label>Contact email</label>
                                <input type="email" class="form-control" value="{{$setting->contact_email}}"  name="contact_email" placeholder="Enter ...">
                            </div>

                            <div class="form-group">
                                <div class="text-center">
                                    <button class="btn btn-success" type="submit">Update setting</button>
                                </div>

                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section>
@endsection