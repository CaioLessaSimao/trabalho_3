<html>
<head>

	<?php 
		require_once "connection.php";
		session_start();

		$id = (int)$_SESSION['id'];

		$sql = "SELECT nome FROM funcionario WHERE id=$id";

		$query = mysqli_query($conn, $sql);

		$result = mysqli_fetch_array($query);

		$nome = $result[0];
	?>

	<title><?php echo $nome; ?></title>
	<meta charset = 'utf-8' lang = 'pt-BR'/>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>

	<div class="topnav"><nav>
					<ul>
						<li><figure><img id="logo" src="imagem/detran2.png"></figure></li>
						<li><a href="cadastro.html">Cadastro</a></li>
						<li><a href="consulta.html">Consulta</a></li>
						<li><a href="sobre.html">Sobre</a></li>
						<li><a href="index.php">Sair</a></li>
					</ul></nav>
			</div>

</body>