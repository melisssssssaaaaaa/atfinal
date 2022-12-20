<script src="scriptPet.js"></script>

<!DOCTYPE html>
<?php
include_once "../config/conf.inc.php";
$acao = isset($_GET["acaoPet"]) ? $_GET["acaoPet"] : "";
$id = isset($_GET["idPet"]) ? $_GET["idPet"] : "";
$query = 'SELECT * from petshop.dono';
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

if ($acao == "editar") {
    try {
        include_once "../config/conf.inc.php";
        $conexao = new PDO(MYSQL_DSN, DB_USER, DB_PASSWORD);

        $query = "SELECT * FROM pet WHERE idPet = :id";

        $stmt = $conexao->prepare($query);

        $stmt->bindValue(':id', $id);

        $stmt->execute();
        $Pet = $stmt->fetch();
    } catch (PDOException $e) {
        print("Erro ao conectar com o banco de dados . . . <bre>" . $e->getMessage());
        die();
    }
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body>

<body class='container'>
    <h1>Cadastro de Pets</h1>
    <section id='cadPet' class='row'>

    <br>
    <div class="container-fluid">
    <form class = "form" action="acaoPet.php" method="POST"> 
            <div class="form-row">
                <div class="col-md-6">
                    <input readonly class="form-control-plaintext" type="text" id="idPet" name="idPet" value=<?php if (isset($Pet)) echo $Pet['idPet']; else echo 0; ?>>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                <label for="NomePet">Nome do Pet:</label>
                    <input type="text" class="form-control" placeholder="Escreva o nome do seu pet..." name="nomePet" required value=<?= isset($Pet) ? $Pet['nomePet'] : '' ?>>
                    <span class="error"></span>
                </div>
                <p>
                        <label for="SexoPet">Sexo:</label>
                            <select  class="form-select"  name="SexoPet" id="SexoPet">
                                <option value="0">Selecione</option>
                                <option value="1"  <?php if(isset($Pet) and $Pet['Sexo'] == 1) echo 'selected'; ?>>Fêmea</option>
                                <option value="2"  <?php if(isset($Pet) and $Pet['Sexo'] == 2) echo 'selected'; ?>>Macho</option>
                            </select>
                        </div>
                        <p>

                        <div>
                        <label for="TipodePet">Tipo de Pet? </label>
                            <select  class="form-select"  name="TipodePet" id="TipodePet">
                                <option value="0">Selecione</option>
                                <option value="1"  <?php if(isset($Pet) and $Pet['Pet'] == 1) echo 'selected'; ?>>Cachorro</option>
                                <option value="2"  <?php if(isset($Pet) and $Pet['Pet'] == 2) echo 'selected'; ?>>Gato</option>
                                <option value="3"  <?php if(isset($Pet) and $Pet['Pet'] == 3) echo 'selected'; ?>>Ave</option>
                                <option value="4"  <?php if(isset($Pet) and $Pet['Pet'] == 4) echo 'selected'; ?>>Hamster</option>
                                <option value="5"  <?php if(isset($Pet) and $Pet['Pet'] == 5) echo 'selected'; ?>>Peixe</option>
                                <option value="6"  <?php if(isset($Pet) and $Pet['Pet'] == 6) echo 'selected'; ?>>Cobra</option>
                            </select>
                        </div>
                        <p>
                
                        <div>
                        <label for="donoPet">Dono do Pet:</label>
                            <select  class="form-select"  name="donoPet" id="donoPet">
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
                <button class=" btn btn-primary" type="submit" name="acao" value="salvar">Salvar</button>
                <input class="btn btn-cancel" type="reset" name="cancelar" value="Cancelar" onclick='window.location.href="index.html"'>
            </div>
        </form>
    </div>
</body>

</html>