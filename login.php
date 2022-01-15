<html>

    <head>

        <title></title>
        <meta charset = 'utf-8' lang = 'pt-BR'/>
        <link rel="stylesheet" type="text/css" href="css/styles.css">

        <?php
            include_once "connection.php";
            
            function logar($email,$senha,$conn){

                $query = "SELECT id FROM funcionario WHERE email = '$email' and senha = '$senha';";

                $result = mysqli_query($conn, $query);

                $array = mysqli_fetch_array($result);

                $id = $array[0];

                session_start();

                $_SESSION['id'] = $id;
    
                $row = mysqli_num_rows($result);

                if ($row == 1) {
                    header("Location: menu.php");
                }
                else{
                    header("Location: login.php?erro=true");
                }
            }


            $email = '';
            $senha = '';
            $op = '';
            if(isset($_REQUEST['btn_login'])){
                $op = $_REQUEST['btn_login'];
                if($op == 'entrar'){
                    if(isset($_REQUEST['email']) && isset($_REQUEST['senha'])){
                        $email = $_REQUEST['email'];
                        $senha = md5($_REQUEST['senha']);

                        logar($email,$senha,$conn);
                    }
                }
                else if($op == 'retornar'){
                    header("Location: index.php");
                }
            }
        ?>
    </head>

    <body>

        <div class="topnav_index"><nav>
                <ul>
                    <li><figure><img id="logo" src="imagem/detran2.png"></figure></li>
                    <li><a>Orgão Governamental Genérico Responsável pelos Motoristas</a></li>
                </ul></nav>
        </div>

        <div class="login">

                <div class="login_form">
                        
                    <form action = 'login.php' method = 'GET'>
                        <label for = 'email'>Insira seu e-mail:</label>
                        <input type = 'text' name = 'email'></input><br>
                        
                        <label for = 'senha'>Insira sua senha:</label>
                        <input type = 'password' name = 'senha'></input>
                        
                        <button type = 'submit' name = 'btn_login' value = 'entrar'>Entrar</button><br>
                        <button type = 'submit' name = 'btn_login' value = 'retornar'>Retornar</button><br>
                    </form>

                </div>
                
        </div>

    </body>

</html>