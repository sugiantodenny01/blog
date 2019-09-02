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




    <section class="content">
        <div class="row">
            <!-- left column -->

            <!-- right column -->
            <div class="col-md-12">
                <!-- Horizontal Form -->

                <!-- general form elements disabled -->
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Post</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" action="{{route('post.update',['id'=>$post->id])}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <!-- text input -->
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control"  name="title" value="{{$post->title}}">
                            </div>
                            <div class="form-group">
                                <label>Featured Image</label>
                                <input type="file" name="featured" class="form-control" placeholder="Enter ..." enabled>
                            </div>
                            <div class="form-group">
                                <label>Select a category</label>
                                <select name="category_id" class="form-control"  enabled>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"
                                                @if($post->category->id == $category->id)
                                                 selected
                                                @endif
                                        >{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Select Tags</label>
                                @foreach($tag as $tag)

                                    <div class="checkbox">
                                        <label><input type="checkbox" name="tags[]" value="{{$tag->id}}"
                                            @foreach($post->tags as $t)

                                                @if($tag->id == $t->id)
                                                    checked
                                                @endif
                                            @endforeach
                                        >

                                            {{$tag->tag}}</label>

                                    </div>
                                @endforeach
                            </div>


                            <div class="form-group">
                                <label>Content</label>
                                <textarea class="form-control"  name='konten' rows="3" placeholder="Enter ...">{{$post->content}}</textarea>
                            </div>


                            <div class="form-group">
                                <div class="text-center">
                                    <button class="btn btn-success" type="submit">Update Post</button>
                                </div>

                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section>

@endsection