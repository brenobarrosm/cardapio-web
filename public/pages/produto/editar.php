<?php

    use App\Model\Cardapio;
    use App\Model\Produto;

    require_once __DIR__.'/../../../vendor/autoload.php';

    session_start();

    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
    $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_FLOAT);

    $produto = new Produto($nome, $descricao, $preco);

    $cardapio = new Cardapio();

    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    //se ja existe um cardapio na sessao
    if(isset($_SESSION['cardapio'])) {
        $cardapio = unserialize($_SESSION['cardapio']);
    }
    
    if(isset($_SESSION['cardapio']) and isset($id))
    {
        $cardapio = unserialize($_SESSION['cardapio']);

        $cardapio->atualizarProduto($id, $produto);

        $_SESSION['cardapio'] = serialize($cardapio);
    }

    $_SESSION['cardapio'] = serialize($cardapio);

    header('Location: /public/pages/');
    die();