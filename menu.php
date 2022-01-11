<?php 
    include "header.php";
?>

        <div>
            <form action = 'controle.php' method = 'POST'>
                <button type = 'submit' name = 'funcao' value = 'cad_unid'>Cadastrar Unidade</button><br/>
                <button type = 'submit' name = 'funcao' value = 'cad_mot'>Cadastrar Motorista</button><br/>
                <button type = 'submit' name = 'funcao' value = 'cad_cnh'>Cadastrar Cnh</button><br/>
                <button type = 'submit' name = 'funcao' value = 'cad_veic'>Cadastrar Veículo</button><br/>

                <br/>

                <button type = 'submit' name = 'funcao' value = 'visu_unid'>Visualizar Unidades</button><br/>
                <button type = 'submit' name = 'funcao' value = 'visu_mot'>Vizualizar Motoristas</button><br/>
                <button type = 'submit' name = 'funcao' value = 'visu_cnh'>Vizualizar CNHs</button><br/>
                <button type = 'submit' name = 'funcao' value = 'visu_veic'>Vizualizar Veículos</button><br/>
                <button type = 'submit' name = 'funcao' value = 'visu_func'>Vizualizar Funcionários</button><br/>
            </form>
        <div>
<?php
    include "footer.php";
?>