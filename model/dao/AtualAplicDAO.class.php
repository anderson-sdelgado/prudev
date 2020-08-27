<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of AtualizaAplicDAO
 *
 * @author anderson
 */
class AtualAplicDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;
    
    public function verAtual($celular) {

        $select = "SELECT "
                        . " COUNT(*) AS QTDE "
                    . " FROM "
                        . " PRU_ATUALIZACAO "
                    . " WHERE "
                        . " NUMERO_LINHA = " . $celular;   

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $v = $item['QTDE'];
        }

        return $v;
    }

    public function insAtual($celular, $va) {

        $sql = "INSERT INTO PRU_ATUALIZACAO ("
                . " NUMERO_LINHA "
                . " , VERSAO_ATUAL "
                . " , VERSAO_NOVA "
                . " , DTHR_ULT_ATUAL "
                . " ) "
                . " VALUES ("
                . " " . $celular
                . " , " . $va
                . " , " . $va
                . " , SYSDATE "
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    public function retAtual($equip) {

        $select = " SELECT "
                . " VERSAO_NOVA"
                . " , VERSAO_ATUAL"
                . " FROM "
                . " PRU_ATUALIZACAO "
                . " WHERE "
                . " NUMERO_LINHA = " . $equip;

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }

    public function updAtualNova($equip, $va) {

        $sql = "UPDATE PMM_ATUALIZACAO "
                . " SET "
                . " VERSAO_ATUAL = TRIM(TO_CHAR(" . $va . ", '99999999D99'))"
                . " , VERSAO_NOVA = TRIM(TO_CHAR(" . $va . ", '99999999D99'))"
                . " , DTHR_ULT_ATUAL = SYSDATE "
                . " WHERE "
                . " NUMERO_LINHA = " . $equip;

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    public function updAtual($celular, $va) {

        $sql = "UPDATE PRU_ATUALIZACAO "
            . " SET "
            . " VERSAO_ATUAL = " . $va
            . " , DTHR_ULT_ATUAL = SYSDATE "
            . " WHERE "
                . " NUMERO_LINHA = " . $celular;

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    public function dataHora() {

        $select = " SELECT "
                . " TO_CHAR(SYSDATE, 'DD/MM/YYYY HH24:MI') AS DTHR "
                . " FROM "
                . " DUAL ";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result1 = $this->Read->fetchAll();

        foreach ($result1 as $item) {
            $dthr = $item['DTHR'];
        }

        return $dthr;
    }
    
}
