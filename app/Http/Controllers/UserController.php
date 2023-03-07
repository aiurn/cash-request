<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'User Management';
        $data['users'] = User::get();

        return view('settings.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Create User';
        $data['roles'] = Role::get();

        return view('settings.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'role' => 'required',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        try {
            $user = new User();
            $user->username = $request->username;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $name = time() . '.' . $avatar->getClientOriginalExtension();
                $destinationPath = public_path('assets/images/profile/');
                $avatar->move($destinationPath, $name);
                $user->avatar = $name;
            }
        
            $user->save();
            $user->assignRole($request->role);
        
            return redirect()->route('settings.user.index')->with('success','User created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Update User';
        $data['user'] = User::findOrFail($id);
        $data['roles'] = Role::get();

        return view('settings.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        try {
            $user = User::findOrFail($id);
            $user->username = $request->username;
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $name = time() . '.' . $avatar->getClientOriginalExtension();
                $destinationPath = public_path('assets/images/profile/');
                $avatar->move($destinationPath, $name);
                $user->avatar = $name;
            }
        
            $user->save();

            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->role);
        
            return redirect()->route('settings.user.index')->with('success','User updated successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            User::destroy($id);
            Session::flash('success', 'User Successfully Deleted!');

            return response()->json([
                'success' => true,
                'message' => 'User successfully deleted',
            ], 200);
        } catch (\Throwable $th) {
            Session::flash('failed', $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
