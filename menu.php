<?php 
    include "header.php";
?>

<link rel="stylesheet" type="text/css" href="css/styles.css">
        
        
        <div class="div_menu">

            <div class="botoes_cadastro">

                <div class="div_cadastro">

                    <h3>Cadastro</h3>

                    <form action = 'controle.php' method = 'POST'>
                        <button type = 'submit' name = 'funcao' value = 'cad_unid'>Cadastrar Unidade</button><br/>
                        <button type = 'submit' name = 'funcao' value = 'cad_mot'>Cadastrar Motorista</button><br/>
                        <button type = 'submit' name = 'funcao' value = 'cad_cnh'>Cadastrar Cnh</button><br/>
                        <button type = 'submit' name = 'funcao' value = 'cad_veic'>Cadastrar Veículo</button><br/>
                    </form>
                
                </div>
        
            </div>

            <br/>


            <div class="botoes_visu">

                <div class="div_visu">

                    <h3>Consulta</h3>

                    <form action = 'controle.php' method = 'POST'>
                        <button type = 'submit' name = 'funcao' value = 'visu_unid'>Visualizar Unidades</button><br/>
                        <button type = 'submit' name = 'funcao' value = 'visu_mot'>Vizualizar Motoristas</button><br/>
                        <button type = 'submit' name = 'funcao' value = 'visu_cnh'>Vizualizar CNHs</button><br/>
                        <button type = 'submit' name = 'funcao' value = 'visu_veic'>Vizualizar Veículos</button><br/>
                        <button type = 'submit' name = 'funcao' value = 'visu_func'>Vizualizar Funcionários</button><br/>
                    </form>

                <div>

            </div>
        
        </div>

<?php
    include "footer.php";
?>