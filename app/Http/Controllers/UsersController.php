<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\User;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $logged_in_user = Auth::user();
        $user = $this->findUserOr404($id);
        $posts = $user->posts;
        $user_posts_score = $user->totalScoreForUserPosts($posts);

        return view('users.account')->with(['logged_in_user' => $logged_in_user, 'posts' => $posts, 'user' => $user, 'user_posts_score' => $user_posts_score]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        return view('users.edit')->with('user', $user);
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
        $user = $this->findUserOr404($id);
        return $this->validateAndSave($user, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->findUserOr404($id);
        $user->delete();
        session()->flash('success_message', 'User deleted successfully.');
        return redirect()->action('Auth\AuthController@getLogin');
    }

    private function validateAndSave(User $user, Request $request) 
    {
        $request->session()->flash('error_message', 'User not saved successfully.');
        $request->session()->forget('error_message');
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        session()->flash('success_message', 'User saved successfully.');
        return redirect()->action('UsersController@show', ['id' => $user->id]);
    }

    private function findUserOr404($id) 
    {
        $user = User::find($id);
        if (!$user) {
            Log::info("User with ID $id cannot be found.");
            abort(404);
        }
        return $user;
    }
}
