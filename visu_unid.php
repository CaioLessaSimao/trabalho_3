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
            public $cep;
            public $email;
            public $numero;
            public $telefone;
            public $string;
            public $html;

            function __construct($id, $cep, $email, $numero, $telefone){
                $this->string = "<tr><td>".$cep."</td><td>".$email."</td><td>".$numero."</td><td>".$telefone."</td><td><a class='btn-crud' href='alterarU.php?id=$id'>Alterar</a></td><td><a class='btn-crud' href='controle.php?id=$id&funcao=deletar&tabela=unidade&pagina=visu_unid.php'>Deletar</a></td></tr>";
                $this->html = $this->string;
            }
        }
        

        $query = "SELECT id, cep, numero, telefone, email FROM unidade;";

        $result = mysqli_query($conn, $query);
        $ids = [];
        $ceps = [];
        $numeros = [];
        $telefones = [];
        $emails = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $ids[] = $row['id'];
            $ceps[] = strval($row['cep']);
            $emails[] =  $row['email'];
            $telefones[] = strval($row['telefone']);
            $numeros[] = strval($row['numero']); 
        }




        $array = [];
        
        for($i=0; $i < count($ceps); $i++){
            $id = $ids[$i];

            $cep = $ceps[$i];
            
            $email = $emails[$i];

            $numero = $numeros[$i];

            $telefone = $telefones[$i];
            
            $linha = new create_item($id,$cep,$email,$numero,$telefone);
            
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

                <form id = 'bot_ret' action = 'visu_unid.php' method = 'POST'>
            
                    <table>

                        <thead>
                            <tr>
                                <th>CEP</th>
                                <th>Email</th>
                                <th>Número</th>
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