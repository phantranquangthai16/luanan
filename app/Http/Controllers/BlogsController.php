<?php

namespace App\Http\Controllers;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::OrderBy('id', 'desc')->paginate(10);
        return view('admin.blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $blog = new Blog();
        $blog->title = $data['title'];
        $blog->description= $data['desc_blog'];
        $blog->slug = $data['slug'];
        $blog->status = $data['status'];
        $blog->content = $data['content_blog'];
//        $blog->image = '123.jpg';
//        $blog->save();
//        return redirect()->route('blog.index');
        // thêm ảnh vào folder .....
        $get_image = $request->image;
        if($get_image){
            $path = 'public/uploads/blog/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $blog->image = $new_image;
        }

        $blog -> save();
        return redirect()->route('blog.index')-> with('status','thêm mục thành công');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::find($id);
        return view('admin.blog.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {

//                'title'=>'required|max:255',
//                'slug'=>'required|max:255',
//                'description'=>'required|max:255',
//                'status'=>'required',
//            ],
//            [
//                'title.required'=>'tên danh mục game phải có',
//                'slug.required'=>'tên slug danh mục game phải có',
//                'description.required'=>'mô tả danh mục game phải có nhé',
//
//            ]
        $data = $request -> all(

        );
        $blog = Blog::find($id);
        $blog->title = $data['title'];
        $blog->slug = $data['slug'];

        $blog->description = $data['desc_blog'];
        $blog->content = $data['content_blog'];
        $blog->status = $data['status'];
        // thêm ảnh vào folder .....
        $get_image = $request->image;
        if ($get_image){
            $path_unlink = 'public/uploads/blog/'.$blog->image;
            if(file_exists($path_unlink)){
                unlink($path_unlink);
            }
            $path = 'public/uploads/blog/';
            $get_name_image = $get_image->getClientOriginalName(); // hinh 123.png
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $blog->image = $new_image;
        }
        $blog->save();
        return redirect()->route('blog.index')-> with('status','cập nhật mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog=Blog::find($id)->delete();
        return redirect()->back();

    }
}
