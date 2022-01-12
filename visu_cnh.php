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
            public $id;
            public $nome;
            public $numero;
            public $tipo;
            public $data_emissao;
            public $data_vencimento;
            public $string;
            public $html;

            function __construct($id,$nome, $numero, $tipo, $data_emissao, $data_vencimento){
                $this->string = "<tr><td>".$nome."</td><td>".$numero."</td><td>".$tipo."</td><td>".$data_emissao."</td><td>".$data_vencimento."</td><td><a href='alterarC.php?id=$id'>Alterar</a></td><td><a href='controle.php?id=$id&funcao=deletar&tabela=cnh&pagina=visu_cnh.php'>Deletar</a></td></tr>";
                $this->html = $this->string;
            }
        }



        $query = "SELECT c.id,c.numero,c.tipo, c.data_emissao, c.data_vencimento,m.nome FROM cnh AS c INNER JOIN motorista AS m ON
        c.fk_motorista_id = m.id;";

        $result = mysqli_query($conn, $query);

        $ids = [];
        $nomes = [];
        $numeros = [];
        $tipos = [];
        $datas_emissao = [];
        $datas_vencimento = [];
        
        
        while ($row = mysqli_fetch_assoc($result)) {
		    $ids[] = $row['id'];
            $nomes[] = $row['nome'];
		    $numeros[] =  $row['numero']; 
            $tipos[] = $row['tipo'];
            $datas_vencimento[] = $row['data_vencimento'];
            $datas_emissao[] = $row['data_emissao'];
		}

        
        for($i = 0; $i<count($nomes); $i++){
            $id = $ids[$i];
            
            $nome = $nomes[$i];
			
			$numero = $numeros[$i];

            $tipo = $tipos[$i];

            $data_emissao = $datas_emissao[$i];

            $data_vencimento = $datas_vencimento[$i];

            $linha = new create_item($id,$nome, $numero, $tipo, $data_emissao, $data_vencimento);
            
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
                    <th>Número</th>
                    <th>Tipo</th>
                    <th>Data de emissão</th>
                    <th>Data de vencimento</th>
                </tr>
            </thead>
            
            <tbody>
                <?php echo $resultado; ?>
            </tbody>
    
    </table>


    <form id = 'bot_ret' action = 'visu_cnh.php' method = 'POST'>

        <button type = 'submit' name = 'btn_ret_vis' value = 'retornar'>Retornar</button><br>

    </form>
    
</body>

</html>