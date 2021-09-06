<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE', 'Cadastrar Doador');

// chama as classes
use \App\Entity\Doador;
use \App\Entity\Cartao;
use \App\Entity\Conta;
use \App\Entity\Endereco;

// istancia as classes utilizada na pagina
$doador = new Doador;
$cartao = new Cartao;
$conta = new Conta;
$endereco = new Endereco;


//validacao do post
if(isset($_POST['nome'], $_POST['email'], $_POST['cpf'], $_POST['telefone'], $_POST['nascimento'],
         $_POST['intervalo'], $_POST['doacao'], $_POST['forma'],  $_POST['estado'],
         $_POST['bandeira'],$_POST['numero'], $_POST['agencia'], $_POST['conta'],
         $_POST['logradouro'], $_POST['bairro'], $_POST['cep'], $_POST['cidade'],$_POST['numero_endereco']
        )){

    // salva dados do doador
    $doador->nome = $_POST['nome'];
    $doador->email = $_POST['email'];
    $doador->cpf =  str_replace(['.',',','-'],'', $_POST['cpf']);
    $doador->telefone = str_replace(['(',')','-'],'', $_POST['telefone']);
    $doador->nascimento = $_POST['nascimento'];
    $doador->intervalo = $_POST['intervalo'];
    $doador->doacao = str_replace(['.',','],[',','.'], $_POST['doacao']);
    $doador->formaPagamento = $_POST['forma'];
    $doador->cadastrar();

    // verifica e salva dados de pagamento 
    if($doador->formaPagamento == 1){
        $cartao->bandeira = $_POST['bandeira'];
        $numeroCartao = str_replace([' ','.','-',','],'', $_POST['numero']);
        $numeroCartao = substr($numeroCartao,0,6) . '******' . substr($numeroCartao,-4);
        $cartao->numero = $numeroCartao;
        $cartao->doador = $doador->id;
        $cartao->cadastrar();
    } else {
        $conta->agencia = $_POST['agencia'];
        $conta->conta = $_POST['conta'];
        $conta->doador = $doador->id;
        $conta->cadastrar();

    }

    // salva endereco
    $endereco = new Endereco();
    $endereco->logradouro = $_POST['logradouro'];
    $endereco->bairro = $_POST['bairro'];
    $endereco->cep = $_POST['cep'];
    $endereco->cidade = $_POST['cidade'];
    $endereco->estado = $_POST['estado'];
    $endereco->numero = $_POST['numero_endereco'];
    $endereco->doador = $doador->id;
    $endereco->cadastrar();
        

    header('location:index.php?status=success');
    exit;

}


include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';