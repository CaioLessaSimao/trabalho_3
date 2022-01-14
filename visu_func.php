<?php 
    include "header.php";
?>

<html>
    <head>
    <title></title>
        <meta charset = 'utf-8' lang = 'pt-BR'/>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    
    <?php
        require_once "connection.php";

        $op = '';

        if(isset($_REQUEST['btn_ret_vis'])){
            $op = $_REQUEST['btn_ret_vis'];

            if($op == 'retornar'){
                header("Location: menu.php");
            }

        }
        

        class create_item {
            public $id;
            public $nome;
            public $email;
            public $cpf;
            public $telefone;
            public $dt_nasc;
            public $string;
            public $html;

            function __construct($id, $nome, $email, $cpf, $telefone, $dt_nasc){
                $this->string = "<tr><td>".$nome."</td><td>".$email."</td><td>".$cpf."</td><td>".$telefone."</td><td>".$dt_nasc."</td></tr>";
                $this->html = $this->string;
            }
        }



        $query = "SELECT id, nome, email, cpf, telefone, dt_nasc FROM funcionario;";

        $result = mysqli_query($conn, $query);

        $ids = [];
        $nomes = [];
        $emails = [];
        $cpfs = [];
        $telefones = [];
        $dts_nasc = [];
        
        
        while ($row = mysqli_fetch_assoc($result)) {
		    $ids[] = $row['id'];
            $nomes[] = $row['nome'];
		    $emails[] =  $row['email']; 
            $cpfs[] = $row['cpf'];
            $telefones[] = $row['telefone'];
            $dts_nasc[] = $row['dt_nasc'];
		}

        
        for($i = 0; $i<count($nomes); $i++){
            
            $id = $ids[$i];
            
            $nome = $nomes[$i];
			
			$email = $emails[$i];

            $cpf = $cpfs[$i];

            $telefone = $telefones[$i];

            $dt_nasc = $dts_nasc[$i];

            $linha = new create_item($id, $nome, $email, $cpf, $telefone, $dt_nasc);
            
            $array[] = $linha;
        }

        $resultado = "";

        foreach($array as $i){
            $resultado .= $i->html;
        }
    ?>
    </head>
    <body>
        
        <table>

            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Data de Nascimento</th>
                </tr>
            </thead>
            
            <tbody>
                <?php echo $resultado; ?>
            </tbody>
    
    </table>

    <form id = 'bot_ret' action = 'visu_func.php' method = 'POST'>

        <button type = 'submit' name = 'btn_ret_vis' value = 'retornar'>Retornar</button><br>

    </form>

</body>

</html>