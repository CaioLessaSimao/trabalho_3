<?php 
	require_once "connection.php";

	$oper = $_REQUEST['funcao'];



	if($oper == "cad_unid"){
		header("Location: cad_unid.php");
	}

	if($oper == "cad_mot"){
		header("Location: cad_mot.php");
	}

	if($oper == "cad_cnh"){
		header("Location: cad_cnh.php");
	}

	if($oper == "cad_veic"){
		header("Location: cad_veic.php");
	}

	if($oper == "visu_unid"){
		header("Location: visu_unid.php");
	}

	if($oper == "visu_mot"){
		header("Location: visu_mot.php");
	}

	if($oper == "visu_cnh"){
		header("Location: visu_cnh.php");
	}

	if($oper == "visu_veic"){
		header("Location: visu_veic.php");
	}

	if($oper == "visu_func"){
		header("Location: visu_func.php");
	}

	if($oper == "deletar"){
		$tabela = $_REQUEST['tabela'];
		$id = (int)$_REQUEST['id'];
		$pagina = $_REQUEST['pagina'];

		$sql = "DELETE FROM $tabela WHERE id=$id;";

		$query = mysqli_query($conn, $sql);

		header("Location: $pagina");
	}
?>