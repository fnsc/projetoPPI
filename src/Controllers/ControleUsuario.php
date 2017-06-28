<?php

namespace MeuProjeto\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use MeuProjeto\Models\ModeloUsuario;
use MeuProjeto\Entity\Usuario;
use MeuProjeto\Models\ModeloPet;
use MeuProjeto\Models\ModeloCare;
use MeuProjeto\Util\Sessao;

class ControleUsuario {

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

    public function cadastrar() {

        $usuario = new Usuario($this->request->request->get('email'), $this->request->request->get('senha'));
        $modeloUsuario = new ModeloUsuario();
        $idInserido = $modeloUsuario->cadastrar($usuario);
        echo "<script>
        alert('😁 Bem vindo à comunidade! Agora basta você fazer o seu login e nós te ajudaremos a cuidar do seu melhor amigo! 😁');
        window.location.href='/';
        </script>";
    }

    public function editar() {
        $usuario = $this->sessao->get("usuario");

        $usr = new Usuario($this->request->request->get('email'), $this->request->request->get('senha'));
        $usr->setIdUsuario($usuario->idUsuario);

        $modelo = new ModeloUsuario();
        $modelo->editar($usr);

        $usuario->email = $usr->getEmail();
        print_r($usuario);
        $this->sessao->alter('usuario', $usuario);

        echo "<script>
        alert('🤗 Suas informações foram atualizadas com sucesso! 🤗');
        window.location.href='/';
        </script>";
    }

    public function excluir() {
        $usuario = $this->sessao->get('usuario');
        if ($usuario) {
            $modelo = new ModeloUsuario();
            $modelo->excluir($usuario->idUsuario);
            $this->sairUsuario();
            echo "<script>
            alert('😭 Que pena! Sentiremos sua falta! 😭');
            window.location.href='/';
            </script>";
        } else {
            echo "<script>
            alert('Erro na exclusão da sua conta.');
            window.location.href='/';
            </script>";
        }
    }

    //metodos de validacao
    public function validaLogin() {
        $modelo = new ModeloUsuario();
        $usuario = ($modelo->validaLogin($this->request->get('email'), $this->request->get('senha')));
        if ($usuario && $usuario->status == 1) {
            $usuario->senha = '';
            $this->sessao->add("usuario", $usuario);
            echo 1;
//            $redirect = new RedirectResponse("/");
//            $redirect->send();
        } else {
            echo 0;
//            if ($usuario == null) {
//                echo "<script>
//                alert('Usuário ou senha inválido!');
//                window.location.href='/';
//                </script>";
//            } else {
//                echo "<script>
//                alert('Sua conta não existe mais 😳. Mas caso queira voltar, basta entrar em contato com o nosso suporte🛠:                                        👉suporte@petcare.com👍');
//                window.location.href='/';
//                </script>";
//            }
        }
    }

    //metodos 
    function showPainelInterno() {
        $usuario = $this->sessao->get("usuario");
        
        if ($usuario) {
            $modeloPet = new ModeloPet();
            $modeloCare = new ModeloCare();
            $pet = $modeloPet->listar($usuario->idUsuario);
            $care = $modeloCare->listar($usuario->idUsuario);
            return $this->response->setContent($this->twig->render('painel_interno_body.html.twig', array('user' => $usuario, 'pets' => $pet, 'cares' => $care)));
        } else {
            $redirect = new RedirectResponse("/");
            $redirect->send();
        }
    }

    function showFormCadastrar() {
        $usuario = $this->sessao->get('usuario');
        if ($usuario) {
            $redirect = new RedirectResponse("/show_painel_interno");
            $redirect->send();
        } else {
            return $this->response->setContent($this->twig->render('cadastro_usuario.html.twig'));
        }
    }

    function showFormEditar() {
        $usuario = $this->sessao->get("usuario");
        if ($usuario) {
            $modelo = new ModeloUsuario();
            $dados = $modelo->mostrar($usuario->idUsuario);

            return $this->response->setContent($this->twig->render('editar_usuario.html.twig', array('dados' => $dados, 'user' => $usuario)));
        } else {
            $redirect = new RedirectResponse("/");
            $redirect->send();
        }
    }

    function sairUsuario() {
        $usuario = $this->sessao->get('usuario');
        if ($usuario) {
            $this->sessao->rem('usuario');
            $this->sessao->del('usuario');
            $redirect = new RedirectResponse("/");
            $redirect->send();
        } else {
            $redirect = new RedirectResponse("/");
            $redirect->send();
        }
    }

}
