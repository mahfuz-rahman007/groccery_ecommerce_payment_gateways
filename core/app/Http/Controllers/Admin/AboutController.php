<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Language;
use App\Model\Setting;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default', 1)->first();
    }

    public function about(Request $request)
    {
        $lang = Language::where('code', $request->language)->first()->id;

        $aboutSectiontitle = Setting::where('language_id', $lang)->first();

        return view('admin.about.index', compact('aboutSectiontitle'));
    }

    public function aboutContentUpdate(Request $request, $id)
    {

        $request->validate([
            'about_title'    => 'required',
            'about_subtitle' => 'required',
            'about_image'    => 'mimes:jpg,jpeg,png'
        ]);

        $lang = Language::where('id', $id)->first();
        $about = Setting::where('language_id', $id)->first();

        if ($request->hasFile('about_image')) {
            @unlink('assets/front/img/' . $about->about_image);
            $file = $request->file('about_image');
            $extension = $file->getClientOriginalExtension();
            $about_image = 'about_image' . time() . rand() . '.' . $extension;
            $file->move('assets/front/img/', $about_image);
            $about->about_image = $about_image;
        }

        $about->about_title    = $request->about_title;
        $about->about_subtitle = $request->about_subtitle;

        $about->save();

        $notification = array(
            'messege' => 'About Content Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.about') . '?language=' . $lang->code)->with('notification', $notification);
    }
}
