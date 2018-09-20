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

class CommentController extends BaseController
{
	public function postComment(Request $req) 
	{
		$user_id = $req->input('user_id');
		$film_id = $req->input('film_id');
		$name = $req->input('name');
		$comment = $req->input('comment');
		
		//check whether this is a registered user
		
		DB::insert('insert into comments(id, user_id, film_id, name, comment) values (?,?,?,?,?)', [null, $user_id, $film_id, $name, $comment]);
		return redirect ('films');
		//error handling goes here.
	}
	
	public function getComment() 
	{
		$fetcher = DB::select('select * from comments limit 5');
		$data = [
			'comments' => $fetcher
		];
		return view('films', $data);
	}
	
	
	public function editComment() 
	{
	}
	
	public function deleteComment() 
	{
	}
	
	
	
}
	
	