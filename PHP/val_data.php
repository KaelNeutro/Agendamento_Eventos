<?php 

include_once 'conexao.php';

<?php 

include_once 'conexao.php';

$ini = $_POST['ini'];

$sql = "SELECT * FROM `onibus` WHERE `data`= '$ini' and `qtd_dis`>= 1";
$query = mysqli_query($con,$sql);

$val = mysqli_num_rows($query);

if ($val === 0) {
          # code...
?>
	<script type="text/javascript"> load('form','alert.php',null)</script>
<?php
	} else { //Abrindo o formulário de cadastro de eventos
?>
	<script type="text/javascript"> load('form','alert.php','$ini')</script>
<?php 
  } //Fechando o Else
?>


