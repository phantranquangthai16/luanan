<?php

namespace App\Http\Controllers;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use App\Models\Category;





class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::orderBy('id', 'DESC')->get();
        return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //danh muc game
        $category = Category::orderBy('id', 'DESC')->get();

        return view('admin.category.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $data = $request -> validate(
            [
                'title'=>'required|unique:categories|max:255',
                'slug'=>'required|unique:categories|max:255',
                'description'=>'required|max:255',
                'image'=>'required|image|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'status'=>'required',
            ],
            [
                'title.unique'=>'tên danh mục đã có xin điền tên khác',
                'title.required'=>'tên danh mục game phải có',
                'slug.unique'=>'tên slug danh mục đã có xin điền tên khác',
                'slug.required'=>'tên slug danh mục game phải có',
                'description.required'=>'mô tả danh mục game phải có nhé',
                'image.required'=>'hình ảnh phải có nhé',
            ]
        );


        $category = new Category();
        $category -> title = $data['title'];
        $category -> slug = $data['slug'];
        $category -> description = $data['description'];
        $category -> status =  $data['status'];
        // thêm ảnh vào folder .....
        $get_image = $request->file('image');
        $path = 'public/uploads/category/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $category->image = $new_image;
        $category -> save();
        return redirect()->route('category.index')-> with('status','thêm mục thành công');
//         $category = \DB::table('categories')->insert([
//            'title' => $data['title'] ?? '',
//            'description' => $data['description'] ?? '',
//            'status' => (int) $data['status'],
//            'image' => $data['image']
//        ]);

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

            $category = Category::find($id);
            return view('admin.category.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request -> validate(
            [
                'title'=>'required|max:255',
                'slug'=>'required|max:255',
                'description'=>'required|max:255',
                'status'=>'required',
            ],
            [
                'title.required'=>'tên danh mục game phải có',
                'slug.required'=>'tên slug danh mục game phải có',
                'description.required'=>'mô tả danh mục game phải có nhé',

            ]
        );
        $category = Category::find($id);
        $category->title = $data['title'];
        $category->slug = $data['slug'];

        $category->description = $data['description'];
        $category->status = $data['status'];
        // thêm ảnh vào folder .....
        $get_image = $request->image;
        if ($get_image){
            $path_unlink = 'public/uploads/category/'.$category->image;
            if(file_exists($path_unlink)){
                unlink($path_unlink);
                }
                $path = 'public/uploads/category/';
                $get_name_image = $get_image->getClientOriginalName(); // hinh 123.png
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move($path, $new_image);
                $category->image = $new_image;
            }
            $category->save();
            return redirect()->route('category.index')-> with('status','cập nhật mục thành công');
        }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = category::find($id);

        if (!empty($category->image)){
            $path_unlink = 'public/uploads/category/'.$category->image;

            if(file_exists($path_unlink)){
                unlink($path_unlink);
            }
        }

        $category->delete();
        return redirect()->back()-> with('status','xóa mục thành công');
    }
}
