<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('admin.profile.edit');

    }// end of getChangeData

    public function update(ProfileRequest $request)
    {
        $input = $request->validated();
        // if ($request->image) {
        //     if (auth()->user()->hasImage()) {
        //         Storage::disk('local')->delete('public/uploads/' . auth()->user()->image);
        //     }
        //     $request->image->store('public/uploads');
        //     $requestData['image'] = $request->image->hashName();
        // }//end of if
        if ($request->file('image')) {
            if (auth()->user()->image != 'users/LOGO.png') {
                delete_file(auth()->user()->getRawOriginal('image'));
            }
            $input['image'] = store_file($request->file('image'), 'users');
        }
        auth()->user()->update($input);
        Alert::success('تمت التعديل بنجاح', 'admin updated successfully');
        return redirect()->back();

    }// end of postChangeData

}//end of controller
