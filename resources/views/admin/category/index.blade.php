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
                <div class="card-header">liệt kê danh mục game</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{route('category.create')}}" class="btn btn-success">thêm danh mục </a>
                        <table class="table table-dark" id="myTablepp" style="width: 100%">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">tên danh mục</th>
                                <th scope="col">Slug danh mục</th>
                                <th scope="col">mô tả</th>
                                <th scope="col">hiển thị</th>
                                <th scope="col">hình ảnh</th>
                                <th scope="col">quản lý</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($category as $key => $cate)
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>{{$cate->title}}</td>
                                        <td>{{$cate->slug}}</td>
                                        <td>{{$cate->description}}</td>
                                        <td>
                                            @if($cate->status==0)
                                                không hiển thị
                                            @else
                                            hiển thị
                                            @endif
                                        </td>
                                        <td><img src="{{asset('public/uploads/category/'.$cate->image)}}" height="150px" weight="150px"></td>
                                  {{--xóa sửa --}}
                                        <td>
                                         <form action="{{route('category.destroy',[$cate->id])}}"method = "POST">
                                             @method('DELETE')
                                             @csrf
                                             <button onclick=" return confirm('bạn có muốn xóa danh mục này không ?');"class="btn btn-danger">delete</button>
                                         </form>
                                            <a href="{{route('category.edit', $cate->id)}}" class="btn btn-warning">sửa</a>
                                        </td>

{{--                                <tr>--}}
{{--                                    <th scope="row">1</th>--}}
{{--                                    <td>Mark</td>--}}
{{--                                    <td>Otto</td>--}}
{{--                                    <td>@mdo</td>--}}
{{--                                    <td>Jacob</td>--}}
{{--                                    <td>Thornton</td>--}}
{{--                                </tr>--}}
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
{{--                    {{$category->links('pagination::bootstrap-4')}}--}}



                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        let table = new DataTable('#myTablepp');
    });
</script>
