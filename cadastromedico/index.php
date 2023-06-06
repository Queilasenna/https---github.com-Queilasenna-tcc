<?php
session_start();
include_once '../conexao.php';
// $tempo_session = 10; // tempo em segundos
include("../temposessao.php");

if (isset($_SESSION["time"]) and $_SESSION["time"] + $tempo_session < time()) {
  $_SESSION = array();
  if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
  }
  session_unset();
  @session_destroy();

  header('Location: ../login/index.php');
} else {
  /* aqui vai o seu código normal */
  $_SESSION["time"] = time();

?>

  <!DOCTYPE html>
  <html lang="pt-br">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      body {
        margin: 0px;
      }

      h1 {
        text-align: center;
      }


      form {
        margin-left: 15px;
        margin-right: 40px;


      }
    </style>
    <title>Lista de Médicos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <?php include("../templates/menu.php"); ?>

  <body>
    <main class="container-fluid">

      <!-- Modal INICIO -->
      <div class="modal fade" id="<?php echo $medico['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Exclusão</h5>
            </div>
            <div class="modal-body">Deseja realmente excluir o registro?</div>
            <div class="modal-footer">
              <form class="m-0 ms-1" action="excluir_medico.php" method="POST">
                <button type="submit" class="btn btn-danger" value="">Deletar</button>
              </form>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal" id="<?php echo $seuid; ?>">
        qualquer coisa
      </div>

      <!-- Modal FIM-->

      <!-- FINAL DO MENU AZUL -->
      <br>
      <h1>Lista de Médicos</h1><br>

      <table class="table table-stripped">

        <th>#</th>
        <th>Nome</th>
        <th>CPF</th>
        <th>Telefone</th>
        <th>Ações</th>
        </tr>

        <?php
        $sql = "SELECT * FROM medicos"; // Cria a sql
        $resultado = $pdo->query($sql); // Executa no banco
        $medicos = $resultado->fetchAll(); // Pega os resultados

        foreach ($medicos as $medico) { ?>
          <tr>
            <td><?= $medico['id'] ?></td>
            <td><?= $medico['nome'] ?></td>
            <td><?= $medico['cpf'] ?></td>
            <td><?= $medico['telefone'] ?></td>
            <td class="d-flex flex-row">
              <form class="m-0" action="alterar_medico.php" method="POST">
                <button type="submit" class="btn btn-primary" name="id" id="id" value="<?= $medico['id'] ?>">Editar</button>
              </form>

              <!-- <form class="m-0 ms-1" action="excluir_medico.php" method="POST">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" name="id" id="id" value="<?= $medico['id'] ?>">Excluir</button>
                -->
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-id="<?php echo $medico['id']; ?>" data-nome="<?php echo $medico['id']; ?>" name="id" id="id" value="<?= $medico['id'] ?>">Excluir</button>

              <!-- </form> -->
            </td>
          </tr>
        <?php } ?>
      </table>
    </main>


    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>

  </html>

<?php
}
?>