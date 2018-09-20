<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Create Film</title>

        <!-- Fonts -->
        <style>
			form {
				padding-left: 25px;
			}
			form input, textarea{
				font-size: 18px;
				width: 450px;
				display: block;
			}
			
			form h3 {
				margin-top: 20px;
			}
			
			#createFilm {
				cursor: pointer;
				margin: 20px auto;
				padding: 10px;
				border-radius: 10px;
				border: 1px solid black;
				font-weight: 500;
				font-size: 20px;
			
			}
		</style>
	</head>
	<body>
		<div>
			<h1>Create a Film</h1>
			<form action="/laravelproject/public/createFilm" id="film_form" method="post">
			  <input type="hidden" name="_token" value="{{csrf_token()}}">
			  <h3>Name:</h3>
			  <input type="text" name="film_name" required>
			  <h3>Description:</h3>
			  <textarea name="film_desc" style="height: 150px;" required></textarea>
			  <h3>Genre:</h3>
			  <input type="text" name="film_genre" required>
			  <h3>Release Date:</h3>
			  <input type="date" name="film_release_date" required>
			  <h3>Rating: </h3>
			  <input type="number" name="film_rating" min="1" max="5" required>  
			  <h3>Ticket Price: </h3>
			  <input type="text" name="film_ticket_price" required>  
			  <h3>Country: </h3>
			  <input type="text" name="film_country" required>  
			  <h3>Photo: </h3>
			  <input type="file" name="film_photo" accept="image/*" required>  

			  <button id="createFilm" type="submit">Create</button>
			</form>
		</div>
	</body>
</html>

