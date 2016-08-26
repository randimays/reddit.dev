<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Vote;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Storage;

class PostsController extends Controller
{
	public $page_title = "All Posts";
	public function __construct()
	{
    	$this->middleware('auth', ['except' => ['index', 'newest', 'show']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$storage_path  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
		if ($request->has('post_search')) {
			$search = $request->post_search;
			$page_title = "Search Results";
			$posts = Post::search($search);
			return view('posts.index')->with(['posts' => $posts, 'page_title' => $page_title, 'storage_path' => $storage_path]);
		} else {
			$posts = Post::with('user')->orderBy('created_at', 'desc')->paginate(5);
			return view('posts.index')->with(['posts' => $posts, 'page_title' => $this->page_title, 'storage_path' => $storage_path]);
		}

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
	public function show(Request $request, $id)
	{
		$post = $this->findPostOr404($id);
		$vote_up = "noVote";
		$vote_down = "noVote";
		if ($post->vote_score) {
			$user_vote = $post->userVote(Auth::user())->vote;
			$vote_score = $post->voteScore();

			if ($user_vote == 1) {
				$vote_up = "vote";
			} elseif ($user_vote == 0) {
				$vote_down = "vote";
			}
		} else {
			$user_vote = null;
			$vote_score = null;
		}

		return view('posts.show')->with(['post' => $post, 'vote_up' => $vote_up, 'vote_down' => $vote_down, 'user_vote' => $user_vote, 'vote_score' => $vote_score]);
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
		$this->validate($request, Post::$rules);
		$request->session()->forget('error_message');
		$post->title = $request->title;
		$post->content = $request->content;
		$this->storeImage($request, $post);	
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

	public function newest()
	{
		$posts = Post::newestPosts();
		$page_title = "Posts From Today";
		return view('posts.newest')->with(['posts' => $posts, 'page_title' => $page_title]);
	}

	public function addVote($vote_value, $post_id)
	{
		$vote = Vote::with('post')->firstOrCreate([
			'post_id' => $post_id,
			'user_id' => Auth::user()->id
		]);
		$vote->vote = $vote_value;
		$vote->save();
		$post = $vote->post;
		$post->save();
		return redirect()->action('PostsController@show', ['post_id' => $post_id]);
	}

	private function storeImage(Request $request, Post $post)
	{
		$file = $request->file('image')->getClientOriginalName();
		$request->file('image')->move(public_path('image'), $request->file('image')->getClientOriginalName());
		$file_path = public_path('image') . '/' . $request->file('image')->getClientOriginalName();
		$post->img_path = $file;
	}

}