<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Films</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
		<style>
			body {
				max-width: 100%;
				height: 100%;
			}
			#mainWrapper {
				text-align: center;
				background-color: #c4c4d8;
			}
			
			#mainWrapper h2 {
				margin-top: 40px;
			}
			
			#childWrapper {
				margin: 0 auto;
			}
			
			
			form input, textarea {
				margin-top: 10px;
				display: block;
				width: 200px;
				font-size: 14px;
				
			}
			form textarea {
				min-height: 120px;
				min-width: 250px;
			
			}
			form button {
				float: left;
				font-size: 16px;
				padding: 5px;
				margin-top: 5px;
			}
			table {
				margin: 0 auto;
				width: 70%;
				background-color: #e5e5e5;
				border: 1px solid #000;
			}
			
			table tr td {

				float: left;
				padding-left: 15px;
				padding-top: 10px;
			}
			
			@if ($userID == null && $userName == null)
				div h1 {
					padding-left: 0px;
					display: inline-block;
				}
			@else 
				div h1 {
					padding-left: 225px;
					display: inline-block;
				}
			@endif
			
			#logOut {
				float: right;
				display: inline-block;
				margin-right: 20px;
			}
				
			
			
		</style>
	</head>
	<body>
		<div id="mainWrapper">
			<div id="childWrapper">
				<span>
					@if ($userID == null && $userName == null)
						<h3>Hello, Guest!</h3>
						<a href="register"><input type="button" value="Register"></a>
						<a href="login"><input type="button" value="Login"></a>
					@else 
						<h3>Hello, {{$userName}}!</h3>
						<form action="logoutme" method="post"><input type="hidden" name="_token" value="{{csrf_token()}}"><input id="logOut" type="submit" value="LogOut"></form>
					@endif
				</span>
				
				<div>
					<h1>Films Mania!</h1>
				</div>
				
				<a href="films/create"><button type="submit" value="Submit">Create Film</button></a>
				
				<h2>List of Film</h2>
				<table>
						@php
							$alreadyAssigned = false
						@endphp
						@if (count($fetcher) > 0) 
							@foreach ($fetcher as $row)
									<tr style="font-size: 18px; font-weight: bold">
										<td>{{$row->name}}</td>
									</tr>
									<tr>
										<td style="text-align: left;">{{$row->description}}</td>
									</tr>
									<tr>
										<td><b>Genre:</b> {{$row->genre}}</td>
										<td><b>Country:</b> {{$row->country}}</td>
									</tr>
									<tr>
										<td><b>Release Date:</b> {{$row->releaseDate}}</td>
										<td><b>Ticket Price:</b> {{$row->ticketPrice}}</td>
									</tr>
									@if ($userID == null && $userName == null)
										<tr>
											<td><h3><i>Please <a href="login">Login</a> to Put Comment..</i></h3></td>
										</tr>
									@else 
										<tr>
											<td>
												<form action="postComment" method="post">
													<input type="hidden" name="_token" value="{{csrf_token()}}">
													@if ($userID != null)
														<input type="hidden" name="user_id" value="{{$userID}}">
													@endif
													<input type="hidden" name="film_id" value="{{$row->id}}">
													<input type="text" name="name" Placeholder="Name" required> 
													
													<textarea placeholder="Put Your Comment Here..." name="comment" required></textarea>
													<button type="submit" name="postComment">Post</button>
												</form>
											</td>
										</tr>
									@endif
									@if (count($comments) > 0) 
											@foreach ($comments as $comment) 
												
												@if ($comment->film_id == $row->id) 
													<tr style="border: 1px solid #000; background-color: #d1d1d1">
														<td style="padding-bottom: 10px;"><b>Name:</b> {{$comment->name}}</td>
													</tr>
													<tr style=" background-color: #bcc6d1">
														<td style="padding-bottom: 10px;"><b>Comment:</b> {{$comment->comment}}</td>
													</tr>
												@else 
													@if (!$alreadyAssigned)
														<tr style=" background-color: #bcc6d1">
															<td style="padding-bottom: 10px;"><b>No Comment Yet</b></td>
														</tr>
														@php
															$alreadyAssigned = true
														@endphp
													@endif
												@endif
												
												
											@endforeach
									@else
										<tr style=" background-color: #bcc6d1">
											<td style="padding-bottom: 10px;"><b>No Comment Yet</b></td>
										</tr>
										
									@endif
									
							@endforeach
						@else
							<tr><td>No Film Posted Yet.</td></tr>
						
						@endif
				</table>
					
			
			</div>
		</div>
	</body>
</html>