<?php

$user = isset($_POST['user'])?$_POST['user']:"";
$senha = isset($_POST['senha'])?$_POST['senha']:"";

if ($user != "" && $senha != ""){
   include "../config/conexao.php";
    $query = 'SELECT * FROM petshop.login Where usuario = :user and senha=:senha';

    $stmt = $conexao->prepare($query);

    $stmt->bindValue(":user",$user);
    $stmt->bindValue(":senha",$senha);

    var_dump($stmt);
    if ($stmt->execute()){
        $adm = $stmt->fetch();

        if($adm){ 
            $_SESSION["usuario"] = $adm["senha"];
            header("location: index.html");
        }else{
            header("location:login.php");
        }
    }
}
?>

