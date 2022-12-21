<?php

include_once "../config/conf.inc.php";

$idDono = isset($_POST["idDono"])?$_POST["idDono"]:0;
$nomeDono = isset($_POST["nomeDono"])?$_POST["nomeDono"]:"";
$telefoneDono = isset($_POST["telefoneDono"])?$_POST["telefoneDono"]:"";
$EnderecoDono = isset($_POST["EnderecoDono"])?$_POST["EnderecoDono"]:"";


$acao = isset($_GET["acaoDono"])?$_GET["acaoDono"]:"";

if ($acao == "excluir"){
    try{
        $idDono = isset($_GET["idDono"])?$_GET["idDono"]:0;

        $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);
        $query = "DELETE FROM Dono WHERE idDono = :idDono";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":idDono",$idDono);

        if($stmt->execute()){
            header("location: CadDono.php");
        }else{
            echo "Erro";
        }

    }catch(PDOException $e){
        print("Erro ao conectar com o banco de dados . . . <br>".$e->getMessage());
        die();
    }
}else{

if($nomeDono != "" && $telefoneDono != "" && $enderecoDono != ""){
    try{
        $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);

        if($idDono > 0){
            $query = "UPDATE Dono SET nomeDono = :nomeDono, telefoneDono = :telefoneDono, enderecoDono = :enderecoDono WHERE idDono = :idDono";
        }else{
            $query = "INSERT INTO Dono (nomeDono, telefoneDono, enderecoDono) VALUES(:nomeDono, :telefoneDono, :enderecoDono)";
        }

        $stmt = $conexao->prepare($query);

        $stmt->bindValue(":nomeDono",$nomeDono);
        $stmt->bindValue(":telefoneDono",$telefoneDono);
        $stmt->bindValue(":enderecoDono", $enderecoDono);
        if($idDono > 0){
            $stmt->bindValue(":idDono",$idDono);
        }

        if ($stmt->execute()){
            header("location: listaDono.php");
        }

    }catch(PDOException $e){
        print("Erro ao conectar com o banco de dados . . . <br>".$e->getMessage());
        die();
    }
}

}
?>