<?php 
    // var_dump($_POST);

    include('config/constantes.php');
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // $sql = "SELECT * FROM tarefa ORDER BY ordemApresentacaoTarefa";
                        
    // $res = mysqli_query($conn, $sql);

    // ERRO - POST vazio
    if (isset($_POST['id'])) {
        var_dump($_POST['id']);
        
        $allData = $_POST['selectedData'];
        $i = 1;
        foreach ($allData as $key => $value) {
            $sql = "UPDATE tarefa SET ordemApresentacaoTarefa=".$i." WHERE idTarefa=".$value;
            $res = mysqli_query($conn, $sql); 
            if ($res == true) {
                echo "True";
            }
            $i++;
        }
    } else {
        echo "error";
    }
    
?>