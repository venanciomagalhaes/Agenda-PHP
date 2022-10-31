<?php

require "classes/Conexao.php";
require "classes/CriarAgendamento.php";
date_default_timezone_set('America/Sao_Paulo');

$dataAtual = new DateTime();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome-cliente'];
    $telefone = $_POST['telefone'];
    $data = $_POST['data'];
    $horario = $_POST['horario'];
    $servico = $_POST['servico'];

    $criarAgendamento = new CriarAgendamento();
    $criarAgendamento->cadastrar($nome, $telefone, $data, $horario, $servico);

    header('Location: criar-agendamento.php?agendamento=true');
}


if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['agendamento'])) {

    $avisoCadastro = '<div class="sucesso">Agendamento realizado com sucesso! </div>';
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lora Agenda | Criar </title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php require_once 'assets/templates/header.php' ?>

    <main>
        <section class="criar-agendamento">
            <form id="cadastrar-agendamento" action="criar-agendamento.php" method="post">
                <fieldset>

                    <legend>Cadastrar Agendamento</legend>

                    <?= isset($avisoCadastro) ? $avisoCadastro : '' ?>

                    <label for="nome-cliente">Nome </label>
                    <input type="text" name="nome-cliente" id="nome-cliente" placeholder="Nome da Cliente">
                   
                    <label for="telefone">Telefone </label>
                    <input class="phone" type="tel" name="telefone" id="telefone">
                    


                    <label for="data">Data</label>
                    <input type="date" min="<?= $dataAtual->format('Y-m-d') ?>" name="data" id="data">
                   
                    <label for="horario">Horário</label>
                    <input type="time" name="horario" id="horario">
                    

                    <label for="servico">Serviço</label>
                    <textarea name="servico" id="servico" cols="" rows=""></textarea>
                   
                    <input type="submit" value="Agendar">
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