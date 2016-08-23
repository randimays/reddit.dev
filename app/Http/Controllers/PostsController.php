<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
	public function __construct()
	{
    	$this->middleware('auth', ['except' => ['index', 'show']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$posts = Post::with('user')->paginate(5);
		return view('posts.index')->with('posts', $posts);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('posts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, self::$rules);
		$post = new Post();
		$post->created_by = Auth::id();
		Log::info($request->all());
		return $this->validateAndSave($post, $request);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$post = $this->findPostOr404($id);
		return view('posts.show')->with('post', $post);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$post = $this->findPostOr404($id);
		return view('posts.edit')->with('post', $post);
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
		$post = $this->findPostOr404($id);
		return $this->validateAndSave($post, $request);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$post = $this->findPostOr404($id);
		$post->delete();
		session()->flash('success_message', 'Post deleted successfully.');
		return redirect()->action('PostsController@index');
	}

	private function validateAndSave(Post $post, Request $request) 
	{
		$request->session()->flash('error_message', 'Post was not saved successfully.');
		$this->validate($request, self::$rules);
		$request->session()->forget('error_message');
		$post->title = $request->title;
		$post->content = $request->content;
		$post->url = $request->url;
		$post->save();
		session()->flash('success_message', 'Post saved successfully.');
		return redirect()->action('PostsController@index');
	}

	private function findPostOr404($id) 
	{
		$post = Post::find($id);
		if (!$post) {
			Log::info("Post with ID $id cannot be found.");
			abort(404);
		}
		return $post;
	}
}