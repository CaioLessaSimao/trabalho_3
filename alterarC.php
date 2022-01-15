<html>   
    <head>
        <title></title>
        <meta charset = 'utf-8' lang = 'pt-BR'/>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <?php
            $op = '';
            $num = '';
            $dt_em = '';
            $dt_ven = '';
            $mot;
            $tipo = '';

            if(isset($_REQUEST['btn_cad_cnh'])){
                $op = $_REQUEST['btn_cad_cnh'];
                
                if($op == 'finalizar'){
                
                    require_once "connection.php";
                
                    if(isset($_REQUEST['num']) && isset($_REQUEST['dt_em']) && isset($_REQUEST['dt_ven']) && isset($_REQUEST['mot']) && isset($_REQUEST['tipo'])){
                        $id = (int)$_REQUEST['id'];
                        $erros = [];

                        $aux_num = $_REQUEST['num'];

                        if(!filter_var($aux_num, FILTER_VALIDATE_INT)){
                            $erros[] = "Esse número de CNH é inválido"; 
                        }

                        $num = strval($aux_num);
                        
                        $aux_em = $_REQUEST['dt_em'];
                        
                        $aux_ven = $_REQUEST['dt_ven'];
                        
                        $dt_em = filter_var($aux_em, FILTER_SANITIZE_STRING);
                        $dt_ven = filter_var($aux_ven, FILTER_SANITIZE_STRING);

                        $mot = $_REQUEST['mot'];
                        
                        if(!filter_var($mot, FILTER_VALIDATE_INT)){
                            $erros[] = "Esse id é inválido"; 
                        }
                        
                        $tipo = $_REQUEST['tipo'];

                        $verify_query = "SELECT id FROM cnh WHERE fk_motorista_id = $mot and tipo = '$tipo';";

                        $verify_result = mysqli_query($conn, $verify_query);
                        $verify_row = mysqli_num_rows($verify_result);

                        if ($verify_row == 1) {
                            $erros[] = "O motorista ja possui uma CNH desse tipo";
                        }

                        if(count($erros)>0){
                            for($i=0;$i<count($erros);$i++){
                                echo $erros[$i];
                            }
                        }
                        else{

                        $query = "UPDATE cnh SET numero='$num', data_emissao='$dt_em', data_vencimento='$dt_ven', fk_motorista_id=$mot, tipo='$tipo' WHERE id = $id";

                        $result = mysqli_query($conn, $query);


                        if($result == 1){
                            mysqli_close($conn);
                            header("Location: visu_cnh.php");
                        }
                        else{
                            mysqli_close($conn);
                            header("Location: alterarC.php?id=$id");
                        }
                        
                    }

                }
                
            }
            else if($op == 'retornar'){
                    header("Location: visu_cnh.php");
            }
        }
        ?>
    </head>

    <body>

        <div class="cadastro">
            
            <div class="cadastro_form">

                <form id = 'form_cnh' action = 'alterarC.php?id=<?php echo $_REQUEST['id']; ?>' method = 'POST'>
                    <label for = 'num'>Insira o Número da Carteira de Habilitação Nacional:</label>
                    <input type = 'text' name = 'num'/><br>

                    <label for = 'dt_em'>Insira a data de emissão do documento:</label>
                    <input type = 'date' name = 'dt_em'></input><br>

                    <label for = 'dt_ven'>Insira a data de vencimento do documento:</label>
                    <input type = 'date' name = 'dt_ven'></input><br>
                    
                    <label for = 'mot'>Escolha o motorista possuidor do documento:</label>
                    <select name="mot" form = 'form_cnh'>
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

                        </select><br><br>
                    <label for = 'tipo'>Selecione o tipo de Carteira de Habilitação:</label>
                    <select name = 'tipo' form = 'form_cnh'>
                        <option value = 'A'>Tipo A (motos e triciclos)</option>
                        <option value = 'B'>Tipo B (carros de passeio)</option>
                        <option value = 'C'>Tipo C (veículos de carga acima de 3,5 ton)</option>
                        <option value = 'D'>Tipo D (veículos com mais de 8 passageiros)</option>
                        <option value = 'E'>Tipo E (veículos com unidade acoplada acima de 6 ton)</option>
                    </select><br><br>
                        
                    <button type = 'submit' name = 'btn_cad_cnh' value = 'finalizar'>Finalizar Cadastro</button><br><br>
                    <button type = 'submit' name = 'btn_cad_cnh' value = 'retornar'>Retornar</button><br>
                </form>

            </div>     

        <div>

    </body>

</html>