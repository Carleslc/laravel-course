<?php

namespace App\Http\Controllers;

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
        $users = User::with('role')->get();
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
        $roles = Role::pluck('name', 'id')->all();
        array_unshift($roles, ''); // prepend
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

    private function saveAvatar(Request $request, User $user) {
        $avatar = $request->file('avatar');
        if ($avatar) {
            $avatar->storeAs('avatars', $user->id, 'public');
        }
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
        $this->saveAvatar($request, $user);
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
        Storage::disk('public')->delete('avatars/' . $id);
        session()->flash('status', "User {$id} deleted");
        return redirect(route('users.index'));
    }
}
