<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Post;
use App\Vote;

class User extends BaseModel implements AuthenticatableContract,
									AuthorizableContract,
									CanResetPasswordContract
{
	use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];
	protected $dates = ['deleted_at'];

	public function posts() 
	{
		return $this->hasMany(Post::class, 'created_by');
	}

	public function votes() 
	{
		return $this->hasMany(Vote::class, 'user_id');
	}

	public function totalScoreForUserPosts($posts)
	{   
		$user_posts_score = 0;
		foreach ($posts as $post) {
			if ($post->voteScore()) {
				$user_posts_score += $post->voteScore();
			}
		}
		return $user_posts_score;
	}
}