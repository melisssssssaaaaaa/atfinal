<?php
include_once "../config/conf.inc.php";
$acao = isset($_GET["acaoAtendimento"]) ? $_GET["acaoAtendimento"] : "";
$id = isset($_GET["idPet"]) ? $_GET["idPet"] : "";
$query = 'SELECT * from petshop.pet';
//mysqli_close($con);
$con = mysqli_connect('localhost','root','', 'petshop');
if (mysqli_connect_errno()) {
    echo "erro MySQL: " . mysqli_connect_error();
    mysqli_close($con);
    exit();
  }

$result = mysqli_query($con, $query);
$linhas = mysqli_fetch_all($result);
mysqli_close($con);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <title>Cadastro Atendimento</title>
</head>

<body class='container'>
    <div class='row'>
        <div class='col'>
            <section id="formulario-cadastro">
                <form  method="post" enctype="multipart/form-data">

                        <legend>Cadastro Atendimento:</legend>
                        <p>

                        <div>
                        <label for="Pet">Pet:</label>
                            <select  class="form-select"  name="Pet" id="Pet">
                            <option value="0">Selecione</option>
                            <?php
                            foreach($linhas as $linha){
                                    echo "<option value='$linha[0]'>$linha[1]</option>";
                            }
                            ?>
                            </select>
                            </div>
                       <br>
                        <div>
                            <label for="cidade">Serviços:</label>
                            <select  class="form-select" name="cidade" id="cidade" value=<?=isset($contato)?$contato['cidade']:''?>>
                                <option value="0">Selecione</option>
                                <option value="1" <?php if(isset($contato) and $contato['cidade'] == 1) echo 'selected'; ?>>Banho</option>
                                <option value="2" <?php if(isset($contato) and $contato['cidade'] == 2) echo 'selected'; ?>>Banho e Tosa</option>
                                <option value="3" <?php if(isset($contato) and $contato['cidade'] == 3) echo 'selected'; ?>>Tosa completa</option>
                                <option value="4" <?php if(isset($contato) and $contato['cidade'] == 4) echo 'selected'; ?>>Creche</option>
                                <option value="6" <?php if(isset($contato) and $contato['cidade'] == 6) echo 'selected'; ?>>Consulta</option>
                            </select>
                        </div>
                        <p>
        
                        <div>
                            <button  class="btn btn-primary"  type="submit" name="acao" value="salvar">Salvar</button>
                            <input  class="btn btn-cancel"  type="reset" name="cancelar" value="Cancelar" onclick='window.location.href="CadAtendimento.php"'>
                        </div>
                </form>
            </section>
        </div>
    </div>
</body>
</html>