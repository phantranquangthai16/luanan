@extends('layouts.app')
@section('navbar')
    <div class="container">
        @include('admin.include.navbar')
    </div>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">liệt kê blog game</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{route('blog.create')}}" class="btn btn-success">thêm blog </a>
                    <table class="table table-dark" id="myTable">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">tên bài viết</th>
                            <th scope="col">Slug </th>
                            <th scope="col">mô tả</th>
                            <th scope="col">hiển thị</th>
                            <th scope="col">hình ảnh</th>
                            <th scope="col">quản lý</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($blogs as $key => $blog)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{$blog->title}}</td>
                                <td>{{$blog->slug}}</td>
                                <td>{{$blog->description}}</td>
                                <td>{!!$blog->content!!}</td>

                                <td>
                                    @if($blog->status==0)
                                        không hiển thị
                                    @else
                                        hiển thị
                                    @endif
                                </td>
                                <td><img src="{{asset('public/uploads/blog/'.$blog->image)}}" height="150px" weight="150px"></td>
                                <td>
                                    <form action="{{route('blog.destroy',[$blog->id])}}"method = "POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick=" return confirm('bạn có muốn xóa blog này không ?');"class="btn btn-danger">delete</button>
                                    </form>
                                    <a href="{{route('blog.edit', $blog->id)}}" class="btn btn-warning">sửa</a>
                                </td>


                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{$blogs->links('pagination::bootstrap-4')}}



                </div>
            </div>
        </div>
    </div>
@endsection
