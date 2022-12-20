<?php

include_once "../config/conf.inc.php";

$idDono = isset($_POST["idDono"])?$_POST["idDono"]:0;
$nomeDono = isset($_POST["nomeDono"])?$_POST["nomeDono"]:"";
$telefoneDono = isset($_POST["telefoneDono"])?$_POST["telefoneDono"]:"";
$EnderecoDono = isset($_POST["EnderecoDono"])?$_POST["EnderecoDono"]:"";
$acao = isset($_POST["acaoDono"])?$_POST["acaoDono"]:"";

if ($acao == "excluir"){
    try{
        $idDono = isset($_GET["idDono"])?$_GET["idDono"]:0;

        $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);
        $query = "DELETE FROM Dono WHERE idDono = :idDono";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":idDono",$idDono);

        if($stmt->execute()){
            header("location: ListaDono.php");
        }else{
            echo "Erro";
        }

    }catch(PDOException $e){
        print("Erro ao conectar com o banco de dados . . . <br>".$e->getMessage());
        die();
    }
}else{

if($nomeDono != "" && $TelefoneDono != "" && $EnderecoDono != ""){
    try{
        $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);

        if($idDono > 0){
            $query = "UPDATE Dono SET nomeDono = :nomeDono, telefoneDono = :telefoneDono, EnderecoDono = :EnderecoDono WHERE idDono = :idDono";
        }else{
            $query = "INSERT INTO Dono (nomeDono, telefoneDono, EnderecoDono) VALUES(:nomeDono, :telefoneDono, :EnderecoDono)";
        }

        $stmt = $conexao->prepare($query);

        $stmt->bindValue(":nomeDono",$nomeDono);
        $stmt->bindValue(":telefoneDono",$telefoneDono);
        $stmt->bindValue(":EnderecoDono",$EnderecoDono);
        if($idDono > 0){
            $stmt->bindValue(":idDono",$idDono);
        }

        if ($stmt->execute()){
            header("location: ListaDono.php");
        }

    }catch(PDOException $e){
        print("Erro ao conectar com o banco de dados . . . <br>".$e->getMessage());
        die();
    }
}

}
?>