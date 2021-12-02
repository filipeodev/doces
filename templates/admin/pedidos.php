<?php
$img = "../";
$title = "Pedidos";
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
  
</div>
<div class="popup_status_pedido"></div>
<script>
  $(document).ready(function(){
    function retornaPedidos(){
      let cards = $('.all-cards');
      $.ajax({
      url: 'retorna-pedidos',
      type: "GET",
      dataType: "json",
      beforeSend: function(){
      },
      success: function(callback){

        if(callback.dados){
          let qtdDados = callback.dados;
          let dataCallback = [];
          for(let i = 0; i < qtdDados.length; i++){
            let statusPedido = getStatusPedido(callback.dados[i].status_pedido);
            dataCallback.push(`
            <div class="card-estoque-mes text-left card-pedido">
              <p><span class="bold">Numero do pedido: </span> <span class="id_pedido">${callback.dados[i].id_pedido}</span></p>
              <p>
                <span class="bold">Status pedido: </span>
                <span class="status-pedido color-status-${statusPedido[0]}">${statusPedido[1]}</span>
              </p>
              <p><span class="bold">Quantidade solicitada: </span>${callback.dados[i].qtd_item}</p>
              <p><span class="bold">Feito por: </span>${callback.dados[i].nome}</p>
            </div>`);
          }
          if(dataCallback.length === 0){
            dataCallback.push('<p>Sem pedidos</p>')
          }
          cards.html(dataCallback.reduce((previousValue, currentValue) => previousValue + currentValue));

          $(".card-pedido").click(function() {
            //retornando id do pedido para recuperar fazer uma requisição get e post
            let cardPedido = $(this).html();
            let tagIdPedido = $(cardPedido+" .id_pedido");
            let getIdPedido = $(tagIdPedido[0].childNodes[2]).text();
            let content_status_pedido = `<div class="card-popup-status-pedido">
                                          <a href="#" title="Cancelar" id="cancelar-popup"><i class="fas fa-times"></i></a>
                                          <div class="popup-status-pedido">
                                            <form method="post" id="form-alterar-status-pedido" action="alterar-status-pedido/${getIdPedido}">
                                              <label for="email">Alterar status</label>
                                              <select class="form-control"  name="status_pedido" id="status_pedido">
                                              </select>
                                              <input type="hidden" value="${getIdPedido}" name="id_pedido" id="id_pedido"/>
                                              <input type="submit" value="Alterar" name="alterar-status-pedido" id="alterar-status-pedido" class="btn btn-primary" />
                                            </form>
                                          </div>
                                        </div>`;
            let popup_status_pedido = $('.popup_status_pedido');
            popup_status_pedido.html(content_status_pedido);
            function retornaPedidoId(){
              $.ajax({
                url: `retorna-pedido/${getIdPedido}`,
                type: 'GET',
                dataType: 'json',
                beforeSend: function(){},
                success: function(callback){
                  if(callback.data){
                    let select = $('#status_pedido');
                    let selected = selecionado(callback.data);
                    select.html(selected)
                  }
                },
                complete: function(){}
              });
            }
            retornaPedidoId();
            let popup = $('.card-popup-status-pedido');
            popup.fadeIn();
            let close = $('#cancelar-popup');
            close.click(function(){
              popup.fadeOut();
            });
            function selecionado(data){
              if(data === '1'){
                return `<option value="1" selected>Aguardando</option>
                        <option value="2" >Visualizado</option>
                        <option value="3" >Finalizado</option>`;
              }else if(data === '2'){
                return `<option value="1" >Aguardando</option>
                        <option value="2" selected>Visualizado</option>
                        <option value="3" >Finalizado</option>`;
              }else if(data === '3'){
                return `<option value="1" >Aguardando</option>
                        <option value="2" >Visualizado</option>
                        <option value="3" selected>Finalizado</option>`;
              }
            }
          });

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
    retornaPedidos();

    setInterval(function(){
      retornaPedidos();
    }, 5000);


    $(function(){
      $(document).on('submit', 'form#form-alterar-status-pedido', function(e){
        const form = $(this);
        $.ajax({
          url: form.attr('action'),
          data: form.serialize(),
          type: "POST",
          dataType: "json",
          beforeSend: function(){},
          success: function(callback){
            if(callback.dados){
              console.log(callback.dados);
              if(callback.dados === 1){
                swal({
                  title: 'Status alterado com sucesso.',
                  icon: 'success',
                });
              }else if(callback.dados === 0){
                swal({
                  title: 'Erro ao alterar status.',
                  icon: 'error',
                });
              }
              $('.card-popup-status-pedido').fadeOut();
            }
          },
          complete: function(){}
        });
        e.preventDefault();
      });
      $(document).on('submit', '#alterar-status-pedido', function(e){
        e.preventDefault();
      });
    });
  });
</script>
<?include('templates/admin/footer.php')?>

