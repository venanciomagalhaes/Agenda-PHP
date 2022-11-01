<?php

require_once "classes/Conexao.php";
require_once "classes/ExibirAgendamento.php";
date_default_timezone_set('America/Sao_Paulo');

$exibirAgendamentos = new ExibirAgendamento();
$agendamentos = $exibirAgendamentos->todosAgendamentos();

function classe($data)
{

    $data =  DateTime::createFromFormat('Y-m-d', $data);
    $dataAtual = new DateTime();
    $dataAtual = $dataAtual->format('Y-m-d');
    $dataAtual = DateTime::createFromFormat('Y-m-d', $dataAtual);
    $dataLimite = date("Y-m-d", time() + (7 * 86400));
    $dataLimite = DateTime::createFromFormat('Y-m-d', $dataLimite);


    if ($data == $dataAtual) {
        return 'horario-hoje';
    } else if ($data <= $dataLimite) {
        return 'horario-semana';
    } else {
        return 'horario-restante';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['agendamento'])) {

    $avisoEditar = '<div  class="sucesso-editar">Agendamento editado com sucesso! </div>';
}

if (isset($_GET['excluir'])) {

    if ($_GET['excluir'] == 'true') {
        $avisoMantido =  '<div style="background-color: red; color: yellow" class="sucesso-editar">O Agendamento foi EXCLUÍDO com sucesso! </div>';
      
    } else {

        $avisoMantido =  '<div style="background-color: white" class="sucesso-editar">O Agendamento foi MANTIDO com sucesso! </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lora Agenda | Todos </title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/533e482dd1.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php require_once 'assets/templates/header.php' ?>

    <?= isset($avisoMantido) ? $avisoMantido : '' ?>
    <?= isset($avisoEditar) ? $avisoEditar : '' ?>

    <section class="todos-agendamentos">


        <table class="tabela-todos">
            <thead>
                <th>Cliente</th>
                <th>Telefone</th>
                <th>Data</th>
                <th>Horário</th>
                <th>Serviço</th>
                <th>Editar</th>
                <th>Excluir</th>
            </thead>

            <tbody>

                <?php foreach ($agendamentos as $agendamento) {

                    $dataAgendamento = new DateTime($agendamento['Data']);
                ?>

                    <tr>
                        <td><?= $agendamento['Nome'] ?></td>
                        <td style="width: 155px ;" ><?= $agendamento['Telefone'] ?></td>
                        <td class="<?= classe($agendamento['Data'])  ?>"><?= $dataAgendamento->format('d/m/Y'); ?></td>
                        <td class="<?= classe($agendamento['Data']) ?>"><?= $agendamento['Horario'] ?></td>
                        <td style="text-align: justify ;"><?= $agendamento['Servico'] ?></td>
                        <td><a href='editar-agendamento.php?id=<?= $agendamento['Id']  ?>'><i style="color: blue; font-size: 20px; cursor: pointer" class="fa-regular fa-pen-to-square"></i> </a></td>
                        <td><a href="excluir-agendamento.php?id=<?= $agendamento['Id'] ?>"><i style="color: red; font-size: 20px; cursor: pointer" class="fa-solid fa-trash-can"></i></a></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>

    </section>

</body>

</html>