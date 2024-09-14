<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
class UsersController extends Controller
{
    use UserTrait;
//    public function __construct()
//    {
//        //create read update delete
//        $this->middleware(['permission:read_users'])->only('index');
//        $this->middleware(['permission:create_users'])->only('create');
//        $this->middleware(['permission:update_users'])->only('edit');
//        $this->middleware(['permission:delete_users'])->only('destroy');
//
//    }//end of constructor
    public function index(Request $request)
    {
        $users = User::
//        whereRoleIs('admin')->where(function($q) use ($request) {
//            return $q->

            when($request->search, function ($query) use ($request) {

                return $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%');
//            });
        })->paginate(5);

        return view('dashboard.users.index', compact('users'));

    }//end of index

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {
        $file_name = $this->saveImage($request->image, 'images/users');
//            'photo' => $file_name,

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'permissions' => 'required'
        ]);
        $request_data = $request->except(['password', 'password_confirmation', 'permissions']);
        $request_data['password'] = bcrypt($request->password);


        $user = User::create($request_data);
//        $user->hasRole('admin');
//        $user->syncPermissions($request->permissions);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.users.index');
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required'],
            'permissions' => 'required|min:1'
        ]);

        $request_data = $request->except(['permissions']);
        $user->update($request_data);
//        $user->syncPermissions($request->permissions);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.users.index');

    }

    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.users.index');
    }
}
