<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE', 'Editar Doador');

// chama as classes 
use \App\Entity\Doador;
use \App\Entity\Cartao;
use \App\Entity\Conta;
use \App\Entity\Endereco;


if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location:index.php?status=error');
    exit;
}

//busca o doador pelo id
$doador = Doador::getDoador($_GET['id']);

//valida e busca forma de pagamento
if($doador->formaPagamento == 1){
    $cartao = Cartao::getCartao($doador->id);
    if(!$cartao instanceof cartao){
        $cartao = new Cartao;
    }
} else {
    $conta = Conta::getConta($doador->id);   
    if(!$conta instanceof conta){
        $conta = new Conta;
    }     
}

// busca endereco do doador
$endereco = Endereco::getEndereco($doador->id);

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/doador-completo.php';
include __DIR__.'/includes/footer.php'; 
