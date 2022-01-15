<html>
    <head>

        <title>OGGRM</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <meta charset = 'utf-8' lang = 'pt-BR'/>

        <?php
            $op = '';
            if(isset($_REQUEST['btn_menu'])){   
                $op = $_REQUEST['btn_menu'];
                if($op == 'cadastrar'){
                    header("Location: cadastrar_func.php");
                }
                else if ($op == 'login'){
                    header("Location: login.php");
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

                <form action = 'index.php' method = 'POST'>
                    <button type = 'submit' name = 'btn_menu' value = 'cadastrar'>Cadastrar-se</button><br/>
                    <button type = 'submit' name = 'btn_menu' value = 'login'>Realizar Login</button>

                </form>

            </div>

        <div>

    </body>

</html>

