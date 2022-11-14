<?php

class ExibirAgendamento
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    public function todosAgendamentos(): array
    {
        try {

            $agendamentos =  $this->conexao->mysql->query('SELECT *, TIME_FORMAT(Horario, "%H:%i") as Horario  FROM loraagenda.agendamentos WHERE  Excluido != 1 ORDER BY Data ASC')->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {
            echo "Não foi possível realizar a consulta";
            echo "Erro:" . $error->getMessage();
        }
        return $agendamentos;
    }

    public function agendamentosHoje(): array
    {

        try {
            $dataAtual = new DateTime();
            $dataAtual = $dataAtual->format('Y-m-d');

            $agendamentos =  $this->conexao->mysql->query("SELECT *, TIME_FORMAT(Horario, '%H:%i') as Horario  FROM loraagenda.agendamentos WHERE Data = '{$dataAtual}'  AND Excluido != 1")->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {
            echo "Não foi possível realizar a consulta";
            echo "Erro:" . $error->getMessage();
        }
        return $agendamentos;
    }


    public function agendamentoSemana(): array
    {
        try {
            $dataAmanha = new DateTime('tomorrow');
            $dataAmanha = $dataAmanha->format('Y:m:d');
            $dataLimite = date("Y-m-d", time() + (7 * 86400));
        
            $agendamentos =  $this->conexao->mysql->query("SELECT *, TIME_FORMAT(Horario, '%H:%i') as Horario  FROM loraagenda.agendamentos WHERE Data BETWEEN '{$dataAmanha}' AND '{$dataLimite}'  AND Excluido != 1")->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {
            echo "Não foi possível realizar a consulta";
            echo "Erro:" . $error->getMessage();
        }

        return $agendamentos;
    }


    public function agendamentoIndividual(string $id):array
    {
        try {
           
            $agendamento =  $this->conexao->mysql->query("SELECT *, TIME_FORMAT(Horario, '%H:%i') as Horario  FROM loraagenda.agendamentos WHERE Id = {$id} AND Excluido != 1")->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {
            echo "Não foi possível realizar a consulta";
            echo "Erro:" . $error->getMessage();
        }
        return $agendamento;
    }

    public function historicoAgendamentos()
    {
        $historico =  $this->conexao->mysql->query("SELECT * , TIME_FORMAT(Horario, '%H:%i') as Horario  FROM loraagenda.agendamentos WHERE Excluido = 1 ORDER BY Data DESC")->fetchAll(PDO::FETCH_ASSOC);
        return $historico;

    }

}
