<?php
$img = "../";
$title = "Gerenciar Estoque";
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
<div class="all-cards">
	<?php foreach ($data[1] as $key => $value): ?>
	<a class="card-estoque-mes" href="<?=url('admin/gerenciar-compras/'.$value['id_mes_estoque'])?>" title="<?=$value['mes']?> / <?=$value['ano']?>">
		<h2><?=$value['mes']?> / <?=$value['ano']?></h2>
	</a>
	<?php endforeach ?>
</div>
<div class="btn-cadastrar btn-fixo">
  <a href="<?=url('admin/novo-mes');?>" title="Cadastrar novo mês">Cadastrar novo mês</a>
</div>
<?include('templates/admin/footer.php')?>