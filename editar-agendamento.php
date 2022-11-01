<?php

require_once "classes/Conexao.php";
require_once "classes/EditarAgendamento.php";
require_once "classes/ExibirAgendamento.php";
date_default_timezone_set('America/Sao_Paulo');


$dataAtual = new DateTime();
$dataAtual = $dataAtual->format('Y-m-d');

if ($_SERVER['REQUEST_METHOD'] == 'GET' and !empty($_GET['id'])) {

    $exibirAgendamentos = new ExibirAgendamento();
    $agendamentos = $exibirAgendamentos->agendamentoIndividual($_GET['id']);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = (int) $_POST['id'];
    $nome = $_POST['nome-cliente'];
    $telefone = $_POST['telefone'];
    $data = $_POST['data'];
    $horario = $_POST['horario'];
    $servico = $_POST['servico'];
    

    $editarAgendamento = new EditarAgendamento();
    $editarAgendamento->editar($id, $nome,  $telefone, $data, $horario, $servico);

    

    header('Location: todos-agendamentos.php?agendamento=true');
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lora Agenda | Editar </title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/533e482dd1.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php require_once 'assets/templates/header.php' ?>



    <main>
        <section class="editar-agendamento">
            <form id="editar-agendamento" action="editar-agendamento.php" method="post">
                <fieldset>

                    <legend>EDITAR Agendamento</legend>

                    <?= isset($avisoEditar) ? $avisoEditar : '' ?>

                    <?php foreach ($agendamentos as $agendamento) { ?>

                        <input type="hidden" name="id" value="<?php echo $agendamento['Id'] ?>">

                        <label for="nome-cliente">Nome </label>
                        <input type="text" name="nome-cliente" id="nome-cliente" placeholder="Nome da Cliente" value="<?php echo $agendamento['Nome'] ?>">

                        <label for="telefone">Telefone </label>
                        <input type="tel" name="telefone" id="telefone" value="<?php echo $agendamento['Telefone'] ?>">

                        <label for="data">Data</label>
                        <input type="date" name="data" min="<?= $dataAtual ?>" id="data" value="<?php echo $agendamento['Data'] ?>">

                        <label for="horario">Horário</label>
                        <input type="time" name="horario" id="horario" value="<?php echo $agendamento['Horario'] ?>">

                        <label for="servico">Serviço</label>
                        <textarea name="servico" id="servico" cols="" rows=""> <?php echo $agendamento['Servico'] ?></textarea>

                    <?php } ?>

                    <input type="submit" value="EDITAR">
                </fieldset>
            </form>
        </section>
    </main>

    <script src="assets/js/jquery-3.6.1.js"></script>
    <script src="assets/js/jquery.validate.js"></script>
    <script src="assets/js/jquery.mask.js"></script>
    <script src="assets/js//personalizado.js"></script>
</body>

</html>