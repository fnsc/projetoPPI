<?php

namespace MeuProjeto\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use MeuProjeto\Util\Sessao;
use MeuProjeto\Models\ModeloUsuario;
use MeuProjeto\Models\ModeloPet;
use MeuProjeto\Models\ModeloCare;

class ControleIndex {

    private $response;
    private $request;
    private $twig;
    private $sessao;

    function __construct(Response $response, Request $request, \Twig_Environment $twig, Sessao $sessao) {
        $this->response = $response;
        $this->twig = $twig;
        $this->request = $request;
        $this->sessao = $sessao;
    }

    function mostrar() {
        $usuario = $this->sessao->get('usuario');

        $modeloUsuario = new ModeloUsuario();
        $modeloPet = new ModeloPet();
        $modeloCare = new ModeloCare();
        $usr = $modeloUsuario->qnt();
        $pet = $modeloPet->qnt();
        $care = $modeloCare->qnt();

        if ($usuario) {
            return $this->response->setContent($this->twig->render('index_body.html.twig', array('user' => $usuario, 'qntUser' => $usr, 'qntPet' => $pet, 'qntCare' => $care)));
        } else {
            return $this->response->setContent($this->twig->render('index_body.html.twig', array('user' => $usuario, 'qntUser' => $usr, 'qntPet' => $pet, 'qntCare' => $care)));
        }
    }

}
