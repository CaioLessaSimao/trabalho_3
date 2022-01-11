<html>
    <head>
    <title></title>
        <meta charset = 'utf-8' lang = 'pt-BR'/>
    
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
            public $cep;
            public $email;
            public $numero;
            public $telefone;
            public $string;
            public $html;

            function __construct($cep, $email, $numero, $telefone){
                $this->string = "<tr><td>".$cep."</td><td>".$email."</td><td>".$numero."</td><td>".$telefone."</td></tr>";
                $this->html = $this->string;
            }
        }
        

        $query = "SELECT cep, numero, telefone, email FROM unidade;";

        $result = mysqli_query($conn, $query);

        $ceps = [];
        $numeros = [];
        $telefones = [];
        $emails = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $ceps[] = strval($row['cep']);
            $emails[] =  $row['email'];
            $telefones[] = strval($row['telefone']);
            $numeros[] = strval($row['numero']); 
        }




        $array = [];
        
        for($i=0; $i < count($ceps); $i++){
            $cep = $ceps[$i];
            
            $email = $emails[$i];

            $numero = $numeros[$i];

            $telefone = $telefones[$i];
            
            $linha = new create_item($cep,$email,$numero,$telefone);
            
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

    <form id = 'bot_ret' action = 'visu_unid.php' method = 'POST'>

        <button type = 'submit' name = 'btn_ret_vis' value = 'retornar'>Retornar</button><br>

    </form>

</body>
</html>