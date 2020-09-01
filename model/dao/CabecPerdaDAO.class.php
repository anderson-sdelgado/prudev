<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/Conn.class.php');
require_once('../model/dao/AjusteDataHoraDAO.class.php');
/**
 * Description of CabecPerdaDAO
 *
 * @author anderson
 */
class CabecPerdaDAO extends Conn {
    
    public function verifCabec($cabec) {

        $select = " SELECT "
            . " COUNT(ID) AS QTDE "
            . " FROM "
            . " PRU_PERDA_CABEC "
            . " WHERE "
            . " DTHR_CEL = TO_DATE('" . $cabec->dthrCabecPerda . "','DD/MM/YYYY HH24:MI') "
            . " AND "
            . " MATRIC_AUDITOR = " . $cabec->auditorCabecPerda
            . " AND "
            . " EQUIP_ID = " . $cabec->equipCabecPerda;

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
    
    public function idCabec($cabec) {

        $select = " SELECT "
                . " ID AS ID "
                . " FROM "
                . " PRU_PERDA_CABEC "
                . " WHERE "
                . " DTHR_CEL = TO_DATE('" . $cabec->dthrCabecPerda . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " MATRIC_AUDITOR = " . $cabec->auditorCabecPerda
                . " AND "
                . " EQUIP_ID = " . $cabec->equipCabecPerda;

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
    
    
    public function insCabec($cabec) {
        
        $ajusteDataHoraDAO = new AjusteDataHoraDAO();

        $sql = "INSERT INTO PRU_PERDA_CABEC ("
                . " TIPO_COLH "
                . " , MATRIC_AUDITOR "
                . " , NRO_OS "
                . " , EQUIP_ID "
                . " , STATUS "
                . " , DTHR "
                . " , DTHR_CEL "
                . " , DTHR_TRANS "
                . " ) "
                . " VALUES ("
                . " " . $cabec->tipoColheitaCabecPerda
                . " , " . $cabec->auditorCabecPerda
                . " , " . $cabec->osCabecPerda
                . " , " . $cabec->equipCabecPerda
                . " , " . $cabec->statusCabecPerda
                . " , " . $ajusteDataHoraDAO->dataHoraGMT($cabec->dthrCabecPerda)
                . " , TO_DATE('" . $cabec->dthrCabecPerda . "','DD/MM/YYYY HH24:MI')"
                . " , SYSDATE "
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    
    }

    
}
