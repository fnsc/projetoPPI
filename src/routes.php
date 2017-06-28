<?php
namespace MeuProjeto\Routes;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$rotas = new RouteCollection();

//controle_index
$rotas->add('raiz', 
        new Route('/', 
                array('_controller'=>'MeuProjeto\Controllers\ControleIndex', '_method' => 'mostrar')));

//ROTAS REFERENTES AO CONTROLE DE DADOS DO USUARIO
//cadsatro_usuario
$rotas->add('cadastrar_usuario', 
        new Route('/cadastrar_usuario', 
                array('_controller'=>'MeuProjeto\Controllers\ControleUsuario', '_method' => 'cadastrar')));

$rotas->add('form_cadastro_usuario', 
        new Route('/form_cadastro_usuario', 
                array('_controller' => 'MeuProjeto\Controllers\ControleUsuario', '_method' => 'showFormCadastrar')));

//validacaoLogin
$rotas->add('valida_login_usuario', 
        new Route('/valida_login_usuario', 
                array('_controller' => 'MeuProjeto\Controllers\ControleUsuario', '_method' => 'validaLogin')));

//apagar_usuario
$rotas->add('apagar_usuario', 
        new Route('/apagar_usuario', 
                array('_controller' => 'MeuProjeto\Controllers\ControleUsuario', '_method' => 'excluir')));

//logOut
$rotas->add('sair_usuario', 
        new Route('/sair_usuario', 
                array('_controller' => 'MeuProjeto\Controllers\ControleUsuario', '_method' => 'sairUsuario')));

//editar_usuario
$rotas->add('show_form_editar_usuario', 
        new Route('/show_form_editar_usuario', 
                array('_controller' => 'MeuProjeto\Controllers\ControleUsuario', '_method' => 'showFormEditar')));

//salvar edicao
$rotas->add('salvar_edicao', 
        new Route('/salvar_edicao/{_param}', 
                array('_controller' => 'MeuProjeto\Controllers\ControleUsuario', '_method' => 'editar')));

//mostrar painel interno
$rotas->add('show_painel_interno', 
        new Route('/show_painel_interno', 
                array('_controller' => 'MeuProjeto\Controllers\ControleUsuario', '_method' => 'showPainelInterno')));

//ROTAS REFERENTES AO CONTROLE DE DADOS DOS PETS
//cadastro de pet
$rotas->add('cadastrar_pet', 
        new Route('/cadastrar_pet', 
                array('_controller'=>'MeuProjeto\Controllers\ControlePet', '_method' => 'cadastrar')));

$rotas->add('form_cadastro_pet', 
        new Route('/form_cadastro_pet', 
                array('_controller' => 'MeuProjeto\Controllers\ControlePet', '_method' => 'showFormCadastrar')));

//editar Pet
$rotas->add('form_editar_pet', 
        new Route('/form_editar_pet/{_param}', 
                array('_controller' => 'MeuProjeto\Controllers\ControlePet', '_method' => 'showFormEditar')));

$rotas->add('editar_pet', 
        new Route('/editar_pet/{_param}', 
                array('_controller' => 'MeuProjeto\Controllers\ControlePet', '_method' => 'editar')));

//EXCLUIR PET
$rotas->add('excluir_pet', 
        new Route('/excluir_pet', 
                array('_controller' => 'MeuProjeto\Controllers\ControlePet', '_method' => 'excluir')));

//ROTAS REFERENTES AO CONTROLE DE EVENTOS
//cadastro de evento
$rotas->add('cadastrar_care', 
        new Route('/cadastrar_care/{_param}', 
                array('_controller'=>'MeuProjeto\Controllers\ControleCare', '_method' => 'cadastrar')));

$rotas->add('form_cadastro_care', 
        new Route('/form_cadastro_care/{_param}', 
               array('_controller' => 'MeuProjeto\Controllers\ControleCare', '_method' => 'showFormCadastrar')));

//editar care
$rotas->add('editar_care', 
        new Route('/editar_care/{_param}', 
                array('_controller'=>'MeuProjeto\Controllers\ControleCare', '_method' => 'editar')));

$rotas->add('form_editar_care', 
        new Route('/form_editar_care/{_param}', 
               array('_controller' => 'MeuProjeto\Controllers\ControleCare', '_method' => 'showFormEditar')));

//LISTAR EVENTOS
$rotas->add('listar_care_pet', 
        new Route('/listar_care_pet/{_param}', 
                array('_controller' => 'MeuProjeto\Controllers\ControleCare', '_method' => 'listarEventos')));

$rotas->add('historico_care_pet', 
        new Route('/historico_care_pet/{_param}', 
                array('_controller' => 'MeuProjeto\Controllers\ControleCare', '_method' => 'listarEventos2')));

//apagar care
$rotas->add('excluir_care', 
        new Route('/excluir_care', 
               array('_controller' => 'MeuProjeto\Controllers\ControleCare', '_method' => 'excluir')));

return $rotas;
