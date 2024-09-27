<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Novo pedido</title>
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="./assets/css/styles.css">
  <link rel="stylesheet" href="./assets/css/novo_pedido.css">
  <link rel="stylesheet" href="https://use.typekit.net/tvf0cut.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<?php
    session_start(); // Inicia a sessão

    // Verifica se o usuário está logado
    if (!isset($_SESSION['usuario'])) {
      header("Location: login.php"); // Redireciona para a página de login se não estiver logado
      exit();
    }
    
  ?>


<body>
  <header>
    <?php
        require_once 'header.php';
    ?>
  </header>
  <section class="page-novo-pedido paddingBottom50">
    <div class="container">
      <div>
        <a href="dashboard.php" class="link-voltar">
          <img src="assets/images/arrow.svg" alt="">
          <span>Novo pedido</span>
        </a>
      </div>
      <div class="maxW340">
        <label class="input-label">Cliente</label>
        <input type="text" class="input" name="cliente">
      </div>
      <div class="shadow-table">
      <table id="tabelaProdutos">
    <thead>
      <tr>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Valor parcial</th>
        <th></th>
      </tr>
    </thead>
    <tbody id="produtosTableBody">
      <tr>
        <td>
          <input type="text" class="input produto" name="produto" autocomplete="off">
          <div class="dropdown-suggestions" style="position: relative;">
            <ul class="suggestions-list" style="position: absolute; background: white; border: 1px solid #ccc; width: 100%; display: none;"></ul>
          </div>
        </td>
        <td><input type="number" class="input quantidade" name="quantidade"></td>
        <td><input type="text" class="input valorParcial" name="valorParcial" disabled></td>
        <td><a href="#" class="bt-remover"><img src="assets/images/remover.svg" alt="Remover" /></a></td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4">
          <div class="row justify-content-between align-items-center">
            <div class="col">
              <a href="#" id="addProductBtn" class="bt-add-produto">
                <span>Adicionar produto</span>
                <img src="assets/images/adicionar.svg" alt="Adicionar Produto" />
              </a>
            </div>
            <div class="blc-subtotal d-flex">
              <div class="d-flex align-items-center">
                <span>Subtotal</span>
                <input type="text" class="input" disabled id="subtotal" value="0,00" />
              </div>
              <div class="d-flex align-items-center">
                <span>Desconto</span>
                <input type="text" class="input" id="desconto" value="0,00" />
              </div>
              <div class="d-flex align-items-center">
                <span>Total</span>
                <input type="text" class="input" disabled id="total" value="0,00" />
              </div>
            </div>
          </div>
        </td>
      </tr>
    </tfoot>
  </table>
      </div>
      <div class="maxW340">
        <label class="input-label">Observação</label>
        <input type="text" class="input" name="observacao">
      </div>
      <div class="maxW340">
        <button type="button" id="salvarPedidoBtn" class="button-default">Salvar</button>
      </div>
    </div>
  </section>

  <script>
    $(document).ready(function() {
    let subtotal = 0;

    // Adicionar nova linha ao clicar em "Adicionar produto"
    $('#addProductBtn').click(function(e) {
        e.preventDefault();
        $('#produtosTableBody').append(`
          <tr>
            <td>
              <input type="text" class="input produto" name="produto" autocomplete="off">
              <div class="dropdown-suggestions" style="position: relative;">
                <ul class="suggestions-list" style="position: absolute; background: white; border: 1px solid #ccc; width: 100%; display: none;"></ul>
              </div>
            </td>
            <td><input type="number" class="input quantidade" name="quantidade"></td>
            <td><input type="text" class="input valorParcial" name="valorParcial" disabled></td>
            <td><a href="#" class="bt-remover"><img src="assets/images/remover.svg" alt="Remover" /></a></td>
          </tr>
        `);
    });

    // Remover produto da lista
    $(document).on('click', '.bt-remover', function(e) {
        e.preventDefault();
        $(this).closest('tr').remove();
        calcularSubtotal();
    });

    // Buscar produto ao digitar o nome
    $(document).on('input', '.produto', function() {
        let input = $(this);
        let produtoNome = input.val();
        let dropdown = input.siblings('.dropdown-suggestions').find('.suggestions-list');

        if (produtoNome.length >= 2) {
            $.ajax({
                url: 'class/buscar_produto.php',
                type: 'GET',
                data: { nome: produtoNome },
                success: function(response) {
                    let produtos = JSON.parse(response);
                    dropdown.empty();
                    if (produtos.length > 0) {
                        produtos.forEach(function(produto) {
                            dropdown.append('<li class="suggestion-item" data-valor="'+produto.valor+'" data-nome="'+produto.nome+'">'+produto.nome+'</li>');
                        });
                        dropdown.show();
                    } else {
                        dropdown.hide();
                    }
                }
            });
        } else {
            dropdown.hide();
        }
    });

    // Selecionar o produto da lista de sugestões
    $(document).on('click', '.suggestion-item', function() {
        let item = $(this);
        let nomeProduto = item.data('nome');
        let valorProduto = item.data('valor');
        let input = item.closest('td').find('input.produto');

        // Definir o nome completo e o preço
        input.val(nomeProduto);
        input.data('valor', valorProduto);

        // Esconder o dropdown após a seleção
        item.closest('.suggestions-list').hide();
    });

    // Calcular valor parcial ao mudar quantidade
    $(document).on('input', '.quantidade', function() {
        let quantidade = $(this).val();
        let valor = $(this).closest('tr').find('.produto').data('valor');
        
        if (quantidade && valor) {
            let valorParcial = quantidade * valor;
            $(this).closest('tr').find('.valorParcial').val(valorParcial.toFixed(2));
            calcularSubtotal();
        }
    });

    // Calcular subtotal
    function calcularSubtotal() {
        subtotal = 0;
        $('.valorParcial').each(function() {
            let valor = parseFloat($(this).val());
            if (!isNaN(valor)) {
                subtotal += valor;
            }
        });
        $('#subtotal').val(subtotal.toFixed(2));
        calcularTotal();
    }

    // Calcular total
    function calcularTotal() {
        let desconto = parseFloat($('#desconto').val());
        if (isNaN(desconto)) desconto = 0;
        let total = subtotal - desconto;
        $('#total').val(total.toFixed(2));
    }

    // Recalcular total ao alterar o desconto
    $('#desconto').on('input', function() {
        calcularTotal();
    });
});




// apos clicar no botao salvar faz essas funcoes 






$(document).on('click', '#salvarPedidoBtn', function() {
    // Coletar dados do cliente e observação
    let cliente = $('input[name="cliente"]').val();
    let observacao = $('input[name="observacao"]').val();

    // Coletar produtos e quantidades
    let produtos = [];
    $('#produtosTableBody tr').each(function() {
        let produtoNome = $(this).find('input.produto').val();
        let quantidade = $(this).find('input.quantidade').val();
        let valor = $(this).find('input.produto').data('valor'); // Preço do produto

        if (produtoNome && quantidade) {
            produtos.push({
                nome: produtoNome,
                quantidade: quantidade,
                valor: valor
            });
        }
    });

    // Enviar os dados via AJAX
    $.ajax({
        url: 'class/salvar_pedido.php',
        method: 'POST',
        data: {
            cliente: cliente,
            observacao: observacao,
            produtos: produtos
        },
        success: function(response) {
            alert('Pedido salvo com sucesso!');
             window.location.href = 'dashboard.php'; // Redirecionar após salvar
        },
        error: function(err) {
            alert('Erro ao salvar o pedido.');
            console.log(err);
        }
    });
});


  </script>

</body>
</html>