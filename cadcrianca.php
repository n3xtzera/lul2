<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Aula Modelo</title>        
    </head>
    <body>
        <h1 align="center">Cadastro de Crianças</h1>
        <div id="cadastro" name="cadastro">
        <form name="formulario" action="listcrianca.php" method="POST">
        <link rel="stylesheet" type="text/css" href="style.css">
        <?php
        include_once "./crianca.class.php";

        if($_GET){
            $mysqli = new mysqli("localhost", "aluno","aluno", "kids");
            if ($mysqli->connect_error) {
                die("Erro na conexão: ".$mysqli->connect_error);
            }
            $id = $_GET["id"];
            $resultado = $mysqli->query("SELECT * FROM kids WHERE id = $id");
            while($registro = $resultado->fetch_array())
            {  
                $nome = $registro["nome"];
                $idade = $registro["idade"];
                $sexo = $registro["sexo"];  
                $parto = $registro["parto"]; 
                $cor = $registro["cor"]; 
                $nomemae = $registro["nomedamae"]; 
                $email = $registro["email"]; 
                $telefone = $registro["telefone"];               
            } 
            $resultado->free();
            $mysqli->close();
            
        }
        ?>
            <input type="hidden" name="id" id="id" value="<?= isset($cli) ? $cli->getId() : "";?>" />
            <fieldset>
                <div>
                    <label for="nome">Nome *:</label><br>
                    <input required type="text" size="50" name="nome" id="nome" placeholder="Informe seu nome" value="<?= isset($cli) ? $cli->getNome() : "";?>"/>
                </div>
                <div>
                    <label for="idade">Idade:</label><br>
                    <input required type="number" size="15" name="idade" id="idade" placeholder="Informe sua Idade" value="<?= isset($cli) ? $cli->getNome() : "";?>"/>
                </div>
                <div>
                    <label for="sexo">Sexo:</label>
                    <input required type="radio" size="50" name="sexo" id="sexo" value="feminino"<?php  isset($cli) && $cli->getSexo() == "feminino" ?  : "";?>/>Feminino
                    <input required type="radio" size="50" name="sexo" id="sexo" value="Masculino"<?php  isset($cli) && $cli->getSexo() == "masculino" ?  : "";?>/>Masculino<br>
                </div>
                <div>
                    <label for="parto">Parto:</label>
                    <input required type="hidden" name="parto" id="parto" value="0" <?php  isset($cli) && $cli->getParto() == "cesaria" ?  : "";?> />
                    <input required type="checkbox" name="parto" id="parto" value="1" checked <?php  isset($cli) && $cli->getParto() == "natural" ?  : "";?>/>Natural<br>
                </div>
                <div>
                    <label for="etnia">Etnia:</label>
                    <select name="etnia" id="etnia" required>
                        <option value="branca" <?php  isset($cli) && $cli->getEtnia() == "branca" ? "selected" : "";?>>Branca</option>
                        <option value="parda" <?php  isset($cli) && $cli->getEtnia() == "parda" ? "selected" : "";?>>Parda</option>
                        <option value="negra" <?php  isset($cli) && $cli->getEtnia() == "negra" ? "selected" : "";?>>Negra</option>
                        <option value="indigena" <?php  isset($cli) && $cli->getEtnia() == "indigena" ? "selected" : "";?>>Índigena</option>
                        <option value="amarela" <?php  isset($cli) && $cli->getEtnia() == "amarela" ? "selected" : "";?>>Amarela</option>
                    </select>
                </div>
                <div>
                    <label for="nomedamae">Nome da Mãe *:</label><br>
                    <input type="text" size="50" name="nomedamae" id="nomedamae" value="<?= isset($cli) ? $cli->getNomedamae() : "";?>"/>
                </div>
                <div>
                    <label for="email">Email:</label><br>
                    <input type="text" size="50" name="email" id="email" placeholder="Informe seu email" value="<?= isset($cli) ? $cli->getEmail() : "";?>"/>
                </div>
                <div>
                    <label for="telefone">Telefone:</label><br>
                    <input type="text" size="50" name="telefone" id="telefone" placeholder="Informe seu telefone" value="<?= isset($cli) ? $cli->getTelefone() : "";?>"/>
                </div>

                
                
                <button type="submit" name="cadastrar" id="cadastrar">Salvar</button>
                <button type="reset" name="limpar" id="limpar">Limpar</button>
            </fieldset>
        </form>
            
        </div>
    </body>
</html>