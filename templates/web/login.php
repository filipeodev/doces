<?php
$title = 'Login';
include("templates/web/header.php");
if($data[0] != ''){
  echo "<script>
    swal({
      title: '".$data[0] ."',
      icon: 'error',
    });
  </script>";
}
?>

<form class="row g-3" method="post" action="<?= url("auth/logon");?>" enctype="multipart/form-data">
  <div class="col-md-12">
    <label for="email" class="form-label">Email ou Usuáio</label>
    <input type="text" class="form-control" id="email" name="email">
  </div>
  <div class="col-md-12">
    <label for="senha" class="form-label">Senha</label>
    <input type="password" class="form-control" id="senha" name="senha">
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Sign in</button>
    <a href="<?= url("login/cadastre-se")?>" class="btn btn-secondary" title="Cadastre-se">Cadastre-se</a>
  </div>
</form>
<?include('templates/web/footer.php')?>