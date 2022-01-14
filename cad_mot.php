<?php 
    include "header.php";
?>

<html>   
    <head>
        <title></title>
        <meta charset = 'utf-8' lang = 'pt-BR'/>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <?php
            $op = '';
            $nome = '';
            $email = '';
            if(isset($_REQUEST['btn_cad_mot'])){
                
                $op = $_REQUEST['btn_cad_mot'];
                
                if($op == 'finalizar'){
                
                    require_once "connection.php";
                
                    if(isset($_REQUEST['nome']) && isset($_REQUEST['email']) && isset($_REQUEST['cpf'])){
                        $aux = $_REQUEST['nome'];
                        $email = $_REQUEST['email'];
                        $cpf = $_REQUEST['cpf'];
                        $aux2 = $_REQUEST['tel'];
                        $erros = [];

                        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                            $erros[] = "Esse email é inválido"; 
                        }
                        if(!filter_var($cpf, FILTER_VALIDATE_FLOAT)){
                            $erros[] = "Esse cpf é inválido"; 
                        }

                        $nome = filter_var($aux, FILTER_SANITIZE_STRING);
                        $tel = filter_var($aux2, FILTER_SANITIZE_NUMBER_INT);

                        $verify_query = "SELECT id FROM motorista WHERE email = '$email';";
                        $verify_result = mysqli_query($conn, $verify_query);

                        $verify_row = mysqli_num_rows($verify_result);

                        if ($verify_row == 1) {
                            $erros[] = "Ja existe um motorista cadastrado com esse email";
                        }

                        if(count($erros)>0){
                            for($i = 0; $i < count($erros); $i++){
                                echo $erros[$i];
                            }
                        }
                        else{
                            $query = "INSERT INTO motorista (nome, email, cpf, telefone) VALUES ('$nome', '$email', $cpf, $tel);";

                            $result = mysqli_query($conn, $query);
                            if($result == 1){
                                header("Location: menu.php");
                            }
                            else{
                                header("Location: cad_mot.php");
                            }
                        }
                    }
                }

                else if($op == 'retornar'){
                    header("Location: menu.php");
                }
            }
        ?>
    </head>

    <body>

        <div class="cadastro">

            <div class="cadastro_form">
                
                <form action = 'cad_mot.php' method = 'POST'>
                    <label for = 'nome'>Insira o nome do motorista:</label>
                    <input type = 'text' name = 'nome'/><br>
                    
                    <label for = 'email'>Insira o email do motorista:</label>
                    <input type = 'email' name = 'email'/><br>

                    <label for = 'cpf'>Insira o cpf do motorista:</label>
                    <input type = 'text' name = 'cpf'/><br>

                    <label for = 'tel'>Insira o telefone do motorista:</label>
                    <input type = 'text' name = 'tel'/><br>
                    
                    <button type = 'submit' name = 'btn_cad_mot' value = 'finalizar'>Finalizar Cadastro</button><br>
                    <button type = 'submit' name = 'btn_cad_mot' value = 'retornar'>Retornar</button><br>
                </form>

            <div>

        </div>

    </body>

</html>