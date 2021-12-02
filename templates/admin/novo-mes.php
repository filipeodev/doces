<?php
$img = "../";
$title = "Cadastrar novo mês";
include('templates/admin/header.php');
if($data[0] != ''){
  echo "<script>
    swal({
      title: '".$data[0] ."',
      icon: 'error',
    });
  </script>";
}
?>
<h1><?=$title?></h1>
<br class="clear">
<form class="row g-3" method="post" action="<?= url("admin/novo-mes");?>" enctype="multipart/form-data">
	<div class="col-md-12">
		<label for="mes" class="form-label">Mês</label>
		<select class="form-select" aria-label="Default select example" id="mes" name="mes" required>
			<option value="" selected>Selecione</option>
			<option value="01">Janeiro</option>
			<option value="02">Fevereiro</option>
			<option value="03">Março</option>
			<option value="04">Abril</option>
			<option value="05">Maio</option>
			<option value="06">Junho</option>
			<option value="07">Julho</option>
			<option value="08">Agosto</option>
			<option value="09">Setembro</option>
			<option value="10">Outubro</option>
			<option value="11">Novembro</option>
			<option value="12">Dezembro</option>
		</select>
	</div>
	<div class="col-md-12">
		<label for="ano" class="form-label">Ano</label>
		<select class="form-select" aria-label="Default select example" id="ano" name="ano" required>
			<option value="" selected>Selecione</option>
			<option value="2021">2021</option>
			<option value="2022">2022</option>
			<option value="2023">2023</option>
			<option value="2024">2024</option>
			<option value="2025">2025</option>
		</select>
	</div>
	<div class="col-12">
		<button type="submit" class="btn btn-primary">Cadastrar</button>
	</div>
</form>
<?include('templates/admin/footer.php')?>