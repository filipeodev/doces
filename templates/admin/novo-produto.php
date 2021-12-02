<?php
$img = "../../";
$title = "Cadastrar produto";
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
<form class="row g-3" method="post" action="<?= url("admin/cadastrar-produto");?>" enctype="multipart/form-data">
	<div class="col-md-12">
		<label for="nome" class="form-label">Nome</label>
		<input type="text" class="form-control" id="nome" name="nome" required>
	</div>
	<div class="col-md-12">
		<label for="valor-total" class="form-label">Valor total</label>
		<input type="text" class="form-control" id="valor-total" name="valor-total" required>
	</div>
	<div class="col-md-12">
		<label for="ganho-colaborador" class="form-label">Ganho do Colaborador</label>
		<input type="text" class="form-control" id="ganho-colaborador" name="ganho-colaborador" required>
	</div>
	<div class="col-md-12">
		<label for="ganho-empresa" class="form-label">Ganho da Empresa</label>
		<input type="text" class="form-control" id="ganho-empresa" name="ganho-empresa" required>
	</div>
	<div class="col-12">
		<button type="submit" class="btn btn-primary">Cadastrar</button>
	</div>
</form>
<?include('templates/admin/footer.php')?>