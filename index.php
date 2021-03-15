<?php

include 'nav/cabecalho.php';
require_once 'pessoa.php';

$pessoa = new pessoa("crudpdo","localhost:3307", "root", "root");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<!----------- CADASTRO DE USUARIO-------->
    <?php
    //---------verificar se clicou no botao cadastrar ou no editar
    if(isset($_POST['nome']))
    {
        if(isset($_GET['update']) && !empty($_GET['update']))
        {   
            $update = $_GET['update'];
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];

            if(!empty($nome) && !empty($telefone) && !empty($email))
            {   
                //--------editar
                if(!$pessoa->atualizarDados($update, $nome, $telefone, $email))
                header("location: index.php");

                {
                    echo "Email já esta cadastrado";
                }
            
            }
            else
            {
                echo "Preencha todos os campos";
            }

        }
        //-------------------CADASTRAR-------------
        else
        {
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];

            if(!empty($nome) && !empty($telefone) && !empty($email))
            {   
                //cadastrar
                if(!$pessoa->cadastrarPessoa($nome, $telefone, $email))

                {
                    echo "Email já esta cadastrado";
                }
            
            }
            else
            {
                echo "Preencha todos os campos";
            }

        }    

    }


    ?>
<!------------------------------EDITAR USUARIO--------->
    <?php
        if(isset($_GET['update'])) //se a pessoa clicou no botao editar
        {
            $update = $_GET['update'];
            $resposta = $pessoa->buscarDadosPessoa($update);
        }
    ?>

    <?php
//----------------------------EXCLUIR O USUARIO---------
        if(isset($_GET['id']))
        {
            $id_pessoa = $_GET['id'];
            $pessoa->excluirPessoa($id_pessoa);
            header("Location: index.php");
        }

    ?>

    <section id="esquerda">
        <form method="POST">
            <h2>CADASTRO</h2>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome"
            value="<?php if(isset($resposta)){echo $resposta['nome'];} ?>"
            >

            <label for="telefone">Telefone</label>
            <input type="number" name="telefone" id="telefone"
            value="<?php if(isset($resposta)){echo $resposta['telefone'];} ?>"
            >

            <label for="email">Email</label>
            <input type="email" name="email" id="email"
            value="<?php if(isset($resposta)){echo $resposta['email'];} ?>"
            >

            <input type="submit" value="<?php if(isset($resposta)){echo "Atualizar";}else{echo "Cadastrar";} ?>">
        
        </form>

    </section>

    <section id="direita">
    <table>
            <tr id="titulo">
                <td>NOME</td>
                <td>TELEFONE</td>
                <td colspan="2">EMAIL</td>
            </tr>
        <?php
            $dados = $pessoa->buscarDados(); //recebendo todos os usuarios do banco
            if(count($dados) > 0) //maior que zero ta preenchido, cadastrado
            {
                for ($i=0; $i < count($dados); $i++)
                { 
                    echo "<tr>";

                   foreach ($dados[$i] as $key => $value)
                   {
                       if($key != "id")
                       {
                            echo "<td>" . $value . "</td>";
                       }
                   }
        ?>
                <td>
                   <a href="index.php?update=<?php echo $dados[$i]['id'];?> "class="btn btn-warning">Editar</a>

                   <a href="index.php?id=<?php echo $dados[$i]['id'];?> "class="btn btn-danger">Excluir</a>  
                </td>

        <?php
                   echo "</tr>";
                }
            }
            else //O bando de dados esta vazio
            {
                echo "Ainda não há pessoas cadastradas";
            }
        ?> 
        
        </table>

    </section>

</body>
</html>


