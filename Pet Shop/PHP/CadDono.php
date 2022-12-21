<?php
include_once "../config/conf.inc.php";   
// pega variáveis enviadas via GET - são enviadas para edição de um registro
$acao = isset($_GET['acao'])?$_GET['acao']:"";
$id = isset($_GET['id'])?$_GET['id']:"";

if ($acao == 'editar'){
    
    try{
        // cria a conexão com o banco de dados 
        $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);
        // montar consulta
        $query = 'SELECT * FROM Dono WHERE id = :id' ;
        // preparar consulta
        $stmt = $conexao->prepare($query);
        // vincular variaveis com a consult
        $stmt->bindValue(':id',$id); 
        // executa a consulta
        $stmt->execute();
        // pega o resultado da consulta - nesse caso a consulta retorna somente um registro pq estamos buscando pelo ID que é único 
        // por isso basta um fetch
        $Dono = $stmt->fetch(); 
         
    }catch(PDOException $e){ // se ocorrer algum erro na execuçao da conexão com o banco executará o bloco abaixo
        print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
        die();
    }  
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src='scriptDono.js'></script>
    <title>Cadastro de Donos</title>
</head>
<body class='container'>
    <h1>Cadastro de Donos</h1>
    <section id='cadDono' class='row'>
        
        <div class='col'>
            <form action="ListaDono.php" method="post">  
                <div class='row'>
                    <div class='col-1'>
                        <label for="id">Id:</label>
                        <input type="text" class='form-control' style='width:50px' readonly name="id" id="id" value=<?php if(isset($Dono)) echo $Dono['id']; else echo 0;?>>
                    </div>
                    <p>

                    <div class='col'>
                        <label for="name">Nome Completo:</label>
                        <input type="text" class='form-control' name='nome' id='nome' placeholder="Nome completo"  value=<?php if(isset($Dono)) echo $Dono['nome'] ?> >
                    </div>
                    <p>

                        <div>
                            <label class="form-label" for="telefone">Telefone:</label>
                            <input type="tel"  class="form-control"  id="telefone" name="telefone" placeholder="Digite aqui seu número..." value=<?=isset($contato)?$contato['telefone']:''?>>
                        </div>
                        <p>

                        <div>
                            <label class="form-label" for="Endereço:">Endereço:</label>
                            <input type="text"  class="form-control" id="Endereço:" name="Endereço:" placeholder="Digite aqui seu endereço..."  value=<?=isset($contato)?$contato['endereço']:''?>>
                        </div>
                        <p>


                    <div class='col'>  
                        <br>                  
                        <button type='submit' name='acao' value='salvar' class='btn btn-primary'>Enviar</button>
                        <input  class="btn btn-cancel"  type="reset" name="cancelar" value="Cancelar" onclick='window.location.href="CadDono.php"'>
                        <br>
                    </div>
                </div>
            </form>
        </div>
    </section>
        </div>
    </div>
</body>
</html>