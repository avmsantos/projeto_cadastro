<?php
//----------------------------------CONEXAO-----------------------------
try {
    $pdo = new PDO("mysql:dbname=crudpdo;host=localhost:3307,", "root", "root"); //dbname, host, usuario e senha   
}
catch (PDOException $e) { //mostrar erro so do bando de dados
    echo "Erro com bando de dados: " . $e->getMessage();
}
catch(Exception $e) //mostra qualquer outro tipo de erro
{
    echo "Erro: " . $e->getMessage();
}





















//-----------------------------------INSERT---------------------------


//1º forma

//$cmd = $pdo->prepare("INSERT INTO pessoa(nome, telefone, email) VALUES (:nome, :telefone, :email)");
//$cmd->bindValue(":nome", "Amanda");
//$cmd->bindValue(":telefone", "7199025884");
//$cmd->bindValue(":email", "Amanda@gmail.com");
//$cmd->execute();

//2º forma

//$pdo->query("INSERT INTO pessoa(nome, telefone, email) VALUES ('testedenovo', '414845448484', 'testedenovo@gmail.com')");


//--------------------------UPDATE E DELETE--------------------------


//$cmd = $pdo->prepare("DELETE FROM pessoa WHERE id = :id");
//$id = 5;
//$cmd->bindValue(":id", $id);
//$cmd->execute();

//ou

//$cmd = $pdo->query("DELETE FROM pessoa WHERE id = '4'");



//$cmd = $pdo->prepare("UPDATE pessoa SET email = :email WHERE id = :id");
//$cmd->bindValue(":email", "atualizei@gmail.com");
//$cmd->bindValue(":id",1);
//$cmd->execute();

//$cmd = $pdo->query("UPDATE pessoa SET email = 'atualizeidenovo@gmail.com' WHERE id = '3'");


//---------------------------SELECT------------------------------

//$cmd = $pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
//$cmd->bindValue(":id",4);
//$cmd->execute();
//$resultados = $cmd->fetch(); //se fosse usar o fetchAll ai seria SELECT*FROM pessoa, iria pegar todos os registros, o fetch serve pra pegar pegar informação do BD e trasnformar em array

//foreach((array)$resultados as $resultado) {
  //  echo $resultado . ": " . "<br>";
//}