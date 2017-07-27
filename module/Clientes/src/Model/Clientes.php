<?php

namespace Clientes\Model;

class Clientes{
    public $idclientes;
    public $nome;
    public $telefone;
    public $email;
    public $foto;


    public function exchangeArray(array $data)
    {
        $this->idclientes = (!empty($data['idclientes'])) ? $data['idclientes'] : null;
        $this->nome = (!empty($data['nome'])) ? $data['nome'] : null;
        $this->telefone = (!empty($data['telefone'])) ? $data['telefone'] : null;
        $this->email = (!empty($data['email'])) ? $data['email'] : null;
        $this->foto = (!empty($data['foto'])) ? $data['foto'] : null;
    }
    public function getArrayCopy()
    {
        return [
            'idclientes' => $this->idclientes,
            'nome' => $this->nome,
            'telefone' => $this->telefone,
            'email' => $this->email,
            'foto' => $this->foto
        ];
    }
}