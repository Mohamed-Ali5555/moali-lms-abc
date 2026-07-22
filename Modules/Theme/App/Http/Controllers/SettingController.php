<?php

namespace Modules\Theme\App\Http\Controllers;
use App\Models\FileUploader;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Theme\App\Models\theme_setting;
use Modules\Theme\App\Models\theme_social;
use Modules\Theme\App\Models\theme_feature;

use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
  // start settings section
   public function settings()
    {
        return view('theme::setting.theme_setting');
    }
    public function settings_store(Request $request, $param1 = '', $id = '')
    {
        // dd($request->all());
        $data = $request->except('_token');

        if ($param1 == 'theme_settings') {
            // Validate file uploads if present
            $request->validate([
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:48048',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:48048',
                'dark_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:48048',
                'dark_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:48048',
                'name' => 'required|string|max:255'
            ]);
            foreach ($data as $key => $item) {
                // Handle file uploads for theme settings
                if (in_array($key, ['thumbnail', 'logo', 'dark_thumbnail', 'dark_logo']) && $request->hasFile($key)) {
                    $file = $request->file($key);
                    $filePath = "uploads/theme-thumbnail/" . nice_file_name($request->input('name'), $file->extension());

                    // Upload the file
                    FileUploader::upload($file, $filePath, 500, null, 200, 200);

                    // Save to database
                    theme_setting::updateOrCreate(
                        ['type' => $key],
                        ['description' => $filePath]
                    );
                }else{
                    if ($request->has($key)) {
                        theme_setting::updateOrCreate(
                        ['type' => $key],
                        ['description' => $item]
                    );
                }
                }
            }

            $page_data['tab'] = $request->query('tab', 'theme-settings'); // استخدام Laravel's query helper
            Session::flash('success', get_phrase('Theme setting updated successfully'));
        }

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'msg'    => 'Theme setting updated successfully',
            ]);
        } else {
            return redirect()->back();
        }
    }
  // start settings section

  // start social section

    public function social(){
        $social = theme_social::get();
        return view('theme::setting.social_media',compact('social'));

    }

    public function create_social(){
        return view('theme::setting.create_social');

    }
    public function social_store(Request $request){

        // return $request->all();


        $validated = $request->validate([
            'title'     => 'required|max:255',
            'url'       => 'required|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);


        $data['title'] = $request->title;
        $data['url'] = $request->url;
        $data['status'] = $request->status;

        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        if(isset($request->thumbnail)){
            $data['thumbnail'] = "theme-thumbnail-thumbnail/" . nice_file_name($request->title, $request->thumbnail->extension());
            FileUploader::upload($request->thumbnail, $data['thumbnail'], 500, null, 200, 200);
        }



        theme_social::insert($data);

        return redirect(route('admin.theme.social'))->with('success', get_phrase('social added successfully'));

    }
    public function social_delete($id){
        // check user data exists or not
        $query = theme_social::where('id', $id)->first();
        if ($query->doesntExist()) {
            Session::flash('error', get_phrase('Data not found.'));
            return redirect()->back();
        }

        $query->delete();
        Session::flash('success', get_phrase('social has ben deleted successfully.'));
        return redirect()->back();
    }
   // end social section





    // start feature section
    public function feature(){
        $features = theme_feature::get();
        return view('theme::setting.feature',compact('features'));

    }

    public function create_feature(){
        return view('theme::setting.create_feature');

    }
    public function feature_store(Request $request){

        $validated = $request->validate([
            'title' => 'required|max:255',
            // 'color' => 'required|max:255',
            // 'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);


        $data['title'] = $request->title;
        $data['color'] = null;
        $data['status'] = $request->status;

        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['thumbnail'] = null;
        // if(isset($request->thumbnail)){
        //     $data['thumbnail'] = "theme-thumbnail-thumbnail/" . nice_file_name($request->title, $request->thumbnail->extension());
        //     FileUploader::upload($request->thumbnail, $data['thumbnail'], 500, null, 200, 200);
        // }



        theme_feature::insert($data);

        return redirect(route('admin.theme.feature'))->with('success', get_phrase('feature added successfully'));

    }
    public function feature_delete($id){
        // check user data exists or not
        $query = theme_feature::where('id', $id)->first();
        if ($query->doesntExist()) {
            Session::flash('error', get_phrase('Data not found.'));
            return redirect()->back();
        }

        $query->delete();
        Session::flash('success', get_phrase('feature deleted successfully.'));
        return redirect()->back();
    }
   public function activeFeature($id)
    {
        $feature = theme_feature::where('id', $id)->first();
        if($feature->status == 1){

            $feature->update(['status' => 0]);
        }else{
            $feature->update(['status' => 1]);
        }


        Session::flash('success', get_phrase('feature updated successfully.'));
        return redirect()->back();    }
   // end feature section

}
