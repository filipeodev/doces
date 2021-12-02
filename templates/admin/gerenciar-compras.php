<?php
$img = "../../";
$title = "Gerenciar Compras";
include('templates/admin/header.php');
if($data[0] != ''){
  echo "<script>
    swal({
      title: '".$data[0] ."',
      icon: 'success',
    });
  </script>";
}
?>
<h1><?=$title?></h1>
<div class="voltar-pagina">
	<a href="<?=url('admin/estoque')?>" title="Voltar"><i class="fas fa-arrow-left"></i> Voltar</a>
</div>
<div class="all-cards">
	<?php foreach ($data[2] as $key => $value): ?>
	<div class="card-estoque-mes card-estoque">
		<a href="<?=url('admin/cadastrar-itens/'.$value['id_mes_estoque'].'/'.$value['id_compra'])?>" title="Compra">
			<h2>Data: <span><?=tranfData($value['data_com'])?></span></h2>
		</a>
		<a href="<?=url('admin/deletar-compra/'.$value['id_mes_estoque'].'/'.$value['id_compra'])?>" title="Deletar">
			<i class="far fa-trash-alt"></i>
		</a>
	</div>
	<?php endforeach ?>
</div>
<div class="btn-cadastrar btn-fixo">
	<form class="row g-3" method="post" action="<?= url("admin/criar-compra");?>" enctype="multipart/form-data">
		<div class="col-md-12">
			<input type="hidden" class="form-control" id="id_mes" name="id_mes" value="<?=$data[1]?>" required>
		</div>
		<div class="col-12">
			<button type="submit" class="btn btn-primary">Criar compra</button>
		</div>
	</form>
</div>
<?include('templates/admin/footer.php')?>