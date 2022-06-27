<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Pcategory;
use App\Model\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{

    public function slider(Request $request)
    {

        $sliders = Slider::orderBy('id', 'DESC')->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function sliderAdd()
    {
        $pcategories = Pcategory::all();
        return view('admin.slider.add', compact('pcategories'));
    }

    public function sliderStore(Request $request)
    {
        $request->validate([
            'pcategory_id'  => 'required',
            'image'        => 'required|mimes:jpg,jpeg,png',
            'name'         => 'required|max:200',
        ]);

        $slider = new Slider();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = 'sliderImage' . time() . rand() . '.' . $extension;
            $file->move('assets/front/img/', $image);

            $slider->image = $image;
        }

        $slider->pcategory_id = $request->pcategory_id;
        $slider->name        = $request->name;
        $slider->status      = $request->status;
        $slider->save();

        $notification = array(
            'messege' => 'Slider Added Successfully',
            'alert'   => 'success'
        );

        return redirect()->back()->with('notification', $notification);
    }

    public function sliderEdit($id)
    {
        $pcategories = Pcategory::all();

        $slider = Slider::where('id', $id)->first();

        return view('admin.slider.edit', compact('slider', 'pcategories'));
    }

    public function sliderUpdate(Request $request, $id)
    {

        $request->validate([
            'pcategory_id'  => 'required',
            'name'         => 'required|max:200',
        ]);
        $slider = Slider::where('id', $id)->first();

        if ($request->hasFile('image')) {
            @unlink('assets/front/img/' . $slider->image);
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = 'sliderImage' . time() . rand() . '.' . $extension;
            $file->move('assets/front/img/', $image);

            $slider->image = $image;
        }


        $slider->pcategory_id = $request->pcategory_id;
        $slider->name        = $request->name;
        $slider->status      = $request->status;
        $slider->save();

        $notification = array(
            'messege' => 'Slider Updated Successfully',
            'alert'   => 'success'
        );

        return redirect(route('admin.slider'))->with('notification', $notification);
    }

    public function sliderDelete($id){
        $slider = Slider::where('id', $id)->first();

        @unlink('assets/front/img/' . $slider->image);
        $slider->delete();

        $notification = array(
            'messege' => 'Slider Deleted Successfully',
            'alert'   => 'success'
        );

        return redirect()->back()->with('notification', $notification);
    }
}
