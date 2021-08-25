<!-- addTask.php -->
<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
	include('config/constantes.php');

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <!-- Fonts Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="dist/jquery.tabledit.js"></script>
    <script type="text/javascript" src="editarTabela.js"></script>

    <title>Tarefas</title>
</head>
    <body>
        <a href="<?php echo SITEURL; ?>"><h1 class="display-1">Tarefas</h1></a>

        <?php 

            if (isset($_SESSION['addFail'])) {
                echo $_SESSION['addFail'];
                unset($_SESSION['addFail']);
            }
        ?>
        <div class="container w-50 justify-content-center">
            <div class="card ">
                <div class="card-header">
                    <h3>Incluir Tarefa</h3>
                </div>
                <div class="card-body center">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="nomeTarefa" class="form-label">Nome da Tarefa</label>
                            <input type="text" class="form-control" name="nomeTarefa">
                        </div>
                        <div class="mb-3">
                            <label for="custoTarefa" class="form-label">Custo da Tarefa</label>
                            <input type="number" class="form-control" name="custoTarefa">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="dataLimiteTarefa">Data Limite da Tarefa</label>
                            <input type="date" class="form-control" name="dataLimiteTarefa">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Incluir</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>


<?php 

	if (isset($_POST['submit'])) {
		$nomeTarefa = $_POST['nomeTarefa'];
		$custoTarefa = $_POST['custoTarefa'];
		$dataLimiteTarefa = $_POST['dataLimiteTarefa'];

		$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die(mysqli_error($conn));
        $sql = "SELECT MAX(ordemApresentacaoTarefa) as ordemNumero FROM tarefa";
 
        $res = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $newOrdem = $row['ordemNumero'] + 1;
            $sql = "INSERT INTO tarefa (nomeTarefa, custoTarefa, dataLimiteTarefa, ordemApresentacaoTarefa) VALUES
                ('".$nomeTarefa."', ".$custoTarefa.", '".$dataLimiteTarefa."', ".$newOrdem.");";
            // echo $sql;
            $res = mysqli_query($conn, $sql);
    		// var_dump($conn);
            
            if ($res == true) {
                $_SESSION['add'] = "Task Added Sucess";
                header('location:'.SITEURL);
            } else {
                $_SESSION['addFail'] = "Failed to Update List";
                header('location:'.SITEURL);
            }
        }
	}
?>