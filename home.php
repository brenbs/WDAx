<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="estilos/index.css">
	<title>WDA Locadora de Livros Login</title>
	<style>
		
		#inputD{
			
			background-color:none;
			border:none;
			border-bottom:1px solid white;
			outline:none;
			border-radius:10px;
			padding:15px;
			width:85%;
			color:black;
			font-size:15px;
		}
		#inpute{
			background-color:rgb(15, 26, 75);
			border:none;
			border-radius:10px;
			padding:15px;
			width:85%;
			color:white;
			font-size:15px;
			cursor:pointer;
		}
	</style>
</head>
<body>
<div class="box">
	<h1>Login</h1>
		<form action="testLogin.php" method="POST">
				<div id="inputD">
					<input type="text" name="adm" placeholder="Nome:" id="inputD">
					<br><br><br>
					<input type="text" name="adme" placeholder="Email:" id="inputD">
					<br><br><br>
					<input type="password" name="senha" placeholder="Senha:"id="inputD">
				</div>
		   <br><br><br>
				<div id="inpute">
					<input type="submit" name="submit" value="Enviar" id="inpute">
				</div>
		</form>
	</div> 
</body>
</html>