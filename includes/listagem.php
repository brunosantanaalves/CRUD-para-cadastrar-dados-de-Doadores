<?php
  $status = '';

  if(isset($_GET['status'])){
      switch ($_GET['status']) {
          case 'success':
              $status = '<div class="mt-2 alert alert-success">Ação executada com sucesso!</div>';
              break;
          case 'error':
              $status = '<div class="mt-2 alert alert-danger">Houve um erro ao executar a ação, tente novamente!</div>';
              break;
          
      }
  }  

  $resultados = '';
  foreach ($doadores as $doador) {
      $resultados .= '<tr>
                          <td>'.$doador->id.'</td>
                          <td>'.$doador->nome.'</td>
                          <td>'.$doador->email.'</td>
                          <td>R$'.number_format($doador->doacao, 2, ',', '.').'</td>
                          <td>'.$doador->intervalo.'</td>
                          <td>
                              <a href="editar.php?id='.$doador->id.'">
                                  <button type="button" class="btn btn-primary">Editar</button>
                              </a>
                              <a href="excluir.php?id='.$doador->id.'">
                                  <button type="button" class="btn btn-danger">excluir</button>
                              </a>
                              <a href="ver.php?id='.$doador->id.'">
                                  <button type="button" class="btn btn-success">ver</button>
                              </a>
                          </td>
                      </tr>';

  }

  $resultados = strlen($resultados) ? $resultados : '<tr>
                                                          <td colspan="6" class="text-center">
                                                              Nenhuma Doador Encontrado
                                                          </td>
                                                      </tr>';

?>

<main>
<section>
        <?= $status ?>
        <table class="table bg-light">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>email</th>
                    <th>Doação</th>
                    <th>Intervalo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?= $resultados ?>
            </tbody>
        </table>
    </section>

</main>

