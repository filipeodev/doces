<?php
$img = "../../../";
$title = "Cadastrar Itens";
include('templates/admin/header.php');
if($data['ms'] != ''){
  echo "<script>
    swal({
      title: '".$data['ms'] ."',
      icon: 'success',
    });
  </script>";
}
if($data['me'] != ''){
  echo "<script>
    swal({
      title: '".$data['me'] ."',
      icon: 'error',
    });
  </script>";
}
?>
<h1><?=$title?></h1>
<div class="voltar-pagina">
	<a href="<?=url('admin/gerenciar-compras/'.$data['id_mes'])?>" title="Voltar"><i class="fas fa-arrow-left"></i> Voltar</a>
</div>
<div class="all-cards">
	<div class="container-cadastrar-item">
		<form class="row g-3" method="post" action="<?= url("admin/criar-item");?>" enctype="multipart/form-data">
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
				<input type="hidden" class="form-control" id="id_mes" name="id_mes" value="<?=$data['id_mes']?>">
			</div>
			<div class="col-md-12">
				<input type="hidden" class="form-control" id="id_compra" name="id_compra" value="<?=$data['id_compra']?>">
			</div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Cadastrar</button>
			</div>
		</form>
	</div>
	<div class="container-item">
		<div class="all-cards">
			<?php foreach ($data['itens'] as $key => $value): ?>
			<div class="card-estoque-mes card-item">
				<h2><span>Item:</span> <?=$value['item']?></h2>
				<p><span>Quantidade:</span>  <?=$value['quantidade']?></p>
				<p><span>Valor Un.:</span>  <?=$value['valor']?></p>
				<p><span>Total:</span>  <?=$value['total']?></p>
				<p><span>Data</span>  <?=tranfData($value['data_com'])?></p>
				<a href="<?=url('admin/deletar-item/'.$data['id_mes'].'/'.$data['id_compra'].'/'.$value['id_item'])?>" title="Deletar"><i class="far fa-trash-alt"></i></a>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</div>

<?include('templates/admin/footer.php')?>