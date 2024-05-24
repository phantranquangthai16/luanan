
@extends('layouts.app')
@section('navbar')
    <div class="container">
        @include('admin.include.navbar')
    </div>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">cập nhật blog game</div>
                @if($errors->any())
                    <div class ="alert alert-danger">
                        <ul>
                            @foreach($errors-> all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{route('blog.index')}}" class="btn btn-success">liệt kê blog game </a>
                    <a href="{{route('blog.create')}}" class="btn btn-success">thêm blog game </a>
                    <form action="{{route('blog.update',$blog->id)}}"method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tittle</label>
                            <input type="text" class="form-control" value="{{$blog->title}}" onkeyup="ChangeToSlug();" id="slug" value="{{$blog->title}}" name="title" placeholder="...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" class="form-control" value="{{$blog->slug}}" required value="{{$blog->slug}}" id="convert_slug" name="slug" placeholder="...">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>
                            <textarea class=form-control name="desc_blog" value="{{$blog->description}}" required placeholder="...">{{$blog->description}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Content</label>
                            <textarea class=form-control name="content_blog" value="{{$blog->content}}" required placeholder="...">{{$blog->content}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Image</label>
                            <input type="file" class="form-control-file" name="image" >
                            <td><img src="{{asset('public/uploads/blog/'.$blog->image)}}" height="150px" weight="150px"></td>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Status</label>
                            <select class="form-control" value="{{$blog->status}}" required name="status" >
                                @if($blog->status==1)
                                    <option value="1"selected>hiển thị</option>
                                    <option value="0">không hiển thị</option>
                                @else
                                    <option value="1">hiển thị</option>
                                    <option value="0"selected>không hiển thị</option>
                                @endif
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">cập nhật</button>
                    </form>


                </div>
            </div>
        </div>


@endsection
