<html>
    <head>
        <title>Cadastrar Funcionário</title>
        <meta charset = 'utf-8' lang = 'pt-BR'/>

        <?php
            require_once "connection.php";
            
            $op = '';
            $nome = '';
            $email = '';
            $dt_nasc = '';
            $senha = '';

            if(isset($_REQUEST['btn_cad_func'])){
                $op = $_REQUEST['btn_cad_func'];
                if($op == 'finalizar'){
                    if(isset($_REQUEST['nome']) && isset($_REQUEST['email']) && isset($_REQUEST['dt_nasc']) && isset($_REQUEST['senha']) && isset($_REQUEST['tel']) && isset($_REQUEST['cpf']) && isset($_FILES['arquivo'])){
                        
                        $aux = $_REQUEST['nome'];

                        $email = $_REQUEST['email'];

                        $dt_nasc = strval($_REQUEST['dt_nasc']);

                        $aux2 = $_REQUEST['tel'];

                        $cpf = $_REQUEST['cpf'];

                        $senha = md5($_REQUEST['senha']);

                        $erros = [];
                        
                        $senhalen = strlen($senha);
                        
                        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                            $erros[] = "Esse endereço de email é inválido";
                        }

                        if(!filter_var($cpf, FILTER_VALIDATE_FLOAT)){
                            $erros[] = "O cpf é inválido";
                        }

                        $nome = filter_var($aux, FILTER_SANITIZE_STRING);

                        $telefone = filter_var($aux2, FILTER_SANITIZE_NUMBER_INT);

                        $verify_query = "SELECT id FROM funcionario WHERE email='$email';";

                        $verify_result = mysqli_query($conn, $verify_query);

                        $verify_row = mysqli_num_rows($verify_result);

                        if($verify_row == 1) {
                            $erros[] = "Já existe um funcionário com esse email";
                        }

                        
                        //UPLOAD DO ARQUIVO

                        $formatosPermitidos = array("png", "jpg", "jpeg", "pdf", "gif");

                        $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);

                        if(in_array($extensao, $formatosPermitidos)) {
                            $pasta = "arquivos/";
                            $temporario = $_FILES['arquivo']['tmp_name'];
                            $novoNome = uniqid().".".$extensao;
                            
                            if(!move_uploaded_file($temporario, $pasta.$novoNome)) {
                                $erros[] = "Erro ao enviar a identidade";
                            }
                        }
                        else{
                            $erros[] = "Formato do arquivo inválido";
                        }

                        if(count($erros)>0){
                            foreach ($erros as $i) {
                                echo $i."<br>";
                            }
                        }
                        
                        else{ 
                            $query = "INSERT INTO funcionario (nome, email, dt_nasc, senha, telefone, cpf) VALUES ('$nome', '$email','$dt_nasc','$senha', $telefone, $cpf); ";
                        
                            $result = mysqli_query($conn, $query);
                        
                            mysqli_close($conn);

                        if($result == 1){
                            header("Location: index.php");
                        }
                        else {
                            echo '<script type="text/javascript">'; 
                            echo 'alert("ocorreu um erro no cadastro, tente novamente.")'; 
                            echo 'window.location.href= "cadastrar_func.php"';
                            echo '</script>';
                        }
                    }
                    
                    //*/
                    }
                }
                
                else if ($op == 'retornar'){
                    header('Location: index.php');
                }
                    
            }

        ?>
    </head>
    <body>
        <div>
            <form action = 'cadastrar_func.php' method = 'POST' enctype="multipart/form-data">
                <label for = 'nome'>Insira seu nome:</label>
                <input type = 'text' name = 'nome'/><br>
                
                <label for = 'email'>Insira seu email:</label>
                <input type = 'email' name = 'email'/><br>
                
                <label for = 'dt_nasc'>Insira seu data de nascimento:</label>
                <input type = 'date' name = 'dt_nasc'/><br>

                <label for = 'tel'>Insira seu telefone:</label>
                <input type = 'text' name = 'tel'/><br>

                <label for = 'cpf'>Insira seu cpf:</label>
                <input type = 'text' name = 'cpf'/><br>
                
                <label for = 'senha'>Insira sua senha (ela deve conter no mínimo 8 caracteres):</label>
                <input type = 'password' name = 'senha'/><br>

                <label for = 'arquivo'>Envie sua identidade</label>
                <input type="file" name="arquivo"/><br>
                
                <button type = 'submit' name = 'btn_cad_func' value = 'finalizar'>Finalizar Cadastro</button><br>
                <button type = 'submit' name = 'btn_cad_func' value = 'retornar'>Retornar</button><br>
            </form>
        </div>
    </body>
</html>