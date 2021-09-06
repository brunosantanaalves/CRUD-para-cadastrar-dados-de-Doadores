<main class="mt-3">
    <h2>Dados do doador</h2>
    <div class="row ml-2 mr-2">
        <div class="col-3 border fw-bold">ID</div>
        <div class="col-9 border"><?= $doador->id; ?></div>
    </div>
    <div class="row ml-2 mr-2">
        <div class="col-3 border fw-bold">Nome</div>
        <div class="col-9 border"><?= $doador->nome; ?></div>
    </div>
    <div class="row ml-2 mr-2">
        <div class="col-3 border fw-bold">Email</div>
        <div class="col-9 border"><?= $doador->email; ?></div>
    </div>
    <div class="row ml-2 mr-2">
        <div class="col-3 border fw-bold">CPF</div>
        <div class="col-9 border"><?= $doador->cpf; ?></div>
    </div>
    <div class="row ml-2 mr-2">
        <div class="col-3 border fw-bold text">Telefone</div>
        <div class="col-9 border"><?= $doador->telefone; ?></div>
    </div>
    <div class="row ml-2 mr-2">
        <div class="col-3 border fw-bold text">Data de Nascimento</div>
        <div class="col-9 border"><?= date('d/m/Y', strtotime($doador->nascimento)); ?></div>
    </div>
    <div class="row ml-2 mr-2">
        <div class="col-3 border fw-bold text">Intervalo de Doações</div>
        <div class="col-9 border"><?= $doador->intervalo; ?></div>
    </div>
    <div class="row ml-2 mr-2">
        <div class="col-3 border fw-bold text">Valor de Doações</div>
        <div class="col-9 border">R$<?= number_format($doador->doacao, 2, ',','.') ?></div>
    </div>
    <div class="row ml-2 mr-2">
        <div class="col-3 border fw-bold text">Forma de Pagamento</div>
        <div class="col-9 border"><?= ($doador->formaPagamento == 1 ?'Cartão de credito' : 'Débito em conta') ?></div>
    </div>
    <div class="row ml-2 mr-2">
        <div class="col-3 border fw-bold text">Data Cadastro</div>
        <div class="col-9 border"><?= date('d/m/Y á\s H:i:s', strtotime($doador->cadastro)) ?></div>
    </div>
    <h3 class="mt-4">Dados de Pagamento</h3>
    <?php if($doador->formaPagamento == 1):?>
        <div class="row ml-2 mr-2">
            <div class="col-3 border fw-bold text">Bandeira</div>
            <div class="col-9 border"><?= $cartao->bandeira ?></div>
        </div>
        <div class="row ml-2 mr-2">
            <div class="col-3 border fw-bold text">Número do Cartão</div>
            <div class="col-9 border"><?= $cartao->numero ?></div>
        </div>
    <?php else: ?>
        <div class="row ml-2 mr-2">
            <div class="col-3 border fw-bold text">Agência</div>
            <div class="col-9 border"><?= $conta->agencia ?></div>
        </div>
        <div class="row ml-2 mr-2">
            <div class="col-3 border fw-bold text">Número da Conta</div>
            <div class="col-9 border"><?= $conta->conta ?></div>
        </div>
    <?php endif; ?>

    <h3 class="mt-4">Dados do Endereço</h3>
    <div class="row ml-2 mr-2">
        <div class="col-3 border fw-bold">CEP</div>
        <div class="col-9 border"><?= $endereco->cep; ?></div>
    </div>
    <div class="row ml-2 mr-2">
        <div class="col-3 border fw-bold">Logradouro</div>
        <div class="col-9 border"><?= $endereco->logradouro; ?></div>
    </div>
    <div class="row ml-2 mr-2">
        <div class="col-3 border fw-bold">Número</div>
        <div class="col-9 border"><?= $endereco->numero; ?></div>
    </div>
    <div class="row ml-2 mr-2">
        <div class="col-3 border fw-bold">Bairro</div>
        <div class="col-9 border"><?= $endereco->bairro; ?></div>
    </div>
    <div class="row ml-2 mr-2">
        <div class="col-3 border fw-bold">Cidade</div>
        <div class="col-9 border"><?= $endereco->cidade; ?></div>
    </div>
    <div class="row ml-2 mr-2">
        <div class="col-3 border fw-bold">Estado</div>
        <div class="col-9 border"><?= $endereco->estado; ?></div>
    </div>

   
   
</main>