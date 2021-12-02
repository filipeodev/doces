<?php
$img = "../";
$title = "Meus Pedidos";
include('templates/colaborador/header.php');
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
  
</div>
<div class="btn-cadastrar btn-fixo">
  <a href="<?=url('colaborador/novo-pedido');?>" title="Cadastrar novo pedido">Cadastrar novo pedido</a>
</div>
<script>
  $(document).ready(function(){
    function retornaPedidos(){
      let cards = $('.all-cards');
      $.ajax({
      url: 'retorna-pedidos',
      type: "GET",
      dataType: "json",
      beforeSend: function (){
      },
      success: function(callback){

        if(callback.dados){
          let qtdDados = callback.dados;
          let dataCallback = [];
          for(let i = 0; i < qtdDados.length; i++){
            let statusPedido = getStatusPedido(callback.dados[i].status_pedido);
            dataCallback.push(`
              <div class="card-estoque-mes text-left card-pedido">
                <p><span class="bold">Numero do pedido: </span>${callback.dados[i].id_pedido}</p>
                <p>
                  <span class="bold">Status pedido: </span>
                  <span class="status-pedido color-status-${statusPedido[0]}">${statusPedido[1]}</span>
                </p>
                <p><span class="bold">Quantidade solicitada: </span>${callback.dados[i].qtd_item}</p>
                <p><span class="bold">Feito por: </span>${callback.dados[i].nome}</p>
              </div>`
            );
          }
          cards.html(dataCallback.reduce((previousValue, currentValue) => previousValue + currentValue));
          console.log(callback.dados);
        }
      },
      complete: function(){
      }
    });
    }
    function getStatusPedido(data){
      if(data === "1"){
        return ['aguardando', 'Aguardando'];
      }else if(data === "2"){
        return ['visualizado', 'Visualizado'];
      }else if(data === "3"){
        return ['finalizado', 'Finalizado'];
      }
    }
    retornaPedidos()
    setInterval(function(){
      retornaPedidos()
    }, 10000);
  });
</script>
<?include('templates/colaborador/footer.php')?>