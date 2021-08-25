<?php 

include('config/constantes.php');

if (isset($_GET['idTarefa'])) {
	$idTarefa = $_GET['idTarefa'];

	$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
	$sql = "DELETE FROM tarefa WHERE idTarefa = $idTarefa";
	
	$res = mysqli_query($conn, $sql);
	
	if ($res == true) {
		$_SESSION['delete'] = "Task Deleted Sucessfully";
		header('location:'.SITEURL);
	} else {
		$_SESSION['deleteFail'] = "Failed to Delete Task".var_dump($res)." ";
		header('location:'.SITEURL);
	}

} else {
	header('location:'.SITEURL);
}

?>