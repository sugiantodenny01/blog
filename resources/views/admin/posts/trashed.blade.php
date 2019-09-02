@extends('layouts.starter')

@section('content')



    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        {{--<h3 class="box-title">Data Table With Full Features</h3>--}}
                    </div><!-- /.box-header -->
                    @if($post->count()>0)
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="contact-table" class="table table-bordered table-striped">
                                <thead>
                                <tr>

                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Featured</th>


                                    <th class="col-xs-4">Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                    @else
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="contact-tables" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>

                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Featured</th>


                                        <th class="col-xs-4">Action</th>


                                    </tr>

                                    <tr>

                                            <td colspan="4" class="text-center" >No Trashed Posts</td>


                                    </tr>


                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif

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
                ajax:"{{route('post.trashTable')}}",
                columns: [


                    {data:'title', name:'title'},
                    {data:'content', name:'content'},
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
