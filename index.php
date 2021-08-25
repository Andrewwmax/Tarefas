<!-- index.php -->
<?php 
	include('config/constantes.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <title>Tarefas</title>
</head>

<body>
    <a href="<?php echo SITEURL; ?>"><h1 class="display-1">Tarefas</h1></a>
    
    <div class="container">
        <div class="container-md">
            <table id="tabelaEditavel" class="table table-sm table-hover">
                <thead class="table-light">
                    <tr>
                        <th colspan="2">#</th>                        
                        <th>Nome da Tarefa</th>
                        <th>Custo</th>
                        <th>Data Limite</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody class="row_position">

                    <?php

                        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                                                
                        $sql = "SELECT * FROM tarefa ORDER BY ordemApresentacaoTarefa";
                        
                        $res = mysqli_query($conn, $sql);
                        
                        if($res == true){
                            $count_rows = mysqli_num_rows($res);
                            
                            if ($count_rows > 0) {

                                while ($row = mysqli_fetch_assoc($res)) {
                                    $idTarefa = $row['idTarefa'];
                                    $nomeTarefa = $row['nomeTarefa'];
                                    $custoTarefa = $row['custoTarefa'];
                                    $dataLimiteTarefa = $row['dataLimiteTarefa'];
                                    ?>
                                        <tr <?php 
                                                if($custoTarefa >= 500 && $custoTarefa < 1000){
                                                    echo "class=\"table-primary\"";
                                                } else if ($custoTarefa >= 1000){
                                                    echo "class=\"table-warning\"";
                                                }
                                        ?> id="<?php echo $idTarefa; ?>" name="<?php echo $idTarefa; ?>">
                                            <td><?php echo $idTarefa; ?></td>
                                            <td>
                                                <a href=""><i class="fas fa-chevron-up"></i></a>
                                                <a href=""><i class="fas fa-chevron-down"></i></a>
                                            </td>
                                            <td><?php echo $nomeTarefa; ?></td>
                                            <td><?php echo $custoTarefa; ?></td>
                                            <td><?php echo $dataLimiteTarefa; ?></td>
                                            <td>
                                                <!-- <a href="" onclick="popUpShow()"><i class="fas fa-edit" title="Editar"></i></a> -->
                                                <a href="<?php echo SITEURL; ?>excluirTarefa.php?idTarefa=<?php echo $idTarefa; ?>" onclick="return confirm('Deseja realmente excluir a Tarefa?')";><i class="fas fa-trash-alt" title="Excluir"></i></a>
                                            </td>
                                        </tr>
                                    <?php 
                                }
                            } else {
                                ?>	
                                    <tr>
                                        <td colspan="6">No tasks</td>
                                    </tr>
                                <?php 
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container">
        <div class="container-md">
           <a href="<?php echo SITEURL; ?>incluirTarefa.php"><button type="button" class="btn btn-outline-primary" title="Nova Tarefa">Incluir</button></a>
        </div>
    </div>
    
</body>
<script type="text/javascript" src="editarTabela.js"></script>
<script type="text/javascript">
    var selectedData = new Array();
    $(".row_position").sortable({
        delay: 150,
        stop: function() {
            // var selectedData = new Array();
            $(".row_position>tr").each(function() {
                selectedData.push($(this).attr("id"));
                // alert(selectedData.toString());
            });
            // alert(selectedData.toString());
            updateOrder(selectedData);
            // $.ajax({
            //     url: 'ajaxPost.php',
            //     type: 'post',
            //     data: selectedData,
            //     success: function() {
            //         alert("successfully");
            //     }
            // });
        }
    });

    function updateOrder(aData) {
        $.ajax({
            url: '/ajaxPost.php',
            type: 'post',
            data: {
                allData: aData
            },
            success: function() {
                alert("successfully");
            }
        });
    }
</script>

</html>