<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends BaseModel 
	{
    use SoftDeletes;

	protected $table = 'posts';
	protected $dates = ['deleted_at'];
	public static $rules = [
		'title' => 'required|max:100|string',
		'content' => 'required|string',
		'url' => 'required|active_url'
	];

	public function user() 
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	public function votes()
	{
		return $this->hasMany(Vote::class);
	}

	public function setTitleAttribute($value)
	{
		$this->attributes['title'] = htmlspecialchars(strip_tags($value));
	}

	public function setContentAttribute($value)
	{
		$this->attributes['content'] = htmlspecialchars(strip_tags($value));
	}

	public function getTitleAttribute($value)
	{
		return ucwords($value);
	}

	public static function count($userId)
    {
        return Post::where('created_by', '=', $userId)->count();
    }

    public static function search($search = null)
    {
    	if ($search != null) {
    		return Post::where('title', 'LIKE', '%' . $search . '%')->orWhere('content', 'LIKE', '%' . $search . '%')->paginate(10);
    	}
    }

    public static function newestPosts()
    {
    	return Post::where('created_at', '=', Carbon::today())->paginate(10);
    }

    public function upVotes()
    {
    	return $this->votes()->where('vote', '=', 1);
    }

    public function downVotes()
    {
    	return $this->votes()->where('vote', '=', 0);
    }

    public function voteScore()
    {
    	$up_votes = $this->upVotes()->count();
    	$down_votes = $this->downVotes()->count();
    	return $up_votes - $down_votes;
    }

    public function userVote(User $user)
    {
    	return $this->votes()->where('user_id', '=', $user->id)->first();
    }
}
