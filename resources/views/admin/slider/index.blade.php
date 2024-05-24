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
                <div class="card-header">liệt kê slider game</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{route('slider.create')}}" class="btn btn-success">thêm slider game </a>
                        <table class="table table-dark" id="myTable">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">tên slider</th>
                                <th scope="col">mô tả</th>
                                <th scope="col">hiển thị</th>
                                <th scope="col">hình ảnh</th>
                                <th scope="col">quản lý</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($slider as $key => $sli)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$sli->title}}</td>
                                    <td>{{$sli->description}}</td>
                                    <td>
                                        @if($sli->status==0)
                                            không hiển thị
                                        @else
                                            hiển thị
                                        @endif
                                    </td>
                                    <td><img src="{{asset('public/uploads/slider/'.$sli->image)}}" height="150px" weight="150px"></td>
                                    {{--xóa sửa --}}
                                    <td>
                                        <form action="{{route('slider.destroy',[$sli->id])}}"method = "POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick=" return confirm('bạn có muốn xóa slider này không ?');"class="btn btn-danger">delete</button>
                                        </form>
                                        <a href="{{route('slider.edit', $sli->id)}}" class="btn btn-warning">sửa</a>
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
                        {{$slider->links('pagination::bootstrap-4')}}



                </div>
            </div>
        </div>
    </div>
@endsection
