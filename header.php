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
</head>
<body>