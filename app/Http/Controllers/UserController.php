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

class UserController extends BaseController
{
	
	public function registerUser(Request $req) 
	{
		$name = $req->input('name');
		$email = $req->input('email');
		$password = $req->input('password');
		
		DB::insert('insert into users(id,name,email,password) values (?,?,?,?)', [null, $name, $email, $password]);
		
		return redirect('/login');  
	}
	
	public function loginUser(Request $req)
	{
		$email = $req->input('email');
		$password = $req->input('password');
		$checkLogin = DB::table('users')->where(['email'=>$email, 'password'=>$password])->get();
		$fetchID = json_decode($checkLogin);
		foreach ($fetchID as $row) {
			$fetchID = $row->id;
			$fetchName = $row->name;
		}
	
		
		if(count($checkLogin) > 0)
		{
			$req->session()->put('user_id', $fetchID);
			$req->session()->put('user_name', $fetchName);
			return redirect('films');
		}
		else 
		{
			echo "Wrong credentials!";
			return 'Login Failed. Wrong Credentials! Don\'t have an account? Register <a href="/laravelproject/public/register">here</a>';
		}
		
	}
	
	public function logoutUser(Request $req) 
	{
		$user_name = $req->session()->get('user_name');
		$req->session()->flush();
		return redirect('logout')->with('username', $user_name);
	}
	
	
}