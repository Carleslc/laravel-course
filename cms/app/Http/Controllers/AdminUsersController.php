<?php

namespace App\Http\Controllers;

use App\Helpers\StorageHelper;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Storage;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('role')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->getRoles();
        return view('admin.users.create', compact('roles'));
    }

    private function getRoles() {
        $roles = Role::pluck('name', 'id');
        $roles->prepend('', 0);
        return $roles;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $request = $this->processedRequest($request);
        $user = User::create($request->except('avatar'));
        StorageHelper::saveImage($request, 'avatar', 'avatars', $user->id);
        $this->saveAvatar($request, $user);
        return redirect(route('users.index'));
    }

    private function processedRequest(Request $request) {
        if ($request->role_id == 0) {
            $request->request->set('role_id', null);
        }
        if ($request->password == null) {
            $request->request->remove('password');
        } else {
            $request->request->set('password', bcrypt($request->password));
        }
        $request->request->set('is_active', $request->input('is_active', false));
        return $request;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = $this->getRoles();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $request = $this->processedRequest($request);
        StorageHelper::saveImage($request, 'avatar', 'avatars', $id);
        $user->update($request->except('avatar'));
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        StorageHelper::deleteImage('avatars', $id);
        session()->flash('status', "User $id deleted");
        return redirect(route('users.index'));
    }
}
