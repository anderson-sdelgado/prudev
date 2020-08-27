<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of ApontDAO
 *
 * @author anderson
 */
class ApontDAO extends Conn {

    public function verifApont($idBol, $apont) {

        $select = " SELECT "
                . " COUNT(ID) AS QTDE "
                . " FROM "
                . " PRU_APONTAMENTO "
                . " WHERE "
                . " DTHR = TO_DATE('" . $apont->dthrApont . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " FUNC_MATRIC = " . $apont->funcApont
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

    public function insApont($idBol, $apont) {

        if (!isset($apont->paradaApont) || empty($apont->paradaApont)) {
            $apont->paradaApont = "null";
        } else {
            if ($apont->paradaApont == 0) {
                $apont->paradaApont = "null";
            }
        }

        if (!isset($apont->ativApont) || empty($apont->ativApont)) {
            $apont->ativApont = "null";
        }

        if (!isset($apont->osApont) || empty($apont->osApont)) {
            $apont->osApont = "null";
        }

        $sql = "INSERT INTO PRU_APONTAMENTO ("
                . " BOLETIM_ID "
                . " , OS_NRO "
                . " , ATIVAGR_ID "
                . " , MOTPARADMO_ID "
                . " , DTHR "
                . " , DTHR_TRANS "
                . " , FUNC_MATRIC "
                . " ) "
                . " VALUES ("
                . " " . $idBol
                . " , " . $apont->osApont
                . " , " . $apont->ativApont
                . " , " . $apont->paradaApont
                . " , TO_DATE('" . $apont->dthrApont . "','DD/MM/YYYY HH24:MI') "
                . " , SYSDATE "
                . " , " . $apont->funcApont
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

}
