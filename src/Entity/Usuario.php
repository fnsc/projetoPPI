<?php

namespace MeuProjeto\Entity;

class Usuario {

    private $idUsuario;
    private $email;
    private $senha;
    private $status;

    function __construct($email, $senha) {

        $this->email = $email;
        $this->senha = $senha;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

}
