<?php


class CriarAgendamento
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    public function cadastrar(string $nome, string $telefone, string $data, string $horario, string $servico): void
    {

       try{

        $this->conexao->mysql->exec("Use loraagenda");
        $this->conexao->mysql->query("INSERT INTO agendamentos(Nome,Telefone, Data, Horario, Servico, Excluido)VALUES ('{$nome}','{$telefone}','{$data}','{$horario}','{$servico}', 0)");

       

       } catch (PDOException $error){

            echo "Não foi possível inserir o registro.";
            echo "Erro:". $error->getMessage();
       }
    }
}