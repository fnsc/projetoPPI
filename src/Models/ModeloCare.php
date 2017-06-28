<?php

namespace MeuProjeto\Models;

use MeuProjeto\Util\Conexao;
use PDO;
use MeuProjeto\Entity\Care;

class ModeloCare {
    public function __construct() {
        
    }
    
    public function cadastrar (Care $care){
        try {
        
            $sql = "insert into care (idpet, tipo, descricao, data) values (:idPet, :tipo, :descricao, :data)";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':idPet', $care->getIdPet());
            $p_sql->bindValue(':tipo', $care->getTipo());
            $p_sql->bindValue(':descricao', $care->getDescricao());
            $p_sql->bindValue(':data', $care->getData());
            $p_sql->execute();
            return Conexao::getInstance()->lastInsertId();
        } catch (Exception $exc) {
            
            echo $exc->getTraceAsString();
        
        }
    }
    
    public function mostrar($idCare){
    
        try {
        
            $sql = "select care.idCare, care.tipo, care.descricao, care.data, pet.nome, pet.idPet "
                    . "from care, pet "
                    . "where care.idcare = :idCare "
                    . "and pet.idPet = care.idPet "
                    . "and care.status = 1"; 
           $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':idCare', $idCare);
            $p_sql->execute();
            return $p_sql->fetch(PDO::FETCH_OBJ);
        }
        catch (Exception $exc) {
            
            echo $exc->getTraceAsString();
        
        }
    }
    
    public function mostrar1($idCare) {

        try {

            $sql = "select * from care where idCare= :idCare";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':idCare', $idCare);
            $p_sql->execute();
            return $p_sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $exc) {

            echo $exc->getTraceAsString();
        }
    }
    
    public function mostrar2($idPet) {

        try {
            $sql = "select pet.nome, pet.idPet, care.tipo, care.descricao, care.data, care.idCare "
                    . "from care, pet "
                    . "where pet.idPet = :idPet "
                    . "and care.idPet = :idPet "
                    . "and care.status = 1 "
                    . "and care.data >= curdate() "
                    . "order by care.data asc;";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue('idPet', $idPet);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $exc) {

            echo $exc->getTraceAsString();
        }
    }
    
    public function mostrar3($idPet) {

        try {

            $sql = "select pet.nome, pet.idPet, care.tipo, care.descricao, care.data, care.idCare "
                    . "from pet, care "
                    . "where pet.idPet = :idPet "
                    . "and care.idPet = :idPet "
                    . "and care.status = 1 "
                    . "order by data desc";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue('idPet', $idPet);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $exc) {

            echo $exc->getTraceAsString();
        }
    }
    
    public function listar ($idUsuario){
        try {
            $sql = "select pet.nome from usuario, pet, care where usuario.idUsuario = :idUsuario and usuario.idUsuario = pet.idUsuario and pet.idPet = care.idPet and pet.status <> 0 and care.status <> 0 and care.data = curdate()";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':idUsuario', $idUsuario);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $exc) {

            echo $exc->getTraceAsString();
        }
    }


    public function excluir($idCare){
        
        try {
            $sql = "update care set status = 0 where idCare = :idCare";
                $p_sql = Conexao::getInstance()->prepare($sql);
                $p_sql->bindValue(':idCare', $idCare);
                $p_sql->execute();
        }
        catch (Exception $exc) {
            
            echo $exc->getTraceAsString();
        
        }
    }
    
    public function editar(Care $care){
        try {
            $sql = "update care set tipo = :tipo, data = :data, descricao = :descricao where idCare = :idCare";
                $p_sql = Conexao::getInstance()->prepare($sql);
                $p_sql->bindValue(':tipo', $care->getTipo());
                $p_sql->bindValue(':descricao', $care->getDescricao());
                $p_sql->bindValue(':data', $care->getData());
                $p_sql->bindValue(':idCare', $care->getIdCare());
                $p_sql->execute();
        }
        catch (Exception $exc) {
            
            echo $exc->getTraceAsString();
        
        }
    }
    
    public function qnt(){
        try{
            $sql = "select count(*) as qnt from care left join pet on care.idPet = pet.idPet and care.status = 1 and pet.status = 1";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $ex) {

        }
    }
}