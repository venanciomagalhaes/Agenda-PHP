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

            $agendamentos =  $this->conexao->mysql->query('SELECT * FROM loraagenda.agendamentos ORDER BY Data ASC')->fetchAll(PDO::FETCH_ASSOC);

            return $agendamentos;
        } catch (PDOException $error) {
            echo "Não foi possível realizar a consulta";
            echo "Erro:" . $error->getMessage();
        }
    }

    public function agendamentosHoje(): array
    {

        try {
            $dataAtual = new DateTime();
            $dataAtual = $dataAtual->format('Y-m-d');

            $agendamentos =  $this->conexao->mysql->query("SELECT * FROM loraagenda.agendamentos WHERE Data = '{$dataAtual}'")->fetchAll(PDO::FETCH_ASSOC);



            return $agendamentos;
        } catch (PDOException $error) {
            echo "Não foi possível realizar a consulta";
            echo "Erro:" . $error->getMessage();
        }
    }


    public function agendamentoSemana(): array
    {
        try {
            $dataAmanha = new DateTime('tomorrow');
            $dataAmanha = $dataAmanha->format('Y:m:d');
            $dataLimite = date("Y-m-d", time() + (7 * 86400));
        
            $agendamentos =  $this->conexao->mysql->query("SELECT * FROM loraagenda.agendamentos WHERE Data BETWEEN '{$dataAmanha}' AND '{$dataLimite}'")->fetchAll(PDO::FETCH_ASSOC);

            return $agendamentos;

        } catch (PDOException $error) {
            echo "Não foi possível realizar a consulta";
            echo "Erro:" . $error->getMessage();
        }
    }


    public function agendamentoIndividual(string $id):array
    {
        try {
           
            $agendamento =  $this->conexao->mysql->query("SELECT * FROM loraagenda.agendamentos WHERE Id = {$id}")->fetchAll(PDO::FETCH_ASSOC);

            return $agendamento;

        } catch (PDOException $error) {
            echo "Não foi possível realizar a consulta";
            echo "Erro:" . $error->getMessage();
        }
    }

}
