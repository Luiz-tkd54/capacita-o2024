<div class="container">
      <a href="dashboard.php" class="logo">
        <img src="assets/images/ho.svg" alt="" />
      </a>
      <div class="blc-user">
        <img src="assets/images/icon-feather-user.svg" alt="" />
        <span>
          Olá, <br />
          <!-- exibe o nome cadastrado no banco de dados -->
          <?php echo htmlspecialchars($_SESSION['usuario']); ?>
        </span>
        <img src="assets/images/arrow-down.svg" alt="" />
        <div class="menu-drop">
          <a href="geren-cliente.php">Gerenciar clientes</a>
          <a href="geren-produtos.php">Gerenciar produtos</a>
          <a href="geren-usuario.php">Gerenciar usuarios</a>
          <a href="cliente.php">Cadastrar cliente</a>
          <a href="cad-produto.php">Cadastrar produto</a>
          <a href="usuario.php">Cadastrar usuário</a>
          <a href="pedidos.php">Novo pedido</a>
          <a href="logout.php">Sair da conta</a>
        </div>
      </div>

</div>