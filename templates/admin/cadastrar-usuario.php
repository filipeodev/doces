<?php
$img = "../";
$title = "Cadastrar Usuario";
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
<form class="row g-3" method="post" action="<?= url("admin/register");?>" enctype="multipart/form-data">
	<div style="border-radius: 5px; border-style: solid; border-color: var(--base); border-width: 1px; padding: 10px; margin-top: 27px; margin-bottom: 10px;">
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="status" id="ativo" value="A" checked>
			<label class="form-check-label" for="ativo">
				Ativo
			</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="status" id="inativo" value="I">
			<label class="form-check-label" for="inativo">
				Inativo
			</label>
		</div>
	</div>
	<div class="col-md-12">
		<label for="nome" class="form-label">Nome</label>
		<input type="text" class="form-control" id="nome" name="nome" required>
	</div>
	<div class="col-md-12">
		<label for="email" class="form-label">Email</label>
		<input type="email" class="form-control" id="email" name="email" required>
	</div>
	<div class="col-md-12">
		<label for="senha" class="form-label">Senha</label>
		<input type="password" class="form-control" id="senha" name="senha" required>
	</div>
	<div class="col-md-12">
		<label for="tipo_u" class="form-label">Tipo de Usuário</label>
		<select class="form-select" aria-label="Default select example" id="tipo_u" name="tipo_u" required>
			<option value="" selected>Selecione</option>
			<option value="admin">Administrador</option>
			<option value="func">Funcionario</option>
		</select>
	</div>
	<div class="col-md-12">
		<label for="url_foto" class="form-label">Foto</label>
		<input type="file" name="url_foto" id="url_foto">
	</div>
	<div class="col-12">
		<button type="submit" class="btn btn-primary">Cadastrar</button>
	</div>
</form>
<?include('templates/admin/footer.php')?>