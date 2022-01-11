<html>
    <head>
        <title>Detran</title>
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
        <div>
            <form action = 'index.php' method = 'POST'>
                <button type = 'submit' name = 'btn_menu' value = 'cadastrar'>Cadastrar-se</button><br/>
                <button type = 'submit' name = 'btn_menu' value = 'login'>Realizar Login</button>
            </form>
        <div>
    </body>
</html>

