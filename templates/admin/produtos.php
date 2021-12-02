<?php
$img = "../";
$title = "Produtos";
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
  <div class="card-estoque-mes">
    <a href="<?=url('admin/alterar-produto/'.$value['id_produto'])?>" title="<?=$value['nome_produto']?>">
      <h2><?=$value['nome_produto']?></h2>
      <p class="color-black"><span class="bold">Valor total: </span> <?=$value['valor_total']?></p>
      <p class="color-black"><span class="bold">Ganho Colaborador: </span> <?=$value['ganho_colaborador']?></p>
      <p class="color-black"><span class="bold">Ganho Empresa: </span> <?=$value['ganho_empresa']?></p>
    </a>
    <a href="<?=url('admin/deletar/'.$value['id_produto'])?>" title="Deletar"><i class="far fa-trash-alt"></i></a>
  </div>
	<?php endforeach ?>
</div>
<div class="btn-cadastrar btn-fixo">
  <a href="<?=url('admin/novo-produto');?>" title="Cadastrar novo produto">Cadastrar novo produto</a>
</div>
<?include('templates/admin/footer.php')?>