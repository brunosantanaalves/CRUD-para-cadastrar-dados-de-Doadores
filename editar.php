<?php

require __DIR__.'/vendor/autoload.php';

//define titulo da pagina
define('TITLE', 'Editar Doador');

//instancia as classes na pagina
use \App\Entity\Doador;
use \App\Entity\Cartao;
use \App\Entity\Conta;
use \App\Entity\Endereco;

//cria obj vazio 
$conta = new Conta;
$cartao = new Cartao;

if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location:index.php?status=error');
    exit;
}



//busca o doador pelo id
$doador = Doador::getDoador($_GET['id']);

//valida se o doador existe
if(!$doador instanceof Doador){
    header('location:index.php?status=error');
    exit;
}

//busca endereco do doador
$endereco = Endereco::getEndereco($doador->id);

//atualiza com envio do formulario
if(isset($_POST['nome'], $_POST['email'], $_POST['cpf'], $_POST['telefone'], $_POST['nascimento'],
         $_POST['intervalo'], $_POST['doacao'], $_POST['forma'],  
         $_POST['bandeira'],$_POST['numero'], $_POST['agencia'], $_POST['conta'])){

            $doador->nome = $_POST['nome'];
            $doador->email = $_POST['email'];
            $doador->cpf =  str_replace(['.',',','-'],'', $_POST['cpf']);
            $doador->telefone = str_replace(['(',')','-'],'', $_POST['telefone']);
            $doador->nascimento = $_POST['nascimento'];
            $doador->intervalo = $_POST['intervalo'];
            $doador->doacao = str_replace(',','.', str_replace('.','', $_POST['doacao']));
            $doador->formaPagamento = $_POST['forma'];
            $doador->atualizar();

            // se o pagamento for credito
            if($doador->formaPagamento == 1){
                
                $cartao = Cartao::getCartao($doador->id);
                if(!$cartao instanceof cartao){
                    $cartao = new Cartao;
                    $cartao->bandeira = $_POST['bandeira'];
                    $numeroCartao = str_replace([' ','.','-',','],'', $_POST['numero']);
                    $numeroCartao = substr($numeroCartao,0,6) . '******' . substr($numeroCartao,-4);
                    $cartao->numero = $numeroCartao;
                    $cartao->doador = $doador->id;
                    $cartao->cadastrar();
                    $conta = Conta::getConta($doador->id);
                    $conta->excluir();
                } else {
                    $cartao->bandeira = $_POST['bandeira'];
                    $numeroCartao = str_replace([' ','.','-',','],'', $_POST['numero']);
                    $numeroCartao = substr($numeroCartao,0,6) . '******' . substr($numeroCartao,-4);
                    $cartao->numero = $numeroCartao;
                    $cartao->doador = $doador->id;
                    $cartao->atualizar();

                }
                
            } else {

                $conta = Conta::getConta($doador->id);   
                if(!$conta instanceof conta){
                    $conta = new Conta;
                    $conta->agencia = $_POST['agencia'];
                    $conta->conta = $_POST['conta'];
                    $conta->doador = $doador->id;
                    $conta->cadastrar();
                    $cartao = Cartao::getCartao($doador->id);
                    $cartao->excluir();
                }   else {
                    $conta->agencia = $_POST['agencia'];
                    $conta->conta = $_POST['conta'];
                    $conta->doador = $doador->id;
                    $conta->atualizar();
                }

            }

            $endereco = Endereco::getEndereco($doador->id);
            $endereco->logradouro = $_POST['logradouro'];
            $endereco->bairro = $_POST['bairro'];
            $endereco->cep = $_POST['cep'];
            $endereco->cidade = $_POST['cidade'];
            $endereco->estado = $_POST['estado'];
            $endereco->numero = $_POST['numero_endereco'];
            $endereco->doador = $doador->id;
            $endereco->atualizar();

    header('location:index.php?status=success');
    exit;

}


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







include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php'; 
