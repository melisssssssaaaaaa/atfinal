<?php
include_once "../config/conf.inc.php";    // arquivo de configuração
// acao.php é responsável por inserir, editar e excluir um registro no banco de dados
$acao =  isset($_GET['acao'])?$_GET['acao']:"";

if ($acao == 'excluir'){ // exclui um registro do banco de dados
    try{
        $id =  isset($_GET['id'])?$_GET['id']:0;  // se for exclusão o ID vem via GET        
        excluir($id);
    }catch(PDOException $e){ // se ocorrer algum erro na execuçao da conexão com o banco executará o bloco abaixo
        print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
        die();
    }
}else{ // então é para inserir ou atualizar
    // cria a conexão com o banco de dados 
    $conexao = criaConexao();
    $atendimento = dadosFormularioParaVetor();
    // montar consulta
    if ($atendimento)
        if ($id > 0) // se o ID está informado é atualização
            editar($atendimento);
        else // senão será inserido um novo registro
            inserir($atendimento);
    else
        echo "Erro. Dados não preenchidos";
}

function dadosFormularioParaVetor(){
    if (isset($_POST['pet']) && isset($_POST['servico'])){
        $atendimento = array('pet' =>  isset($_POST['pet'])?$_POST['pet']:"",
                        'servico' =>  isset($_POST['servico'])?$_POST['servico']:"",
                        'id' =>  isset($_POST['id'])?$_POST['id']:0);
        return $atendimento;
    }else{
        return null;
    }
}

function criaConexao(){
    try{
        return new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);
    }catch(PDOException $e){ // se ocorrer algum erro na execuçao da conexão com o banco executará o bloco abaixo
            print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
            die();
    }catch(Exception $e){ // se ocorrer algum erro na execuçao da conexão com o banco executará o bloco abaixo
            print("Erro genérico...<br>".$e->getMessage());
            die();
    }
}


function excluir($id){
    // cria a conexão com o banco de dados 
    $conexao = criaConexao();
    $query = 'DELETE FROM atendimento WHERE id = :id';
    $stmt = $conexao->prepare($query);
    $stmt->bindValue(':id',$id);
    // executar a consulta
    if ($stmt->execute())
        header('location: cadAtendimento.php');
    else
        echo 'Erro ao excluir dados';
}

function inserir($atendimento){
        // cria a conexão com o banco de dados 
        $conexao = criaConexao();
        // montar consulta

        $query = 'INSERT INTO atendimento (pet, servico) 
                        VALUES (:pet, :servico)';
        // preparar consulta
        $stmt = $conexao->prepare($query);
        // vincular variaveis com a consulta
        $stmt->bindValue(':pet',$atendimento['pet']);        
        $stmt->bindValue(':servico',$atendimento['servico']);        

        // executar a consulta
        if ($stmt->execute())
            header('location: ListaAtendimento.php');
        else
            echo 'Erro ao inserir/editar dados';
}

function editar($atendimento){
    // cria a conexão com o banco de dados 
    $conexao = criaConexao();
    // montar consulta

    $query = 'UPDATE atendimento 
                SET pet = :pet, servico = :servico
                WHERE id = :id';
    // preparar consulta
    $stmt = $conexao->prepare($query);
    // vincular variaveis com a consulta
    $stmt->bindValue(':nome',$atendimento['nome']);        
    $stmt->bindValue(':email',$atendimento['email']);        

    // executar a consulta
    if ($stmt->execute())
        header('location: ListaAtendimento.php');
    else
        echo 'Erro ao inserir/editar dados';
}
?>