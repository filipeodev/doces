<?php
$img = "../";
$title = "Novo pedido";
include('templates/colaborador/header.php');
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
  <a href="<?=url('colaborador/meus-pedidos')?>" title="Voltar"><i class="fas fa-arrow-left"></i> Voltar</a>
</div>
<br class="clear">
<form class="row g-3" method="post" action="<?= url("colaborador/novo-pedido");?>" enctype="multipart/form-data">
  <div class="col-md-12">
    <label for="id-produto">Escolha o produto</label>
    <select class="form-control"  name="id-produto" id="id-produto">
      <?php foreach($data[1] as $key => $value):?>
        <option value="<?=$value['id_produto']?>"><?=$value['nome_produto']?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="col-md-12">
    <label for="quantidade" class="form-label">Quantidade</label>
    <input type="number" class="form-control" id="quantidade" name="quantidade" required>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Confirmar</button>
  </div>
</form>
<?include('templates/colaborador/footer.php')?>