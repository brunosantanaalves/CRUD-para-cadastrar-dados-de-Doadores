<?php

require __DIR__.'/vendor/autoload.php';

//instancia as classes na pagina
use \App\Entity\Doador;
use \App\Entity\Cartao;
use \App\Entity\Conta;

//caso não exista um GET['id'] retorna pra home
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location:index.php?status=error');
    exit;
}

$doador = Doador::getDoador($_GET['id']);

//validacao da Doador
if(!$doador instanceof Doador){
    header('location:index.php?status=error');
    exit;
}

//validacao do post
if(isset($_POST['excluir'])){

    if($doador->formaPagamento == 1){
        $cartao = Cartao::getCartao($doador->id);
        $cartao->excluir();
    } else {
        $conta = Conta::getConta($doador->id);
        $conta->excluir();
    }

    $doador->excluir();

    header('location:index.php?status=success');
    exit;

}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/confirmar-exclusao.php';
include __DIR__.'/includes/footer.php';
