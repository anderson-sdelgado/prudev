<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of AlocaFuncDAO
 *
 * @author anderson
 */
class AlocaFuncDAO extends Conn {

    //put your code here

    public function verifAlocaFunc($idBol, $alocFunc) {

        $select = " SELECT "
                . " COUNT(ID) AS QTDE "
                . " FROM "
                . " PRU_ALOCA_FUNC "
                . " WHERE "
                . " DTHR = TO_DATE('" . $alocFunc->dthrAlocaFunc . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " FUNC_MATRIC = " . $alocFunc->matricFuncAlocaFunc
                . " AND "
                . " BOLETIM_ID = " . $idBol;

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

    public function insAlocaFunc($idBol, $alocFunc) {

        $sql = "INSERT INTO PRU_ALOCA_FUNC ("
                . " BOLETIM_ID "
                . " , FUNC_MATRIC "
                . " , TIPO "
                . " , DTHR "
                . " , DTHR_TRANS "
                . " ) "
                . " VALUES ("
                . " " . $idBol
                . " , " . $alocFunc->matricFuncAlocaFunc
                . " , " . $alocFunc->tipoAlocaFunc
                . " , TO_DATE('" . $alocFunc->dthrAlocaFunc . "','DD/MM/YYYY HH24:MI') "
                . " , SYSDATE "
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

}
