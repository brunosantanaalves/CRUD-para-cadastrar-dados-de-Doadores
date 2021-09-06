<?php

require __DIR__.'/vendor/autoload.php';

// chama a classe doador
use \App\Entity\Doador;

// busca doadores no banco de dador
$doadores = Doador::getDoadores();

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/listagem.php';
include __DIR__.'/includes/footer.php';