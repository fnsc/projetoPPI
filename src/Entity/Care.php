<?php

namespace MeuProjeto\Entity;

class Care {

    private $idCare;
    private $idPet;
    private $tipo;
    private $data;
    private $descricao;
    private $status;

    function __construct($idPet, $tipo, $data, $descricao) {
        $this->idPet = $idPet;
        $this->tipo = $tipo;
        $this->data = $data;
        $this->descricao = $descricao;
    }

    function getIdCare() {
        return $this->idCare;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getData() {
        return $this->data;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getStatus() {
        return $this->status;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function getIdPet() {
        return $this->idPet;
    }

    function setIdPet($idPet) {
        $this->idPet = $idPet;
    }

    function setIdCare($idCare) {
        $this->idCare = $idCare;
    }

}
