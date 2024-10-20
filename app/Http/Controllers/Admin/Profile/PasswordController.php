<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Rules\CheckOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
class PasswordController extends Controller
{
    public function edit()
    {
        // $password = 'pass1234';
        // $encryptedPassword = encrypt($password);
        // $decryptedPassword = decrypt($encryptedPassword);
        // $y == $decryptedPassword ;// true
        return view('admin.profile.password.edit');

    }// end of getChangePassword

    public function update(Request $request)
    {
        $request->validate([
            'old_password' => ['required', new CheckOldPassword],
            'password' => 'required|confirmed'
        ]);
        $user = auth()->user();
        if (!empty($request->password) && !Hash::check($request->password, $user->password)) {
            $data['password'] = bcrypt($request->password);
        }
        // $request->merge(['password' => bcrypt($request->password)]);
        $user->update(['password'=>bcrypt($request->password)]);
        Alert::success('تمت التعديل بنجاح', 'password updated successfully');
        return redirect()->route('admin.home');

    }// end of postChangePassword

}//end of controller
