<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Language;
use App\Model\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        return view('admin.language.index', compact('languages'));
    }

    public function add()
    {
        return view('admin.language.add');
    }

    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|max:255',
            'direction' => 'required',
            'code' => [
                'required',
                'max:255'
            ]
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $data = file_get_contents(resource_path('lang/') . 'default.json');
        $json_file = trim(strtolower($request->code)) . '.json';
        $path = resource_path('lang/') . $json_file;

        File::put($path, $data);


        $in['name'] = $request->name;
        $in['code'] = $request->code;
        $in['direction'] = $request->direction;
        if (Language::where('is_default', 1)->count() > 0) {
            $in['is_default'] = 0;
        } else {
            $in['is_default'] = 1;
        }
        $lang_id = Language::create($in)->id;




        // Settings Create by language
        $newlangsetting = new Setting();
        $newlangsetting->language_id = $lang_id;
        $newlangsetting->website_title = 'website_title';
        $newlangsetting->base_color = '983ce9';
        $newlangsetting->website_logo = 'header_logo';
        $newlangsetting->fav_icon = 'fav_icon';
        $newlangsetting->breadcrumb_image = 'breadcrumb_image';
        $newlangsetting->number = 'number';
        $newlangsetting->email = 'email';
        $newlangsetting->contactemail = 'contactemail';
        $newlangsetting->address = 'address';
        $newlangsetting->footer_text = 'footer_text';
        $newlangsetting->meta_keywords = 'meta_keywords';
        $newlangsetting->meta_description = 'meta_description';
        $newlangsetting->copyright_text = 'copyright_text';

        $newlangsetting->about_title = 'about_title';
        $newlangsetting->about_subtitle = 'about_subtitle';
        $newlangsetting->about_image = 'about_image';
        $newlangsetting->product_title = 'product_title';
        $newlangsetting->save();

        $notification = array(
            'messege' => 'Language added successfully!',
            'alert' => 'success'
        );
        return redirect()->route('admin.language.index')->with('notification', $notification);
    }

    public function edit($id)
    {
        $language = Language::where('id', $id)->first();
        return view('admin.language.edit', compact('language'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|max:255',
            'direction' => 'required',
            'code' => [
                'required',
                'max:255'
            ]
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $data = file_get_contents(resource_path('lang/') . 'default.json');
        $json_file = trim(strtolower($request->code)) . '.json';
        $path = resource_path('lang/') . $json_file;

        File::put($path, $data);

        $language = Language::where('id', $id)->first();

        $language->name = $request->name;
        $language->code = $request->code;
        $language->direction = $request->direction;
        $language->save();

        $notification = array(
            'messege' => 'Language Updated successfully!',
            'alert' => 'success'
        );
        return redirect()->route('admin.language.index')->with('notification', $notification);
    }


    public function editKeyword($id){
        $lang = Language::where('id', $id)->first();
        $page_name = 'Update '.$lang->name.' Language Keywords';

        $json =  file_get_contents(resource_path('lang/') . $lang->code.'.json');

        if(empty($json)){
            return back()->with('warning','File Note Found');
        }
        return view('admin.language.edit-keyword', compact('page_name', 'json', 'lang'));


    }


    public function delete($id){
        $lang = Language::where('id', $id)->first();
        if($lang->is_default == 1){
            $notification = array(
                'messege' => 'Default Language Cannot be Deleted',
                'alert' => 'warning'
            );
            return redirect()->route('admin.language.index')->with('notification', $notification);
        }

         @unlink(resource_path('lang/') . $lang->code . '.json');
        if (session()->get('lang') == $lang->code) {
          session()->forget('lang');
        }


        $setting = Setting::where('language_id', $id)->first();
        $setting->delete();
        $lang->delete();

        $notification = array(
          'messege' => 'Language Delete Successfully',
          'alert' => 'success'
        );
        return redirect()->route('admin.language.index')->with('notification', $notification);
    }

    public function default(Request $request, $id){
        Language::where('is_default', 1)->update(['is_default' => 0]);
        $lang = Language::find($id);
        $lang->is_default = 1;
        $lang->save();

        $notification = array(
          'messege' => 'laguage is set as defualt.',
          'alert' => 'success'
        );

        return redirect()->route('admin.language.index')->with('notification', $notification);
    }

}
