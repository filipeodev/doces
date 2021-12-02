<?php
$img = "../../";
$title = "Editar Usuario";
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
	<a href="<?=url('admin/usuarios')?>" title="Voltar"><i class="fas fa-arrow-left"></i> Voltar</a>
</div>
<br class="clear">
<div class="img-usuario-page">
	<img src="<?=$img.$data[1]['url_foto']?>" alt="<?=$h1?>" title="<?=$h1?>">
</div>
<form class="row g-3" method="post" action="<?= url("admin/alterar-usuario/".$data[1]['id_usuario']);?>" enctype="multipart/form-data">
	<?php if($data[1]['status_u'] == 1){ ?>
	<div style="border-radius: 5px; border-style: solid; border-color: cyan; border-width: 1px; padding: 10px; margin-top: 27px; margin-bottom: 10px;">
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="status" id="ativo" value="1" checked>
			<label class="form-check-label" for="ativo">
				Ativo
			</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="status" id="inativo" value="2">
			<label class="form-check-label" for="inativo">
				Inativo
			</label>
		</div>
	</div>
	<?php }else{ ?>
	<div style="border-radius: 5px; border-style: solid; border-color: cyan; border-width: 1px; padding: 10px; margin-top: 27px; margin-bottom: 10px;">
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="status" id="ativo" value="1">
			<label class="form-check-label" for="ativo">
				Ativo
			</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="status" id="inativo" value="2" checked>
			<label class="form-check-label" for="inativo">
				Inativo
			</label>
		</div>
	</div>
	<?php } ?>
	<div class="col-md-12">
		<label for="nome" class="form-label">Nome</label>
		<input type="text" class="form-control" id="nome" name="nome" value="<?=$data[1]['nome'] ?>" required disabled>
	</div>
	<div class="col-md-12">
		<label for="email" class="form-label">Email</label>
		<input type="email" class="form-control" id="email" name="email" value="<?=$data[1]['email'] ?>" required disabled>
	</div>
	<?php if($data[1]['tipo_u'] == 'admin'){ ?>
	<div class="col-md-12">
		<label class="form-label">Tipo de Usuário</label>
		<select class="form-select" aria-label="Default select example" name="tipo_u" required>
			<option value="">Selecione</option>
			<option value="admin" selected>Administrador</option>
			<option value="func">Funcionario</option>
		</select>
	</div>
	<?php }else{ ?>
	<div class="col-md-12">
		<label class="form-label">Tipo de Usuário</label>
		<select class="form-select" aria-label="Default select example" name="tipo_u" required>
			<option value="" selected>Selecione</option>
			<option value="admin">Administrador</option>
			<option value="func" selected>Funcionario</option>
		</select>
	</div>
	<?php } ?>
	<div class="col-12">
		<button type="submit" class="btn btn-primary">Alterar</button>
	</div>
</form>
<?include('templates/admin/footer.php')?>