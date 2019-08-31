<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Aula Modelo</title>        
    </head>
    <body>
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
    <div id="listagem" name="listagem">
        
        <table border="1">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Sexo</th>
                    <th>Idade</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
            <?php

            //Caso tenha sido feito um POST da página
            if($_POST){
                $mysqli = new mysqli("localhost", "aluno","aluno", "kids");
                if ($mysqli->connect_error) {
                    die("Erro na conexão: ".$mysqli->connect_error);
                }

                $sql = "SELECT * FROM kids ";
                if(isset($_POST["pesquisa"])) {
                    $pesquisa = $_POST["pesquisa"];
                    $sql .= " WHERE nome like '%$pesquisa%' ";
                }
                $sql .= "ORDER BY nome";

                $resultado = $mysqli->query($sql);
                while($registro = $resultado->fetch_array())
                {  
                    $id = $registro["id"];
                    $nome = $registro["nome"];
                    $idade = $registro["idade"];
                    $sexo = $registro["sexo"];
                    $parto = $registro["parto"];
                    $cor = $registro["cor"];
                    $nomedamae = $registro["nomedamae"];
                    $email = $registro["email"];
                    $telefone = $registro["telefone"];
                   
                    echo "<tr>
                            <td>$nome</td>
                            <td>$sexo</td>
                            <td>$idade</td>
                            <td><a href='cadcrianca.php?id=$id'>Alterar</a> ||
                                <a href='processakid.php?id=$id'>Excluir</a></td>
                        </tr>";
                } 
                $resultado->free();
                $mysqli->close();
            }
            ?>
               
            </tbody>
        </table>
        </div>
    </body>
</html>