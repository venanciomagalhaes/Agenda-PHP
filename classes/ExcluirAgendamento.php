<?php

class ExcluirAgendamento
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    public function excluir(int $id)
    {
        try {
            
            $this->conexao->mysql->exec("UPDATE loraagenda.agendamentos SET Excluido = true WHERE id = {$id}");

        } catch (PDOException $error) {
            echo "Não foi possível excluir o registro";
            echo "Erro:" . $error->getMessage();
        }
    }

}
