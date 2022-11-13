<?php

require_once "classes/Conexao.php";
require_once "classes/ExibirAgendamento.php";
date_default_timezone_set('America/Sao_Paulo');

$exibirAgendamentos = new ExibirAgendamento();
$agendamentos = $exibirAgendamentos->agendamentosHoje();
$agendamentoSemana = $exibirAgendamentos->agendamentoSemana();

$dataAmanha = new DateTime('tomorrow');
$dataAmanha = $dataAmanha->format('d/m');
$dataLimite = date("d/m", time() + (7 * 86400));

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lora Agenda | Home </title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/533e482dd1.js" crossorigin="anonymous"></script>
</head>

<body>

    

    <?php
    require "assets/templates/header.php";
    if (!empty($agendamentos)) { ?>

        <section class="agendamento-hoje">
            <p>AGENDAMENTOS DE HOJE <i style="margin-left: 10px; font-size: 20px; vertical-align: middle" class="fa-solid fa-triangle-exclamation"></i></p>
            <table>

                <thead>
                    <th>Cliente</th>
                    <th>Telefone</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Serviço</th>
                    <th>atendido / faltou ?</th>
                </thead>

                <tbody>


                    <?php
                    foreach ($agendamentos as $agendamento) {
                    
                        $dataAtual = new DateTime($agendamento['Data'] );
                        $dataAtual = $dataAtual->format('d/m/Y');
                    ?>

                        <tr>
                            <td><?= $agendamento['Nome'] ?></td>
                            <td style="width:155px"><?= $agendamento['Telefone'] ?></td>
                            <td class="horario-hoje"><?= $dataAtual ?></td>
                            <td class="horario-hoje"><?=  $agendamento['Horario']?></td>
                            <td style="text-align: justify ;"><?= nl2br( $agendamento['Servico']) ?></td>
                            <td><a href="excluir-agendamento.php?id=<?= $agendamento['Id'] ?>"><i style="color: red; font-size: 20px; cursor: pointer" class="fa-solid fa-trash-can"></i></a>
                        </tr>

                <?php }
                } ?>
                </tbody>
            </table>
        </section>


        <?php if (empty($agendamentos)) { ?>
            <section class="sem-agendamento">
                Você não possui agendamentos para Hoje

            </section>
        <?php  }
        if (!empty($agendamentoSemana)) { ?>

            <section class="agendamento-semana">
                <p>PRÓXIMOS AGENDAMENTOS <span style="display: block; margin-top: 10px;"><?= "($dataAmanha -  $dataLimite)" ?></span> </p>
                <table>

                    <thead>
                        <th>Cliente</th>
                        <th>Telefone</th>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Serviço</th>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($agendamentoSemana as $agendamento) {
                            $dataAgendamento = new DateTime($agendamento['Data']);
                            $dataAgendamento = $dataAgendamento->format('d/m/Y');
                        ?>

                            <tr>
                                <td><?= $agendamento['Nome'] ?></td>
                                <td style="width:155px"><?= $agendamento['Telefone'] ?></td>
                                <td class="horario-semana"><?= $dataAgendamento ?></td>
                                <td class="horario-semana"><?= $agendamento['Horario'] ?></td>
                                <td style="text-align: justify ;"><?= nl2br( $agendamento['Servico']) ?></td>

                            </tr>
                        <?php } ?>



                    </tbody>
                </table>
            </section>

        <?php   } ?>

</body>

</html>