<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    protected $models =
       [
        'admins','users','settings'
       ];
    protected $permissionMaps = ['create', 'read', 'update', 'delete'];
    public function index()
    {
        return view('admin.admins.index');
    }// end of index
    public function data()
    {
        $users = User::where('type', 'admin')->select();
        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('record_select', 'admin.admins.data_table.record_select')
            ->editColumn('created_at', function (User $user) {
                return $user->created_at->format('Y-m-d');
            })
            ->addColumn('status', function (User $user) {
                return view('admin.admins.data_table.status', compact('user'));
            })
            ->addColumn('image', function (User $user) {
                return view('admin.admins.data_table.image', compact('user'));
            })
            ->addColumn('actions', 'admin.admins.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();
    }// end of data

    public function create()
    {
        $models=$this->models;
        $permissionMaps=$this->permissionMaps;
        return view('admin.admins.create', compact('models','permissionMaps'));

    }// end of create

    public function store(AdminRequest $request)
    {
        try{
            $input['name'] = $request->name;
            $input['status'] = $request->status;
            $input['email'] = $request->email;
            $input['email_verified_at'] = now();
            $input['password'] = bcrypt($request->password);
            $input['phone'] = $request->phone;
            $input['type'] = 'admin';
            if (request('image')) {
                $input['image'] = store_file(request('image'), 'users');
            }
            // if ($image = $request->file('image')) {
            //     $file_name = Str::slug($request->firstname).".".$image->getClientOriginalExtension();
            //     $path = public_path('/images/admins/' . $file_name);
            //     Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
            //         $constraint->aspectRatio();
            //     })->save($path, 100);
            //     $input['image'] = $file_name;
            // }
            $user=User::create($input);
            $user->syncPermissions($request->permissions);
            Alert::success('تمت الاضافه بنجاح', 'admin created successfully');
            return redirect()->route('admin.admins.index');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function edit(User $admin)
    {
        $models=$this->models;
        $permissionMaps=$this->permissionMaps;
        return view('admin.admins.edit',compact('admin','models','permissionMaps'));
    }


    public function update(AdminRequest $request, User $admin)
    {
        $input = $request->except(['password','password_confirmation','permissions']);
        $input['name'] = $request->name;
        $input['status'] = $request->status;
        $input['email'] = $request->email;
        $input['phone'] = $request->phone;
        if(trim($request->password) != ''){
            $input['password'] = bcrypt($request->password);
        }
        if ($request->file('image')) {
            if ($admin->image != 'users/LOGO.png') {
                delete_file($admin->getRawOriginal('image'));
            }
            $input['image'] = store_file($request->file('image'), 'users');
        }
        // if ($image = $request->file('image')) {
        //     if($admin->image != null && file_exists(public_path('/images/admins/' . $admin->image))){
        //         unlink('images/admins/' . $admin->image);
        //     }
        //     $file_name = Str::slug($request->firstname).".".$image->getClientOriginalExtension();
        //     $path = public_path('/images/admins/' . $file_name);
        //     Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
        //         $constraint->aspectRatio();
        //     })->save($path, 100);
        //     $input['image'] = $file_name;
        // }
        $admin->update($input);
        $admin->syncPermissions($request->permissions);
        Alert::success('تمت التعديل بنجاح', 'admin updated successfully');
        return redirect()->route('admin.admins.index');
    }

    public function destroy(User $admin)
    {
        // if($admin->image != null && file_exists(public_path('/images/admins/' . $admin->image))){
        //     unlink('images/admins/' . $admin->image);
        // }
        if ($admin->image != 'users/LOGO.png') {
            delete_file($admin->getRawOriginal('image'));
        }
        $admin->delete();
        Alert::success('تمت الحذف بنجاح', 'admin deleted successfully');
        return redirect()->back();
    }

    public function change_status($id)
    {
        $adminID = Crypt::decrypt($id);
        $admin = User::findorfail($adminID);
        ($admin->status == '1') ? $admin->status = 0 : $admin->status = 1;
        $admin->update();
        session()->flash('success', __('admins.change-succes'));
        return redirect()->back();
    }

    public function bulkDelete(Request $request)
    {
        try {
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $admins_ids) {
                    $user = User::findorfail($admins_ids);
                    if ($user->image != 'users/LOGO.png') {
                        delete_file($user->getRawOriginal('image'));
                    }
                    // if($admin->image != null && file_exists(public_path('/images/admins/' . $admin->image))){
                    //     unlink('images/admins/' . $admin->image);
                    // }
                }
            } else {
                Alert::error('لم يتم تحديد أي عنصر', 'لم يتم تحديد أي عنصر');
                // Alert::toast('Toast Message', 'Toast Type');
                return redirect()->back();
            }
            User::destroy($delete_select_id);
            Alert::success('all data deleted successfully', 'admins deleted successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error($e->getMessage(), 'حدث خطأ غير متوقع');
            return redirect()->back();
        }
    }// end of bulkDelete
}
