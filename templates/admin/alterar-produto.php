<?php
$img = "../../";
$title = "Alterar produto";
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
<div class="voltar-pagina">
	<a href="<?=url('admin/produtos')?>" title="Voltar"><i class="fas fa-arrow-left"></i> Voltar</a>
</div>
<br class="clear">
<form class="row g-3" method="post" action="<?= url("admin/alterar-produto");?>" enctype="multipart/form-data">
	<div class="col-md-12">
		<label for="nome" class="form-label">Nome</label>
		<input type="text" class="form-control" id="nome" name="nome" value="<?=$data[1]['nome_produto']?>"  required>
	</div>
	<div class="col-md-12">
		<label for="valor-total" class="form-label">Valor total</label>
		<input type="text" class="form-control" id="valor-total" name="valor-total" value="<?=$data[1]['valor_total']?>"  required>
	</div>
	<div class="col-md-12">
		<label for="ganho-colaborador" class="form-label">Ganho do Colaborador</label>
		<input type="text" class="form-control" id="ganho-colaborador" name="ganho-colaborador" value="<?=$data[1]['ganho_colaborador']?>"  required>
	</div>
	<div class="col-md-12">
		<label for="ganho-empresa" class="form-label">Ganho da Empresa</label>
		<input type="text" class="form-control" id="ganho-empresa" name="ganho-empresa" value="<?=$data[1]['ganho_empresa']?>"  required>
	</div>
	<div class="col-md-12">
		<input type="hidden" class="form-control" id="id_produto" name="id_produto" value="<?=$data[1]['id_produto']?>"  required>
	</div>
	<div class="col-12">
		<button type="submit" class="btn btn-primary">Alterar</button>
	</div>
</form>
<?include('templates/admin/footer.php')?>