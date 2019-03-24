<?php

namespace App\Http\Controllers\Backend;

use App\User;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\adminSaveUserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all users
        $users = User::all();

        return view('backend.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Create a new user
        $user = new User();

        return view('backend.user.create', compact('user'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(adminSaveUserRequest $request)
    {
        $data = $request->all();
        $data->password = bcrypt($data['password']);

        // save
        $user = User::create($data);

        // Mail the user
        Mail::to($data['email'])->send(new WelcomeMail($user));

        return redirect('/admin/users');
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the users.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('backend.user.edit', compact('user'));
    }

    /**
     * Update the user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(adminSaveUserRequest $request, User $user)
    {
        // Get the given data
        $data = $request->all();

        // If the user added a new password, save. Else don't add it.
        if($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        // Save the updates
        $user->update($data);

        return Redirect::to('/admin/users');
    }

    /**
     * Remove the user from storage.
     *
     * @param  User $user
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        // Delete the article
        $user->delete();

        return Redirect::to('/admin/users');

    }
}
