<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller 
{
	public function showWelcome() {
		return view('welcome');
	}

	public function rollDice($guess) {
		$data['guess'] = $guess;
		$data['random'] = mt_rand(1, 6);

		if ($guess == $data['random']) {
			$data['outcome'] = "You guessed it!";
		} else {
			$data['outcome'] = "Sorry, try again.";
		}
	    return view('roll-dice', $data);
	}

	public function increment($number = 0) {
		$incremented = $number + 1;
		$data = compact('number', 'incremented');
		return view('increment', $data);
	}

	public function uppercase($word = "Crazy!") {
		$upperWord = strtoupper($word);
		return view('uppercase', compact('upperWord', 'word'));
	}

}