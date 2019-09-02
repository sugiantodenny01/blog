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

                                <th>Title</th>
                                <th>Content</th>
                                <th>Featured</th>


                                <th class="col-xs-5">Action</th>

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
        $(function () {
            $('#contact-table').DataTable({
              //
                processing: true,
                serveSide: true,
                // responsive: true,
                //    pageLength:20,
                ajax:"{{route('post.indexTable')}}",
                columns: [


                    {data:'title', name:'title'},
                    {data:'content', name:'content',render:function (data) {
                        let a = data;

                       if (a !== null) {
                           return a


                       }

                        }},
                    {data:'featured', name:'featured',
                        "render": function(data) {
                            return '<img src="{{ url('/') }}/'+data+'" width="40" />';
                        }},
                    {data: 'action', name:'action'}



                ]
            });
        });

    </script>
@stop
