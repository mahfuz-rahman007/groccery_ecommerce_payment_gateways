<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Language;
use App\Model\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default', 1)->first();
    }

    public function basicinfo(Request $request)
    {
        $lang = Language::where('code', $request->language)->first()->id;
        $basicinfo = Setting::where('language_id', $lang)->first();
        $commonsetting = Setting::where('id', 1)->first();

        return view('admin.setting.basicinfo', compact('basicinfo', 'commonsetting'));
    }

    public function updatebasicinfo(Request $request, $id)
    {
        $lang = Language::where('id', $id)->first();
        $request->validate([
            'website_title'  => 'required|max:255',
            'address'  => 'required|max:255'
        ]);

        $basicinfo = Setting::where('language_id', $id)->first();

        $basicinfo->website_title = $request->website_title;
        $basicinfo->address = $request->address;
        $basicinfo->save();


        $notification = array(
            'messege' => 'Basic Info Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.setting.basicinfo') . '?language=' . $lang->code)->with('notification', $notification);
    }

    public function updatecommoninfo(Request $request)
    {
        $request->validate([
            'number' => 'required|max:250',
            'email' => 'required|max:250',
            'contactemail' => 'required|max:250',
            'base_color' => 'required',
            'website_logo' => 'mimes:jpeg,jpg,png,svg',
            'fav_icon' => 'mimes:jpeg,jpg,png',
            'breadcrumb_image' => 'mimes:jpeg,jpg,png'
        ]);


        $commonsetting = Setting::where('id', 1)->first();

        if ($request->hasFile('website_logo')) {
            @unlink('assets/front/img/' . $commonsetting->website_logo);
            $file = $request->file('website_logo');
            $extension = $file->getClientOriginalExtension();
            $website_logo = 'website_logo' . time() . rand() . '.' . $extension;
            $file->move('assets/front/img/', $website_logo);
            $commonsetting->website_logo = $website_logo;
        }

        if ($request->hasFile('fav_icon')) {
            @unlink('assets/front/img/' . $commonsetting->fav_icon);
            $file = $request->file('fav_icon');
            $extension = $file->getClientOriginalExtension();
            $fav_icon = 'fav_icon_' . time() . rand() . '.' . $extension;
            $file->move('assets/front/img/', $fav_icon);
            $commonsetting->fav_icon = $fav_icon;
        }

        if ($request->hasFile('breadcrumb_image')) {
            @unlink('assets/front/img/' . $commonsetting->breadcrumb_image);
            $file = $request->file('breadcrumb_image');
            $extension = $file->getClientOriginalExtension();
            $breadcrumb_image = 'breadcrumb_image_' . '.' . $extension;
            $file->move('assets/front/img/', $breadcrumb_image);
            $commonsetting->breadcrumb_image = $breadcrumb_image;
        }

        $commonsetting->number = $request->number;
        $commonsetting->email = $request->email;
        $commonsetting->contactemail = $request->contactemail;

        $new_base_color = ltrim($request->base_color, '#');
        $commonsetting->base_color = $new_base_color;


        $commonsetting->save();

        $notification = array(
            'messege' => 'Basic Info Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.setting.basicinfo') . '?language=' . $this->lang->code)->with('notification', $notification);
    }

    public function seoinfo(Request $request)
    {
        $lang = Language::where('code', $request->language)->first()->id;
        $seoinfo = Setting::where('language_id', $lang)->first();

        return view('admin.setting.seoinfo', compact('seoinfo'));
    }

    public function seoinfoUpdate(Request $request, $id)
    {

        $request->validate([
            'meta_keywords' => 'required',
            'meta_description' => 'required'
        ]);

        $lang = Language::where('id', $id)->first();
        $seo = Setting::where('language_id', $id)->first();

        $seo->meta_keywords = $request->meta_keywords;
        $seo->meta_description = $request->meta_description;
        $seo->save();

        $notification = array(
            'messege' => 'Basic Info Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.seoinfo') . '?language=' . $lang->code)->with('notification', $notification);
    }
}
