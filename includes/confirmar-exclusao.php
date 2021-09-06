<main>
    <section>
       
    </section>

    <h2 class="mt-3">Excluir Doador</h2>

    <form method="post">
        <p>Você realmente deseja excluir o doador(a) <strong><?= $doador->nome ?></strong>?</p>
    
        <div class="form-group mt-2">
            <a href="index.php">
                <button type="button" class="btn btn-success">Cancelar</button>
            </a>
            <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
        </div>
    </form>
</main>