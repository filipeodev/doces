<?php
$img = "../";
$title = "Usuarios";
include('templates/admin/header.php');
if($data[0] != ''){
  echo "<script>
    swal({
      title: '".$data[0] ."',
      icon: 'error',
    });
  </script>";
}
if($data[1] != ''){
  echo "<script>
    swal({
      title: '".$data[1] ."',
      icon: 'success',
    });
  </script>";
}
?>
<h1><?=$title?></h1>
<br class="clear">
<div class="scroll-table">
  <table class="table tabela-usuarios">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Imagem</th>
        <th scope="col">Nome</th>
        <th scope="col">E-mail</th>
        <th scope="col">Tipo</th>
        <th scope="col">Status</th>
        <th scope="col">Editar</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data[2] as $key => $value):?>
      <tr>
        <th scope="row" class="img-usuario"><img src="../<?=$value['url_foto']?>" alt="Foto" title="Foto"></th>
        <td><?=$value['id_usuario']?></td>
        <td><?=$value['nome']?></td>
        <td><?=$value['email']?></td>
        <td><?=$value['tipo_u'] == 'admin' ? 'Administrador' : 'Funcionario'?></td>
        <td><?=$value['status_u'] == 1 ? 'Ativo' : 'Inativo'?></td>
        <td><a class="btn btn-primary" href="<?=url("admin/editar-usuario/{$value['id_usuario']}")?>" title="Editar">Editar</a></td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
<div class="btn-cadastrar btn-fixo">
  <a href="<?=url('admin/cadastrar-usuario');?>" title="Cadastrar Usuário">Cadastrar Usuário</a>
</div>
<?include('templates/admin/footer.php')?>