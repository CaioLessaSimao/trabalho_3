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
            $placa = '';
            $dt_aq = '';
            $mot;
            $tipo = '';
            $marca = '';

            /*&& isset($_REQUEST['arquivo'])*/

            if(isset($_REQUEST['btn_cad_veic'])){
                $op = $_REQUEST['btn_cad_veic'];
                if($op == 'finalizar'){
                   require_once "connection.php";
                   if(isset($_REQUEST['placa']) && isset($_REQUEST['dt_aq']) && isset($_REQUEST['mot']) && isset($_REQUEST['tipo']) && isset($_REQUEST['marca']) && isset($_REQUEST['consumo'])){
                        
                        $aux = $_REQUEST['placa'];
                        
                        $dt_aq = (int)$_REQUEST['dt_aq'];
                        
                        $mot = $_REQUEST['mot'];

                        $aux2 = $_REQUEST['num'];

                        $consumo = $_REQUEST['consumo'];

                        $tipo = $_REQUEST['tipo'];
                        
                        $marca = $_REQUEST['marca'];


                        $erros = [];

                        $placa = filter_var($aux, FILTER_SANITIZE_STRING);

                        $num = filter_var($aux2, FILTER_SANITIZE_NUMBER_INT);

                        if(!filter_var($mot, FILTER_VALIDATE_INT)){
                            $erros[] = "Motorista inválido"; 
                        }

                        if(!filter_var($consumo, FILTER_VALIDATE_FLOAT)){
                            $erros[] = "Consumo inválido";
                        }



                        $verify_query = "SELECT id FROM veiculo WHERE placa = '$placa';";
                        $verify_result = mysqli_query($conn, $verify_query);

                        $verify_row = mysqli_num_rows($verify_result);

                        if ($verify_row == 1) {
                            $erros[] = "Ja existe um veículo registrado com essa placa";
                        }

                        if(count($erros)>0){
                            foreach ($erros as $i) {
                                echo $i;
                            }
                        }

                        else{

                            $query = "INSERT INTO veiculo (placa, data_aquisicao, fk_motorista_id, tipo, marca, numero, consumo) VALUES ('$placa', '$dt_aq', $mot, '$tipo', '$marca', $num, $consumo);";

                            $result = mysqli_query($conn, $query);
                        
                        if($result == 1){
                            mysqli_close($conn);
                            header("Location: menu.php");
                        }
                        else{
                            mysqli_close($conn);
                            header("Location: cad_veic.php");
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
                
                <form id = 'form_veic' action = 'cad_veic.php' method = 'POST'>
                    <label for = 'placa'>Insira a Placa do veículo:</label>
                    <input type = 'text' name = 'placa'/><br>

                    <label for = 'num'>Insira o número do veículo:</label>
                    <input type = 'text' name = 'num'/><br>

                    <label for = 'dt_aq'>Insira a data de sua aquisição:</label>
                    <input type = 'date' name = 'dt_aq'></input><br>

                    <label for = 'consumo'>Insira o consumo do veículo(km/l):</label>
                    <input type = 'text' name = 'consumo'></input><br>
                    
                    <label for = 'mot'>Escolha o motorista proprietário do veículo:</label>
                    <select name="mot" form = 'form_veic'>
                        <?php
                            require_once "connection.php";
                                
                            $sql = "SELECT id,nome FROM motorista;";

                            $resultado = mysqli_query($conn,$sql);

                            while($dados = mysqli_fetch_array($resultado)):

                        ?>
                            
                        <option value = "<?php echo $dados['id'];?>"><?php echo $dados['nome'];?></option>
                                
                            <?php endwhile; ?>

                            <?php while($dados = mysqli_fetch_array($resultado)):?>
                                
                                <option value = "<?php echo $dados['id'];?>"><?php echo $dados['nome'];?></option>
                                
                            <?php endwhile; ?>

                        </select><br>
                    <label for = 'tipo'>Selecione o tipo de veículo:</label>
                    <select name = 'tipo' form = 'form_veic'>
                        <option value = 'A'>moto ou triciclo</option>
                        <option value = 'B'>carro de passeio</option>
                        <option value = 'C'>veículo de carga acima de 3,5 ton</option>
                        <option value = 'D'>veículo com mais de 8 passageiros</option>
                        <option value = 'E'>veículo com unidade acoplada acima de 6 ton</option>
                    </select><br>
                    
                    <label for = 'marca'>Selecione a marca do automóvel:</label>
                    <select name = 'marca' form = 'form_veic'>
                        <option value = 'TOY'>Toyota</option>
                        <option value = 'HYU'>Hyundai</option>
                        <option value = 'CHE'>Chevrolet</option>
                        <option value = 'FOR'>Ford</option>
                        <option value = 'WOL'>Wolkswagen</option>
                        <option value = 'FIA'>Fiat</option>
                        <option value = 'REN'>Renaut</option>
                        <option value = 'PEU'>Peugeaut</option>
                        <option value = 'SUZ'>Suzuki</option>
                        <option value = 'KIA'>Kia</option>
                        <option value = 'HON'>Honda</option>
                        <option value = 'NIS'>Nissan</option>
                        <option value = 'JEE'>Jeep</option>
                    </select><br>

                    <button type = 'submit' name = 'btn_cad_veic' value = 'finalizar'>Finalizar Cadastro</button><br>
                    <button type = 'submit' name = 'btn_cad_veic' value = 'retornar'>Retornar</button><br>
                </form>
                
            <div>

        </div>

    </body>
    
</html>