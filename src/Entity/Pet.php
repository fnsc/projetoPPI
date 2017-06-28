<?php

namespace MeuProjeto\Entity;

class Pet {

    private $idPet;
    private $idUsuario;
    private $nome;
    private $nascimento;
    private $raca;
    private $status;

    function __construct($idUsuario, $nome, $nascimento, $raca) {
        $this->idUsuario = $idUsuario;
        $this->nome = $nome;
        $this->nascimento = $nascimento;
        $this->raca = $raca;
    }

    function getIdPet() {
        return $this->idPet;
    }

    function getNome() {
        return $this->nome;
    }

    function getRaca() {
        return $this->raca;
    }

    function getStatus() {
        return $this->status;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setRaca($raca) {
        $this->raca = $raca;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getNascimento() {
        return $this->nascimento;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setNascimento($nascimento) {
        $this->nascimento = $nascimento;
    }

    function setIdPet($idPet) {
        $this->idPet = $idPet;
    }

}
