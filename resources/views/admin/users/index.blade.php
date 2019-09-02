@extends('layouts.starter')

@section('content')



    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        {{--<h3 class="box-title">Data Table With Full Features</h3>--}}
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="contact-table" class="table table-bordered table-striped">
                                <thead>
                                <tr>

                                    {{--<th>Image</th>--}}
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th width="3%">Permissions</th>

                                    <th width="3%">Change</th>
                                    <th width="3%">Delete</th>

                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section>


@stop
@section('script')
    <script type="text/javascript">
       // let admin='wkkwkw';
        $(function () {
            $('#contact-table').DataTable({
                processing: true,
                serveSide: true,

                //responsive: true,
                // pageLength:20,
                ajax:"{{route('users.indexTable')}}",

                columns: [


                    {data:'name', name:'name'},
                    {data:'profile.avatar', name:'profile.avatar',
                        "render": function(data) {
                            return '<img src="{{ url('/') }}/'+data+'" width="90" />';
                        }},

                    {data:'admin', name:'admin',render:function (data) {
                            if (data==1){
                                return data='Admin';
                            }else {
                                return data='Not admin'
                            }
                    }},
                    {data:'action', name:'action'},
                    {data:'delete', name:'delete'},

                ]
            });
        });
    </script>
@stop
