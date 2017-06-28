<?php

namespace MeuProjeto\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use MeuProjeto\Util\Sessao;
use MeuProjeto\Entity\Care;
use MeuProjeto\Models\ModeloCare;
use MeuProjeto\Models\ModeloPet;

class ControleCare {
    
    private $response;
    private $request;
    private $twig;
    
    function __construct(Response $response, Request $request, \Twig_Environment $twig, Sessao $sessao) {
        $this->response = $response;
        $this->twig = $twig;
        $this->request = $request;
        $this->sessao = $sessao;
    }
    
    //METODOS PARA CADASTRAR
    public function showFormCadastrar($idPet) {
        $usuario = $this->sessao->get('usuario');
        $modeloPet = new ModeloPet();
        $pet = $modeloPet->mostrar($idPet, $usuario->idUsuario);
        
        if ($usuario) {
            return $this->response->setContent($this->twig->render('cadastro_care.html.twig', array('user' => $usuario, 'pet' => $pet)));
        } else {
            echo "<script>
                alert('Acesso negado! É preciso estar logado para acessar este conteúdo.');
                window.location.href='/';
                </script>";
        }
    }
    
    public function cadastrar($idPet) {
        $usuario = $this->sessao->get('usuario');
        
        if ($usuario) {       //verifica se há usuario logado
            $care = new Care($idPet, $this->request->get('tipo'), $this->request->get('data'), $this->request->get('descricao'));       //instancia um objeto care
            $modeloCare = new ModeloCare();       //instancia um objeto do tipo modeloCare
            $idInserido = $modeloCare->cadastrar($care);      //recebe o retorno da funcao cadastrar presendo no modeloCare
            echo "<script>      
            alert('🎉🎊Evento cadastrado com sucesso!🎉🎊');
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
    public function editar($idCare) {
        $usuario = $this->sessao->get('usuario');
        if ($usuario) {
            $modeloCare = new ModeloCare();
            $care = new Care($this->request->get('idPet'), $this->request->get('tipo'), $this->request->get('data'), $this->request->get('descricao'));
            $care->setIdCare($idCare);
            $modeloCare->editar($care);
            echo "<script>
            alert('🤗 O evento foi atualizado com sucesso! 🤗');
            window.location.href='/show_painel_interno';
             </script>";
        }
    }

    public function showFormEditar($idCare) {
        
        $usuario = $this->sessao->get('usuario');
        
        if ($usuario) {
            $modeloCare = new ModeloCare();
            $dadosCare = $modeloCare->mostrar($idCare);
            return $this->response->setContent($this->twig->render('editar_care.html.twig', array('user' => $usuario, 'care' => $dadosCare)));
        } else {
            $redirect = new RedirectResponse("/");
            $redirect->send();
        }
    }
    
    //METODOS PARA APAGAR
    /* public function excluir() {
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
     */
    public function excluir() {
        $usuario = $this->sessao->get('usuario');

        if ($usuario) {
            $idCare = $this->request->get('id');
            
            $modeloCare = new ModeloCare();
            $modeloCare->excluir($idCare);
            
            $care = $modeloCare->mostrar1($idCare);            
            
            print_r($care);
            
            if ($care->status != 1) {
                echo "<script>
                alert('Evento excluído com sucesso. 😢');
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
    
    //LISTAR EVENTOS
    public function listarEventos($idPet) {
        $usuario = $this->sessao->get('usuario');

        if ($usuario) {
            $modeloCare = new ModeloCare();
            $petCare = $modeloCare->mostrar2($idPet);
            
            if ($petCare != null) {
                $petNome = $petCare[0]->nome;
            } else {
                $petNome = "";
            }
            return $this->response->setContent($this->twig->render('listar_eventos_body.html.twig', array('user' => $usuario, 'petCare' => $petCare, 'petNome' => $petNome)));
        }
    }

    public function listarEventos2($idPet) {
        $usuario = $this->sessao->get('usuario');

        if ($usuario) {
            $modeloCare = new ModeloCare();
            $petCare = $modeloCare->mostrar3($idPet);
            if ($petCare != null) {
                $petNome = $petCare[0]->nome;
            } else {
                $petNome = "";
            }
            return $this->response->setContent($this->twig->render('listar_historico_eventos_body.html.twig', array('user' => $usuario, 'petCare' => $petCare, 'petNome' => $petNome)));
        }
    }
}
