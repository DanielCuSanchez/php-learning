<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>pokeapi</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<link rel="stylesheet" href="./css/arrays.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

</head>

<body>

	<div class="container-fluid flex-column animate__animated animate__swing">
		<div class="row justify-content-center">
			<div class="col-md-4  bg-light m-2 p-4 finder">
				<p class="navbar-brand">
					Bootstrap
				</p>
				<form class="form-inline text-center" method="post">
					<div class="row ">
						<p>Encuentra un pokemon, ingresa un numero. Rango (1-300)</p>
						<input class="form-control my-4" type="number" name="numero">
						<button class="btn btn-primary my-4 my-sm-0" type="submit">
							Buscar
						</button>
					</div>
				</form>
				<?php
				$pokemon = '200';
				if (isset($_POST["numero"])) {
					$pokemon = &$_POST["numero"];
					//echo "El pokemon es: " . $pokemon;
				}
				$api = curl_init("https://pokeapi.co/api/v2/pokemon/$pokemon");
				curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($api);
				curl_close($api);

				$json = json_decode($response);

				//var_dump($json);
				?>
			</div>
		</div>
	</div>

	<div class="container-fluid ">
		<div class="row justify-content-center text-center">
			<div class="col-4 ">
				<div class="card">
					<?php echo "<h1 class='my-4'>" . $json->forms[0]->name . "</h1>"; ?>
					<?php
					echo '<h5>HABILIDADES</h5>';
					foreach ($json->abilities as $k => $v) {
						echo "<p>" . $v->ability->name . "<p>" . '<br>';
					} ?>

					<?php
					echo '<h5>TIPO</h5>';
					echo "<p>" . $json->types[0]->type->name . "<p>";

					?>
				</div>
			</div>
			<div class="col-4">
				<div class="card">
					<div class="card-body">
						<h2>Foto frontal:</h2>
						<?php echo '<img src="' . $json->sprites->front_default . '" width="200">'; ?>
						<h2>Sprite dorso:</h2>
						<?php echo '<img src="' . $json->sprites->back_default . '" width="200">'; ?>
					</div>
				</div>

			</div>
		</div>

	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>