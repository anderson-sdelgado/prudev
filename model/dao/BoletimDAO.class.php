<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of BoletimDAO
 *
 * @author anderson
 */
class BoletimDAO extends Conn {

    public function verifBoletim($bol) {

        $select = " SELECT "
                . " COUNT(*) AS QTDE "
                . " FROM "
                . " PRU_BOLETIM "
                . " WHERE "
                . " DTHR_INICIAL = TO_DATE('" . $bol->dthrInicioBol . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " LIDER_MATRIC = " . $bol->idLiderBol;

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

    public function idBoletim($bol) {

        $select = " SELECT "
                . " ID AS ID "
                . " FROM "
                . " PRU_BOLETIM "
                . " WHERE "
                . " DTHR_INICIAL = TO_DATE('" . $bol->dthrInicioBol . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " LIDER_MATRIC = " . $bol->idLiderBol;

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $id = $item['ID'];
        }

        return $id;
    }

    public function insBoletim($bol) {

        $sql = "INSERT INTO PRU_BOLETIM ("
                . " LIDER_MATRIC "
                . " , TURMA_ID "
                . " , OS_NRO "
                . " , ATIVAGR_PRINC_ID "
                . " , DTHR_INICIAL "
                . " , DTHR_TRANS_INICIAL "
                . " , DTHR_FINAL "
                . " , DTHR_TRANS_FINAL "
                . " , STATUS "
                . " , SIT "
                . " ) "
                . " VALUES ("
                . " " . $bol->idLiderBol
                . " , " . $bol->idTurmaBol
                . " , " . $bol->osBol
                . " , " . $bol->ativPrincBol
                . " , TO_DATE('" . $bol->dthrInicioBol . "','DD/MM/YYYY HH24:MI') "
                . " , SYSDATE "
                . " , TO_DATE('" . $bol->dthrFimBol . "','DD/MM/YYYY HH24:MI') "
                . " , SYSDATE "
                . " , 2 "
                . " , 0 "
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

}
