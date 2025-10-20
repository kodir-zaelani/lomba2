<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $uploadPath;

    /**
    * __construct
    *
    * @return void
    */
    public function __construct()
    {
        $this->uploadPath = public_path(config('cms.image.directoryusers'));
    }

    public static function middleware(): array
    {
        return [
            'permission:users.index|users.create|users.edit|users.delete|users.trash',
        ];
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('backend.users.index', [
            'title' => 'User List'
        ]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('backend.users.create', [
            'roles' => Role::orderBy('name', 'asc')->get(),
            'title' => 'User Create',
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'                  => 'required|min:2',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'confirmed|min:8',
            'password_confirmation' => 'required'
        ]);

        // Default data
        $data = [
            'name'        => $request->input('name'),
            'email'       => $request->input('email'),
            'username'    => $request->input('username'),
            'celuller_no' => $request->input('celuller_no'),
            'password'    => bcrypt($request->input('password')),
        ];

        $user = User::create($data);

        //assign role to user
        $user->syncRoles($request->input('users'));
        return redirect()->route('backend.users.index')->with(['success' => 'Add User ' . $user['name'] . ' was successfully!']);

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
    public function edit(User $user)
    {
        $users = Role::orderBy('name', 'asc')->get();
        return view('backend.users.edit', [
            'user' => $user,
            'users' => $users,
            'title' => 'User Edit',
        ]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, User $user)
    {

        $validateData = [];

        $validateData = array_merge($validateData, [
            'name'                  => 'required|min:2',
            'email'                 => 'required|email',
            'username'              => 'required|min:6',
            'celuller_no'           => 'required|min:11|max:12',
        ]);


        // Default data
        $data = [
            'name'        => $request->input('name'),
            'email'       => $request->input('email'),
            'username'    => $request->input('username'),
            'celuller_no' => $request->input('celuller_no'),
            'status'      => $request->input('status'),
        ];

        $user = User::findOrFail($user->id);
        $current_hashed_password = $user->password;

        if(!empty($request->input('password'))) {
            $validateData = array_merge($validateData, [
                'password'              => 'confirmed|min:8',
                'password_confirmation' => 'required'
            ]);

            if ($user->masterstatus == config('cms.default_masteruser')){
                $validateData = array_merge($validateData, [
                    'current_password_for_password' => ['required', 'customPassCheckHashed:'.$current_hashed_password]
                ]);
            }

            $data = array_merge($data, [
                'password'  => bcrypt($request->input('password')),
            ]);
        }

        $this->validate($request, $validateData);

        $user->update($data);

        //assign role
        $user->syncRoles($request->input('users'));

        return redirect()->route('backend.users.index')->with(['success' => 'Update User ' . $user['name'] . ' was successfully!']);

    }

    public function userprofile()
    {
        return view('backend.users.profile', [
            'title' => 'Profile'
        ]);
    }
}
