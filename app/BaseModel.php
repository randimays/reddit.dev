<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BaseModel extends Model
{
	
	public function getCreatedAtAttribute($value)
	{
		$utc = \Carbon\Carbon::createFromFormat($this->getDateFormat(), $value);
		return $utc->setTimezone('America/Chicago')->format('l, F jS Y @ h:i:s A');
	}

	public function getUpdatedAtAttribute($value)
	{
		$utc = \Carbon\Carbon::createFromFormat($this->getDateFormat(), $value);
		return $utc->setTimezone('America/Chicago')->format('l, F jS Y @ h:i:s A');
	}
}
