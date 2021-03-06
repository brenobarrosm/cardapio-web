<?php 
use App\Model\Cardapio;
use App\Model\Produto;

require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../includes/cabecalho.php';
require_once __DIR__.'/../includes/menu_navegacao.php'; 

$cardapio = new Cardapio();

if(isset($_SESSION['cardapio'])) {
  $cardapio = unserialize($_SESSION['cardapio']);
}

$btnCadastrarProduto = '';
if(isset($_SESSION['logado'])) {
  $logado = $_SESSION['logado'];
  $btnCadastrarProduto = '<a href="/public/pages/produto/form.php" class="btn btn-primary" style="margin:1rem;">Cadastrar Produto</a>';
}


?>

<main class="container">
<?= $btnCadastrarProduto ?>

<table class="table table-bordered" style="margin-top:2.5rem;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Preco</th>
      <?= isset($logado) ? '<th scope="col">Ações</th>':"" ?>
    </tr>
  </thead>
  <tbody>
  <?php foreach($cardapio->getProdutos() as $id => $produto){ ?>
    <tr>
      <th scope="row"><?= $id ?></th>
      <td><?=$produto->getNome()?> <small>(<?= $produto->getDescricao() ?>)</small></td>
      <td><?= $produto->getPrecoFormatado() ?></td>
      <?= isset($logado) ? '<td>'. 
                          '<a href="/public/pages/admin/form_editar.php?id='.$id.'" style="text-decoration:none; cursor:pointer; color:blue;">Editar</a>'.
                          ', '.
                          '<a href="/public/pages/produto/deletar.php?id='.$id.'" style="text-decoration:none; cursor:pointer; color:blue;">Remover</a> '. 
                          '</td>':"" ?>
    </tr>
  <?php } ?>
  </tbody>
</table>
</main>

<?php require_once __DIR__.'/../includes/rodape.php'; ?>