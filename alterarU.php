<html>
    <head>
        <title></title>
        <meta charset = 'utf-8' lang = 'pt-BR'/>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <?php
                
                $op = '';
                $cep = '';
                $num = '';
                $comp = '';
                if(isset($_REQUEST['btn_cad_unid'])){
                    $op = $_REQUEST['btn_cad_unid'];
                    if($op == 'finalizar'){
                        require_once "connection.php";
                        if(isset($_REQUEST['cep']) && isset($_REQUEST['num']) && isset($_REQUEST['tel']) && isset($_REQUEST['email'])){
                            
                            $id = $_REQUEST['id'];

                            $aux = $_REQUEST['cep'];
                            
                            $num = $_REQUEST['num'];
                            
                            $aux2 = $_REQUEST['tel'];

                            $email = $_REQUEST['email'];

                            $erros = [];


                            $cep = filter_var($aux, FILTER_SANITIZE_NUMBER_INT);

                            $tel = filter_var($aux2, FILTER_SANITIZE_STRING);

                            if(!filter_var($num, FILTER_VALIDATE_INT)){
                                $erros[] = "O número da unidade é inválido";
                            }

                            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                $erros[] = "O email é inválido";
                            }

                            $verify_query = "SELECT id FROM unidade WHERE cep='$cep' and numero='$num';";

                            $verify_result = mysqli_query($conn, $verify_query);

                            $verify_row = mysqli_num_rows($verify_result);

                            if ($verify_row == 1) {
                                $erros[] = "Ja existe uma unidade com esse endereço";
                            }

                            if(count($erros)>0){
                                foreach ($erros as $i) {
                                    echo $i;
                                }
                            }

                            else { 
                                $query = "UPDATE unidade SET cep=$cep, numero=$num, telefone='$tel', email='$email' WHERE id=$id;";
                                $result = mysqli_query($conn, $query);

                            if($result == 1){
                                mysqli_close($conn);
                                header("Location: visu_unid.php?id=$id");
                            }
                            else {
                                mysqli_close($conn);
                                header("Location: visu_unid.php?id=$id");
                            }
                        }

                        }
                    }
                    else if($op == 'retornar'){
                        header("Location: visu_unid.php?id=$id");
                    }
                }
            ?>

    </head>

    <body>

        <div class="cadastro">
                
                <div class="cadastro_form">
                    <form action = 'alterarU.php?id=<?php echo $_REQUEST['id']; ?>' method = 'POST'>
                        <label for = 'cep'>Insira o CEP da unidade</label>
                        <input type = 'text' name = 'cep'></input><br>

                        <label for = 'num'>Insira o número da unidade</label>
                        <input type = 'text' name = 'num'></input><br>

                        <label for = 'tel'>Insira o telefone da unidade</label>
                        <input type = 'text' name = 'tel'></input><br>

                        <label for = 'email'>Insira o email da unidade</label>
                        <input type = 'email' name = 'email'></input><br><br>

                        <button type = 'submit' name = 'btn_cad_unid' value = 'finalizar'>Finalizar</button><br><br>
                        <button type = 'submit' name = 'btn_cad_unid' value = 'retornar'>Retornar</button>
                    </form>

                </div>

            <div>
    </body>

</html>