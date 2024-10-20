<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:read_settings')->only(['index', 'socialLinks', 'socialLogin']);

    // }// end of __construct

    public function general()
    {
        return view('admin.settings.general');

    }// end of index

    public function store(Request $request)
    {
        $request->validate([
            'website_name' => 'required|string|max:10',
            'title' => 'required',
            'email' => 'sometimes|nullable|email',
            'logo' => 'sometimes|nullable',
            'fav_icon' => 'sometimes|nullable',
            'link' => 'nullable',
            'website_active' => 'required|boolean',
        ]);

        $requestData = $request->except(['_token', '_method']);

        if ($request->logo) {
            Storage::disk('local')->delete('public/uploads/' . setting('logo'));
            $request->logo->store('public/uploads');
            $requestData['logo'] = $request->logo->hashName();
        }

        if ($request->fav_icon) {
            Storage::disk('local')->delete('public/uploads/' . setting('fav_icon'));
            $request->fav_icon->store('public/uploads');
            $requestData['fav_icon'] = $request->fav_icon->hashName();
        }
        setting($requestData)->save();
        Alert::success('all data saved successfully', 'all data saved successfully');
        return redirect()->back();
    }// end of store

}//end of controller


