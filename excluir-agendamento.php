<?php

require_once "classes/Conexao.php";
require_once "classes/ExibirAgendamento.php";
require_once "classes/ExcluirAgendamento.php";
date_default_timezone_set('America/Sao_Paulo');



if ($_SERVER['REQUEST_METHOD'] == 'GET' and !empty($_GET['id'])) {

    $exibirAgendamentos = new ExibirAgendamento();
    $agendamentos = $exibirAgendamentos->agendamentoIndividual($_GET['id']);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = (int) $_POST['id'];

    $excluirAgendamento = new ExcluirAgendamento();
    $excluirAgendamento->excluir($id);

    header('Location: todos-agendamentos.php?excluir=true');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lora Agenda | Excluir </title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/533e482dd1.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php require_once 'assets/templates/header.php' ?>


    <section class="excluir-aviso">

        <?php foreach ($agendamentos as $agendamento) {
            $data = new DateTime($agendamento['Data']);
            $data = $data->format('d/m/Y')
        ?>

            <p>Você realmente deseja excluir o agendamento de <span class="nome-data"> <?= $agendamento['Nome'] ?></span> do dia <span class="nome-data"> <?= $data  ?></span> ?</p>

            <p class="aviso-2"> ESSA AÇÃO É IRREVERSSÍVEL</p>

            <form action="excluir-agendamento.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $agendamento['Id'] ?>">

                
                <a class="false-submit" href="todos-agendamentos.php?excluir=cancel">NÃO</a>
                <input type="submit" value="SIM">
            </form>
        <?php } ?>




    </section>




</body>

</html>