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
                        <table id="post-table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>

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
            $('#post-table').DataTable({

                processing: true,
                serveSide: true,
                //    pageLength:20,
                ajax:"{{route('category.indexTable')}}",
                columns: [

                    {data: 'name', name:'name'},
                    {data: 'action', name:'action'}

                ]
            });
        });

    </script>
@stop
