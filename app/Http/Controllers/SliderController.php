<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slider = Slider::orderBy('id', 'DESC')->paginate(5);
        return view('admin.slider.index', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request -> validate(
            [
                'title'=>'required|unique:slider|max:255',

                'description'=>'required|max:255',
                'image'=>'required|image|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'status'=>'required',
            ],
            [
                'title.unique'=>'tên danh mục đã có xin điền tên khác',
                'title.required'=>'tên danh mục game phải có',
                'description.required'=>'mô tả danh mục game phải có nhé',
                'image.required'=>'hình ảnh phải có nhé',
            ]
        );


        $slider = new Slider();
        $slider -> title = $data['title'];
        $slider-> description = $data['description'];
        $slider-> status =  $data['status'];
        // thêm ảnh vào folder .....
        $get_image = $request->file('image');
        $path = 'public/uploads/slider/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $slider->image = $new_image;
        $slider -> save();
        return redirect()->route('slider.index')-> with('status','thêm slider game thành công');
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

        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request -> validate(
            [
                'title'=>'required|max:255',

                'description'=>'required|max:255',
                'image'=>'image|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'status'=>'required',
            ],
            [

                'title.required'=>'tên danh mục game phải có',
                'description.required'=>'mô tả danh mục game phải có nhé',

            ]
        );


        $slider =Slider::find($id);
        $slider -> title = $data['title'];
        $slider-> description = $data['description'];
        $slider-> status =  $data['status'];
        // thêm ảnh vào folder .....
        $get_image = $request->file('image');
        if($get_image){
            $path_unlink = 'public/uploads/slider/'.$slider->image;
            if(file_exists($path_unlink)){
                unlink($path_unlink);
            }
        $path = 'public/uploads/slider/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $slider->image = $new_image;
        }

        $slider -> save();
        return redirect()->route('slider.index')-> with('status','cập nhật slider game thành công');
//         $category = \DB::table('categories')->insert([
//            'title' => $data['title'] ?? '',
//            'description' => $data['description'] ?? '',
//            'status' => (int) $data['status'],
//            'image' => $data['image']
//        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::find($id);

        if (!empty($slider->image)){
            $path_unlink = 'public/uploads/slider/'.$slider->image;

            if(file_exists($path_unlink)){
                unlink($path_unlink);
            }
        }

        $slider->delete();
        return redirect()->back()-> with('status','xóa mục thành công');
    }
}
