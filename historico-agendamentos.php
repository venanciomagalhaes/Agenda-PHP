<?php

require_once "classes/Conexao.php";
require_once "classes/ExibirAgendamento.php";
date_default_timezone_set('America/Sao_Paulo');

$exibirAgendamentos = new ExibirAgendamento();
$agendamentos = $exibirAgendamentos->historicoAgendamentos();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lora Agenda | Histórico </title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/533e482dd1.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php require_once 'assets/templates/header.php' ?>

    <section class="todos-agendamentos">


        <table class="tabela-todos">
            <thead>
                <th>Cliente</th>
                <th>Telefone</th>
                <th>Data</th>
                <th>Horário</th>
                <th>Serviço</th>
            </thead>

            <tbody>

                <?php foreach ($agendamentos as $agendamento) {

                    $dataAgendamento = new DateTime($agendamento['Data']);
                ?>

                    <tr>
                        <td><?= $agendamento['Nome'] ?></td>
                        <td style="width:155px"><?= $agendamento['Telefone'] ?></td>
                        <td class=""><?= $dataAgendamento->format('d/m/Y'); ?></td>
                        <td class=""><?= $agendamento['Horario'] ?></td>
                        <td style="text-align: justify ;"><?= nl2br( $agendamento['Servico']) ?></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>

    </section>

</body>

</html>