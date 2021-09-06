<main>
    <h2 class="mt-3"><?= TITLE ?></h2>

    <form method="post">

        <div class="form-group mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" value="<?= $doador->nome ?>">
        </div>

        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= $doador->email ?>">
        </div>

        <div class="form-group mb-3">
            <label>CPF</label>
            <input type="text" name="cpf" class="form-control" value="<?= $doador->cpf ?>">
        </div>

        <div class="form-group mb-3">
            <label>Telefone</label>
            <input type="text" name="telefone" class="form-control" value="<?= $doador->telefone ?>">
        </div>

        <div class="form-group mb-3">
            <label>Data Nascimento</label>
            <input type="date" name="nascimento" class="form-control" value="<?= ($doador->nascimento ?  date('Y-m-d', strtotime($doador->nascimento)) : '') ?>">
        </div>

        <div class="form-group mb-3">
            <label>Intervalo de Doações</label>
           <select name="intervalo" class="form-control">
               <option <?= ($doador->intervalo == 'unico' ?'selected': '') ?> value="unico">Único</option>
               <option <?= ($doador->intervalo == 'bimestral' ?'selected': '') ?> value="bimestral">Bimestral</option>
               <option <?= ($doador->intervalo == 'semestral' ?'selected': '') ?> value="semestral">Semestral</option>
               <option <?= ($doador->intervalo == 'anual' ?'selected': '') ?> value="anual">Anual</option>
           </select>
        </div>

        <h4>Dados de Pagamento</h4>

        <div class="form-group mb-3">
            <label>Valor da Doação</label>
            <div class="row align-items-center">
                <div class="col-auto text-right">R$</div><div class="col-11"><input type="text" name="doacao" class="form-control" value="<?= number_format($doador->doacao,2,',','.') ?>"></div>
            </div>
        </div>

        <div class="form-group">
            <label>Forma de Pagamento</label>
            <div>
                <div class="form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="forma" value="1" <?= ($doador->formaPagamento == 1? 'checked': '') ?>> Crédito
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="forma" value="2" <?= ($doador->formaPagamento == 2? 'checked': '') ?>> Débito
                    </label>
                </div>
            </div>
        </div>
        
        <div class="<?= ($doador->formaPagamento == 1 ? '': 'd-none') ?> credito">
            <div class="form-group mb-3">
                <label>Bandeira</label>
                <input type="text" name="bandeira" class="form-control" value="<?= $cartao->bandeira ?>">
            </div>
            <div class="form-group mb-3">
                <label>numero do cartão</label>
                <input type="text" name="numero" class="form-control" value="<?= $cartao->numero ?>">
            </div>
        </div>

        <div class="<?= ($doador->formaPagamento == 2 ? '': 'd-none') ?> debito">
            <div class="form-group mb-3">
                <label>Agência</label>
                <input type="text" name="agencia" class="form-control" value="<?= $conta->agencia ?>">
            </div>
            <div class="form-group mb-3">
                <label>Conta</label>
                <input type="text" name="conta" class="form-control" value="<?= $conta->conta ?>">
            </div>
        </div>

        <h4 class="mt-3">Dados do Endereço</h4>

        <div class="form-group mb-3">
            <label>CEP</label>
            <input type="text" name="cep" class="form-control" value="<?= $endereco->cep ?>">
        </div>
        <div class="form-group mb-3">
            <label>Logradouro</label>
            <input type="text" name="logradouro" class="form-control" value="<?= $endereco->logradouro ?>">
        </div>
        <div class="form-group mb-3">
            <label>Número</label>
            <input type="text" name="numero_endereco" class="form-control" value="<?= $endereco->numero ?>">
        </div>
        <div class="form-group mb-3">
            <label>Bairro</label>
            <input type="text" name="bairro" class="form-control" value="<?= $endereco->bairro ?>">
        </div>
        <div class="form-group mb-3">
            <label>Cidade</label>
            <input type="text" name="cidade" class="form-control" value="<?= $endereco->cidade ?>">
        </div>
        <div class="form-group mb-3">
            <label>Estado</label>
            <input type="text" name="estado" class="form-control" value="<?= $endereco->estado ?>">
        </div>



        <div class="form-group mt-2">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>

    </form>
</main>

<script src="js/formulario.js"></script>