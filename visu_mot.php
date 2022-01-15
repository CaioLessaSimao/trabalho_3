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
            public $nome;
            public $email;
            public $cpf;
            public $telefone;
            public $string;
            public $html;

            function __construct($nome, $email, $cpf, $telefone){
                $this->string = "<tr><td>".$nome."</td><td>".$email."</td><td>".$cpf."</td><td>".$telefone."</td></tr>";
                $this->html = $this->string;
            }
        }



        $query = "SELECT nome, email, cpf, telefone FROM motorista;";

        $result = mysqli_query($conn, $query);

        
        $nomes = [];
        $email = [];
        $cpf = [];
        $telefone = [];
        
        
        while ($row = mysqli_fetch_assoc($result)) {
		    $nomes[] = $row['nome'];
		    $emails[] =  $row['email']; 
            $cpfs[] = $row['cpf'];
            $telefones[] = $row['telefone'];
		}

        
        for($i = 0; $i<count($nomes); $i++){
            $nome = $nomes[$i];
			
			$email = $emails[$i];

            $cpf = $cpfs[$i];

            $telefone = $telefones[$i];


            $linha = new create_item($nome, $email, $cpf, $telefone);
            
            $array[] = $linha;
        }

        $resultado = "";

        foreach($array as $i){
            $resultado .= $i->html;
        }
    ?>
    </head>

    <body>

        <div class="consulta">
            
            <div class="tabela"> 

                <form id = 'bot_ret' action = 'visu_mot.php' method = 'POST'>
            
                    <table>

                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>CPF</th>
                                <th>Telefone</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php echo $resultado; ?>
                        </tbody>
                
                    </table>

                    <br><br><button type = 'submit' name = 'btn_ret_vis' value = 'retornar'>Retornar</button><br>

                </form>

            </div>

        </div>

    </body>

</html>