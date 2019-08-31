<?php
include_once "./crianca.class.php";

//Caso tenha sido feito um POST da página
if($_POST){

    //Verifica a existência dos campos no POST do formulário
    if(isset($_POST["nome"]) && isset($_POST["idade"]) && isset($_POST["sexo"]) && isset($_POST["parto"]) && isset($_POST["cor"]) && isset($_POST["nomedamae"]) && isset($_POST["email"]) && isset($_POST["telefone"]) ){
        
        //Crio uma instância de Cliente
        $crianca = new Crianca();
        
        //Passar dados do formulário para o Cliente
        $crianca->setId($_POST["id"]);
        $crianca->setNome($_POST["nome"]);
        $crianca->setIdade($_POST["idade"]);
        $crianca->setSexo($_POST["sexo"]);
        $crianca->setParto($_POST["parto"]);
        $crianca->setCor($_POST["cor"]);
        $crianca->setNomedamae($_POST["nomedamae"]);
        $crianca->setEmail($_POST["email"]);
        $crianca->setTelefone($_POST["telefone"]);
        
        //Chamo o método para salvar um crianca
        $retorno = $crianca->salvar();
        
        //Verifica se a execução ocorreu com sucesso ou não
        if ($retorno === true) {
            $id = $crianca->getID();
            if(empty($id)){
                echo "<p>Novo registro criado com sucesso!</p>";
            }else{
                echo "<p>Registro alterado com sucesso!</p>";
            }
            echo "<a href='cadcrianca.php'>Voltar</a>"; 
        } else {
            echo "Erro: Ocorreu um Erro!";
            echo "<a href='cadcrianca.php'>Voltar</a>";
        }

        
    }else{
        echo "<div>Houve um erro no envio do formulário</div>";
        echo "<a href='cadcrianca.php'>Voltar</a>";
    }
}else{

    if($_GET)
    {
        //Crio uma instância de crianca
        $crianca = new Crianca();
        
        //Passar dados do formulário para a crianca
        $crianca->setId($_GET["id"]);
       
        //Chamo o método para excluir uma crianca
        $retorno = $crianca->excluir();

        if ($retorno === true) {
            echo "<p>Registro apagado com sucesso!</p>";
            echo "<a href='cadcrianca.php'>Voltar</a>";
        } else {
            echo "Erro: Ocorreu um Erro!";
            echo "<a href='cadcrianca.php'>Voltar</a>";
        }

        
    }
}        