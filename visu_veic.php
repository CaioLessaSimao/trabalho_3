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
            public $placa;
            public $numero;
            public $data_aquisicao;
            public $consumo;
            public $motorista;
            public $tipo;
            public $marca;
            public $string;
            public $html;

            function __construct($placa, $numero, $data_aquisicao, $consumo, $motorista, $tipo, $marca, $id){
                $this->string = "<tr><td>".$placa."</td><td>".$numero."</td><td>".$data_aquisicao."</td><td>".$consumo."</td><td>".$motorista."</td><td>".$tipo."</td><td>".$marca."</td><td><a href='alterarV.php?id=$id'>Alterar</a></td><td><a href='controle.php?id=$id&funcao=deletar&tabela=veiculo&pagina=visu_veic.php'>Deletar</a></td></tr>";
                $this->html = $this->string;
            }
        }



        $query = $query = "SELECT v.placa, v.numero, v.data_aquisicao, v.consumo, m.id, v.tipo, v.marca, v.id FROM veiculo AS v INNER JOIN motorista AS m ON
        v.fk_motorista_id = m.id;";

        $result = mysqli_query($conn, $query);

        
        $placas = [];
        $numeros = [];
        $datas_aquisicao = [];
        $consumos = [];
        $motoristas = [];
        $tipos = [];
        $marcas = [];
        
        
        while ($row = mysqli_fetch_assoc($result)) {
		    $id = $row['id'];
            $placas[] = $row['placa'];
		    $numeros[] =  $row['numero']; 
            $datas_aquisicao[] = $row['data_aquisicao'];
            $motoristas[] = $row['id'];
            $consumos[] = $row['consumo'];
            $tipos[] = $row['tipo'];
            $marcas[] = $row['marca'];
		}

        
        for($i = 0; $i<count($placas); $i++){
            $placa = $placas[$i];
			
			$numero = $numeros[$i];

            $data_aquisicao = $datas_aquisicao[$i];

            $consumo = $consumos[$i];

            $motorista = $motoristas[$i];

            $tipo = $tipos[$i];
            
            $marca = $marcas[$i];

            $linha = new create_item($placa, $numero, $data_aquisicao, $consumo, $motorista, $tipo, $marca, $id);
            
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
                    <th>Placa</th>
                    <th>Número</th>
                    <th>Data de Aquisição</th>
                    <th>Consumo</th>
                    <th>Motorista</th>
                    <th>Tipo</th>
                    <th>Marca</th>
                </tr>
            </thead>
            
            <tbody>
                <?php echo $resultado; ?>
            </tbody>
    
    </table>

    <form id = 'bot_ret' action = 'visu_veic.php' method = 'POST'>

        <button type = 'submit' name = 'btn_ret_vis' value = 'retornar'>Retornar</button><br>

    </form>


</body>

</html>