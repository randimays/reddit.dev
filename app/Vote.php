<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\User;

class Vote extends BaseModel
{
	protected $fillable = ['user_id', 'post_id'];

	public function user() 
	{
		return $this->belongsTo(User::class);
	}

	public function post() 
	{
		return $this->belongsTo(Post::class);
	}

    public static function countUserVotes($userId)
    {
        return Vote::where('user_id', '=', $userId)->count();
    }
}
