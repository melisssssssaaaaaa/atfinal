<?php

include_once "../config/conf.inc.php";
$idPet = isset($_POST["idPet"])?$_POST["idPet"]:0;
$nomePet = isset($_POST["nomePet"])?$_POST["nomePet"]:"nome";
$TipodePet = isset($_POST["TipodePet"])?$_POST["TipodePet"]:"tipodePet";
$Sexo = isset($_POST["SexoPet"])?$_POST["SexoPet"]:"sexoerrado";
$Dono = isset($_POST["DonoPet"])?$_POST["DonoPet"]:"Dono";
$acao = isset($_POST["acaoPet"])?$_POST["acaoPet"]:"acaoPet";

  //echo $acao.'<br>';
 //echo $idPet.'<br>';
  //echo $nomePet.'<br>';
// echo $TipodePet.'<br>';
 //echo $Sexo.'<br>';
   //echo $Dono.'<br>';

if ($acao == "salvar"){
    try{
        $query = "INSERT INTO Pet ( NomePet, TipodePet, SexoPet, DonoPet) VALUES(:nomePet, :TipodePet, :SexoPet, :DonoPet)";
       $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);
       $stmt = $conexao->prepare($query);

       $stmt->bindValue(":nomePet",$nomePet);
       $stmt->bindValue(":TipodePet",$TipodePet);
       $stmt->bindValue(":Sexo",$Sexo);
       $stmt->bindValue(":Dono",$Dono);
       if($idPet > 0){
           $stmt->bindValue(":idPet",$idPet);
       }
       
        if($stmt->execute()){
            
            header("location: ListaPet.php");
        }else{
            echo "Erro";
        }

    }catch(PDOException $e){
        print("Erro ao conectar com o banco de dados... <br>".$e->getMessage());
        die();
    }
}else{
    echo 'a acao não é salvar';
}
?>