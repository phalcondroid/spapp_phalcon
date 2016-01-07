<!DOCTYPE html>
<html>
<head>
	<title>Testim IO</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
</head>

{{ content() }}

<body>

	<div class="container">

		<h1>Testim IO</h1>

		{{ form("test/index", "method" : "post", "class" : "form", "style" : "margin: 0 auto") }}
			
			<div class="form-group">
			    <label for="email">Nombres</label>
			    <input type="text" class="form-control" name="name">
			</div>

			<div class="form-group">
			    <label for="email">Apellidos</label>
			    <input type="text" class="form-control" name="last">
			</div>
	 
			<div class="form-group">
			    <label for="email">Email address:</label>
			    <input type="email" class="form-control" name="email">
			</div>

			<div class="form-group">
			    <label for="email">Teléfono móvil</label>
			    <input type="text" class="form-control" name="phone">
			</div>

			<div class="form-group">
			    <label for="pwd">Password:</label>
			    <input type="password" class="form-control" name="pwd">
			</div>

			<div class="checkbox">
			    <label><input type="checkbox" name="recordar"> 	Recordar </label>
			</div>
			<button type="submit" class="btn btn-default">Submit</button>

		{{ end_form() }}

	</div>
</body>
</html>