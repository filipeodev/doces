<?php
$img = "../../";
$title = "Criar compra";
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
<form class="row g-3" method="post" action="<?= url("admin/criar-compra");?>" enctype="multipart/form-data">
	<div class="col-md-12">
		<label for="item" class="form-label">Item</label>
		<input type="text" class="form-control" id="item" name="item" required>
	</div>
	<div class="col-md-12">
		<label for="valor" class="form-label">Valor Unitário</label>
		<input type="text" class="form-control" id="valor" name="valor" required>
	</div>
	<div class="col-md-12">
		<label for="qtd" class="form-label">Quantidade</label>
		<input type="number" class="form-control" id="qtd" name="qtd" required>
	</div>
	<div class="col-md-12">
		<label for="data" class="form-label">Data</label>
		<input type="date" class="form-control" id="data" name="data" required>
	</div>
	<div class="col-md-12">
		<input type="hidden" class="form-control" id="id_mes" name="id_mes" value="<?=$data[1]?>" required>
	</div>
	<div class="col-12">
		<button type="submit" class="btn btn-primary">Cadastrar</button>
	</div>
</form>
<?include('templates/admin/footer.php')?>