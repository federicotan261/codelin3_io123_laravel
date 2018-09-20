<?php 
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;

class FilmController extends BaseController
{
	
	public function createFilm(Request $req) 
	{
		$name = $req->input('film_name');
		$desc = $req->input('film_desc');
		$genre = $req->input('film_genre');
		$releaseDate = $req->input('film_release_date');
		$rating = $req->input('film_rating');
		$ticketPrice = $req->input('film_ticket_price');
		$country = $req->input('film_country');
		$photo = $req->input('film_photo');
		
		DB::insert('insert into films(id, name, description, releaseDate, rating, ticketPrice, country, genre, photo) values (?,?,?,?,?,?,?,?,?)', [null, $name, $desc, $releaseDate, $rating, $ticketPrice, $country, $genre, $photo]);
		return redirect ('/films');
	}
	
	public function getFilm(Request $req) 
	{
		$fetcher = DB::select('select * from films limit 20');
		$commentFetcher = DB::select('select * from comments limit 5');
		$userID = $req->session()->get('user_id');
		$userName = $req->session()->get('user_name');
		
		$data = [
			'fetcher' => $fetcher,
			'comments' => $commentFetcher,
			'userID' => $userID,
			'userName' => $userName
		];

		return view('films')->with($data);
	}
	
	
	
}