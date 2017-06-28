<?php

namespace MeuProjeto\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use MeuProjeto\Util\Sessao;
use MeuProjeto\Entity\Pet;
use MeuProjeto\Models\ModeloPet;

class ControlePet {

    private $response;
    private $request;
    private $twig;
    private $sessao;

    public function __construct(Response $response, Request $request, \Twig_Environment $twig, Sessao $sessao) {
        $this->response = $response;
        $this->twig = $twig;
        $this->request = $request;
        $this->sessao = $sessao;
    }

    //METODOS PARA CADASTRAR
    public function showFormCadastrar() {
        $usuario = $this->sessao->get('usuario');
        if ($usuario) {
            return $this->response->setContent($this->twig->render('cadastro_pet.html.twig', array('user' => $usuario)));
        } else {
            echo "<script>
                alert('Acesso negado! É preciso estar logado para acessar este conteúdo.');
                window.location.href='/';
                </script>";
        }
    }

    public function cadastrar() {
        $usuario = $this->sessao->get('usuario');
        if ($usuario) {       //verifica se há usuario logado
            $pet = new Pet($usuario->idUsuario, $this->request->get('nome'), $this->request->get('nascimento'), $this->request->get('raca'));       //instancia um objeto pet
            $modeloPet = new ModeloPet();       //instancia um objeto do tipo modeloPet
            $idInserido = $modeloPet->cadastrar($pet);      //recebe o retorno da funcao cadastrar presendo no modeloPet
            echo "<script>      
            alert('🎉🎊Pet cadastrado com sucesso!🎉🎊');
            window.location.href='/show_painel_interno/';
            </script>";
        } else {
            echo "<script>
                alert('Acesso negado! É preciso estar logado para acessar este conteúdo.');
                window.location.href='/';
                </script>";
        }
    }

    //METODOS PARA EDITAR
    public function editar($idPet) {
        $usuario = $this->sessao->get('usuario');
        if ($usuario) {
            $modeloPet = new ModeloPet();
            $pet = new Pet($usuario->idUsuario, $this->request->get('nome'), $this->request->get('nascimento'), $this->request->get('raca'));
            $pet->setIdPet($idPet);
            $modeloPet->editar($pet);
            echo "<script>
            alert('🤗 Suas informações foram atualizadas com sucesso! 🤗');
            window.location.href='/show_painel_interno';
             </script>";
        }
    }

    public function showFormEditar($idPet) {
        $usuario = $this->sessao->get('usuario');

        if ($usuario) {
            $modeloPet = new ModeloPet();
            $dadosPet = $modeloPet->mostrar($idPet, $usuario->idUsuario);
            return $this->response->setContent($this->twig->render('editar_pet.html.twig', array('user' => $usuario, 'pet' => $dadosPet)));
        } else {
            $redirect = new RedirectResponse("/");
            $redirect->send();
        }
    }

    //METODOS PARA EXCLUIR
    public function excluir() {
        $usuario = $this->sessao->get('usuario');
       
        if ($usuario) {
            $idPet = $this->request->get('id');
            
            $modeloPet = new ModeloPet();
            $modeloPet->excluir($idPet);
            
            $pet = $modeloPet->mostrar($idPet, $usuario->idUsuario);
            if ($pet->status != 1) {
                echo "<script>
                alert('Pet excluído com sucesso. 😢');
                window.location.href='/show_painel_interno';
                 </script>";
            } else {
                echo "<script>
                alert('Ops... Houve um erro. Tente novamente.');
                window.location.href='/show_painel_interno';
                 </script>";
            }
        } else {
            $redirect = new RedirectResponse("/");
            $redirect->send();
        }
    }

    //METODOS PARA MOSTRAR OS EVENTOS
//    public function listarEventos($idPet) {
//        $usuario = $this->sessao->get('usuario');
//
//        if ($usuario) {
//            $modeloPet = new ModeloPet();
//            $petCare = $modeloPet->mostrar2($idPet);
//            if ($petCare != null) {
//                $petNome = $petCare[0]->nome;
//            } else {
//                $petNome = "";
//            }
//            return $this->response->setContent($this->twig->render('listar_eventos_body.html.twig', array('user' => $usuario, 'petCare' => $petCare, 'petNome' => $petNome)));
//        }
//    }
//
//    public function listarEventos2($idPet) {
//        $usuario = $this->sessao->get('usuario');
//
//        if ($usuario) {
//            $modeloPet = new ModeloPet();
//            $petCare = $modeloPet->mostrar3($idPet);
//            if ($petCare != null) {
//                $petNome = $petCare[0]->nome;
//            } else {
//                $petNome = "";
//            }
//            return $this->response->setContent($this->twig->render('listar_historico_eventos_body.html.twig', array('user' => $usuario, 'petCare' => $petCare, 'petNome' => $petNome)));
//        }
//    }

}
