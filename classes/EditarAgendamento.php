<?php

class EditarAgendamento
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    public function editar(int $id, string $nome, string $telefone, string $data, string $horario, string $servico):void
    {

        try {

            $this->conexao->mysql->exec("UPDATE loraagenda.agendamentos SET Nome = '{$nome}', Telefone = '{$telefone}' Data = '{$data}', Horario = '{$horario}', Servico = '{$servico}' WHERE Id = {$id}");
           

        } catch (PDOException $error) {
            echo "Não foi possível editar o registro";
            echo "Erro:" . $error->getMessage();
        }
    }

    
}
