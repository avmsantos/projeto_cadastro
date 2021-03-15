<?php

class Pessoa {

    private $pdo;
    //funcao de conexao com o banco
    public function __construct($dbname, $host, $user, $senha)
    {
        try
        {
            $this->pdo = new PDO("mysql:dbname=" . $dbname . ";host=" . $host, $user, $senha);
        }
        catch (PDOException $e) {
            echo "Erro banco de dados: " . $e->getMessage();
            exit();
        }
        catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
            exit();
        }
        
    }

    //-------------------------função para buscar dados para a tabela
    public function buscarDados()
    {
        $resposta = array();
        $cmd = $this->pdo->query("SELECT * FROM pessoa ORDER BY nome"); //ordenado por ordem alfabeta
        $resposta = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $resposta;
    }

    //-------------------------funcao cadastrar a pessoa no bando de dados
    public function cadastrarPessoa($nome, $telefone, $email)
    {
        //antes de cadastrar, verificar se ja existe o email
        $cmd = $this->pdo->prepare("SELECT id FROM pessoa WHERE email = :email");
        $cmd->bindValue(":email", $email);
        $cmd->execute();
        if($cmd->rowCount() > 0) //email ja existe
        {
            return false;
        }
        else //nao foi encontrado entao, cadastrar
        {
            $cmd = $this->pdo->prepare("INSERT INTO pessoa(nome, telefone, email) VALUE (:nome, :telefone, :email)");
            $cmd->bindValue(":nome", $nome);
            $cmd->bindValue(":telefone", $telefone);
            $cmd->bindValue(":email", $email);
            $cmd->execute();
            return true;
        }
    }

    //----------------------------funcao de excluir o usuario
    public function excluirPessoa($id)
    {
        $cmd = $this->pdo->prepare("DELETE FROM pessoa WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
    }

    //-----------------------------funcao editar para buscar dados de uma pessoa
    public function buscarDadosPessoa($id)
    {
        $resposta = array();
        $cmd = $this->pdo->prepare("SELECT * FROM  pessoa WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $resposta = $cmd->fetch(PDO::FETCH_ASSOC);
        return $resposta;
    }

    //------------------------------função de atualizar os dados no banco 
    public function atualizarDados($id, $nome, $telefone, $email)
    {
        
        $cmd = $this->pdo->prepare("UPDATE pessoa set nome = :nome, telefone = :telefone, email = :email WHERE id = :id");
        $cmd->bindValue(":nome", $nome);
        $cmd->bindValue(":telefone", $telefone);
        $cmd->bindValue(":email", $email);
        $cmd->bindValue(":id", $id);
        $cmd->execute();
       
    }

}