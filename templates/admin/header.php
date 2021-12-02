<!Doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link rel="stylesheet" href="<?= url("templates/util/css/styles.css");?>">
    <link rel="stylesheet" href="<?= url("templates/util/css/all.min.css");?>">
    <link rel="stylesheet" href="<?= url("templates/util/css/styles-base.css");?>">
    <script src="<?= url("templates/util/js/sweetalert.js");?>"></script>
    <script src="<?= url("templates/util/js/all.min.js");?>"></script>
    <script src="<?= url("templates/util/js/jquery.js");?>"></script>
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <title><?=$title?></title>
  </head>
  <body>
    <div class="container">
      <!-- Navigation-->
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
        <a class="navbar-brand js-scroll-trigger" href="#">
          <span class="d-block d-lg-none"><?php $_SESSION['nome']; ?></span>
          <span class="d-none d-lg-block">
            <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="<?=$img.$_SESSION['url_foto'];?>" alt="<?php $_SESSION['nome']; ?>" title="<?php $_SESSION['nome']; ?>" />
          </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav">
            <li class="nav-item">
              <h2><?=$_SESSION['nome']; ?></h2>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" title="Geral" href="<?=url('admin');?>">Geral</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" title="Usuarios" href="<?=url('admin/usuarios');?>">Usuarios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" title="Produtos" href="<?=url('admin/produtos');?>">Produtos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" title="Estoque" href="<?=url('admin/estoque');?>">Estoque</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" title="Pedidos" href="<?=url('admin/pedidos')?>">Pedidos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" title="Interests" href="#interests">Interests</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" title="Sair" href="<?=url('auth/logoff');?>">Sair</a>
            </li>
          </ul>
        </div>
      </nav>