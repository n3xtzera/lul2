<?php

class crianca {
    private $id;
    private $nome;
    private $idade;
    private $sexo;
    private $parto;
    private $cor;
    private $nomedamae;
    private $email;
    private $telefone;

    public function getId() {
        return $this->id;
    }
    public function setId($valor) {
        $this->id = $valor;
    }

    public function getNome() {
        return $this->nome;
    }
    public function setNome($valor) {
        $this->nome = $valor;
    }

    public function getIdade() {
        return $this->idade;
    }
    public function setIdade($valor) {
        $this->idade = $valor;
    }

    public function getSexo() {
        return $this->sexo;
    }
    public function setSexo($valor) {
        $this->sexo = $valor;
    }

    public function getParto() {
        return $this->parto;
    }
    public function setParto($valor) {
        $this->parto = $valor;
    }

    public function getCor() {
        return $this->cor;
    }
    public function setCor($valor) {
        $this->cor = $valor;
    }

    public function getNomedamae() {
        return $this->nomedamae;
    }
    public function setNomedamae($valor) {
        $this->nomedamae = $valor;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($valor) {
        $this->email = $valor;
    }

    public function getTelefone() {
        return $this->telefone;
    }
    public function setTelefone($valor) {
        $this->telefone = $valor;
    }

    public function salvar(){
        $retorno = true;
        
        //Cria a conexão com o banco de dados
        $mysqli = new mysqli("localhost", "aluno", "aluno", "kids");
        if ($mysqli->connect_error) {
            die("Erro na conexão: " . $mysqli->connect_error);
        }

       if(empty($this->id)){
            //Comando SQL para inserir uma crianca
            $sql = " INSERT INTO kids " .
                " (nome, idade, sexo, parto, cor, nomedamae, email, telefone) " .
                " VALUES ('$this->nome','$this->idade','$this->sexo', ,'$this->parto', ,'$this->cor', ,'$this->nomedamae', ,'$this->email', ,'$this->telefone')";
        }else{
            //Comando SQL para alterar uma crianca
            $sql = " UPDATE kids SET "  .
                   " nome = '$this->nome' ," .
                   " idade = '$this->idade', " .
                   " sexo = '$this->sexo' " . 
                   " parto = '$this->parto' " . 
                   " cor = '$this->cor' " . 
                   " nomedamae = '$this->nomedamae' " . 
                   " email = '$this->email' " . 
                   " telefone = '$this->telefone' " . 
                   " WHERE id = $this->id ";
        }
        //Executa o comando SQL
        $resultado = $mysqli->query($sql);

        if($mysqli->affected_rows>0){
            $retorno = true;
        }

        //Fecha a conexão com o banco de dados
        $mysqli->close();
        
        return $retorno;
    }
    public function excluir(){
        $retorno = true;
        
        //Cria a conexão com o banco de dados
        $mysqli = new mysqli("localhost", "aluno", "aluno", "kids");
        if ($mysqli->connect_error) {
            die("Erro na conexão: " . $mysqli->connect_error);
        }
        
        $sql = " DELETE FROM kids " .
               " WHERE id=$this->id";
        //Executa o comando SQL
        $resultado = $mysqli->query($sql);
        if($mysqli->affected_rows>0){
            $retorno = true;
         }
        
        //Fecha a conexão com o banco de dados
        $mysqli->close();

        return $retorno;
    }
    public function buscar(){
        
        //Crio um crianca vazio
        $cli = new crianca();

        $mysqli = new mysqli("localhost", "aluno","aluno", "kids");
        if ($mysqli->connect_error) {
            die("Erro na conexão: ".$mysqli->connect_error);
        }
        
        $resultado = $mysqli->query("SELECT * FROM kids WHERE id = $this->id");
        if($registro = $resultado->fetch_array())
        {  
            //Percorre o resultset e preenche a instância da classe crianca
            $cli->id = $registro["id"];
            $cli->nome = $registro["nome"];
            $cli->idade = $registro["idade"];
            $cli->sexo = $registro["sexo"];                        
                
        } 
        $resultado->free();
        $mysqli->close();

        //retorno o crianca encontrado
        return $cli;
    }

    public function listar($pesquisa){
      
        //Crio um array vazio de criancas
        $criancas = array();

        //Cria conexão com o banco
        $mysqli = new mysqli("localhost", "aluno","aluno", "kids");
        if ($mysqli->connect_error) {
            die("Erro na conexão: ".$mysqli->connect_error);
        }

        //Comando SQL para pesquisar um crianca
        $sql = " SELECT * FROM kids " .
               " WHERE nome like '%$pesquisa%' " .
               " ORDER BY nome";
       
        $resultado = $mysqli->query($sql);
        while($registro = $resultado->fetch_array())
        {  
            //Percorre o resultset e preenche a instância da classe crianca
            $cli = new Crianca();
            $cli->setId($registro["id"]);
            $cli->setNome($registro["nome"]);
            $cli->setIdade($registro["idade"]);
            $cli->setSexo($registro["sexo"]);
            $cli->setParto($registro["parto"]);
            $cli->setCor($registro["cor"]);
            $cli->setNomedamae($registro["nomedamae"]);
            $cli->setEmail($registro["email"]);
            $cli->setTelefone($registro["telefone"]);
            
            //Adiciona o ciente ao array
            $criancas[] = $cli;
            
        } 
        //Fecho a conexão com o banco de dados
        $resultado->free();
        $mysqli->close();
       
        //retorno os criancas encontrados
        return $criancas;
    }
}