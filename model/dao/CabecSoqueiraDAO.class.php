<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/Conn.class.php');
require_once('../model/dao/AjusteDataHoraDAO.class.php');
/**
 * Description of CabecAmostraDAO
 *
 * @author anderson
 */
class CabecSoqueiraDAO extends Conn {
    
    
    public function verifCabec($cabec) {

        $select = " SELECT "
            . " COUNT(ID) AS QTDE "
            . " FROM "
            . " PRU_SOQUEIRA_CABEC "
            . " WHERE "
            . " DTHR_CEL = TO_DATE('" . $cabec->dthrCabecSoqueira . "','DD/MM/YYYY HH24:MI') "
            . " AND "
            . " MATRIC_AUDITOR = " . $cabec->auditorCabecSoqueira
            . " AND "
            . " EQUIP_ID = " . $cabec->equipCabecSoqueira;

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
                . " PRU_SOQUEIRA_CABEC "
                . " WHERE "
                . " DTHR_CEL = TO_DATE('" . $cabec->dthrCabecSoqueira . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " MATRIC_AUDITOR = " . $cabec->auditorCabecSoqueira
                . " AND "
                . " EQUIP_ID = " . $cabec->equipCabecSoqueira;

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

        $sql = "INSERT INTO PRU_SOQUEIRA_CABEC ("
                . " MATRIC_AUDITOR "
                . " , NRO_OS "
                . " , EQUIP_ID "
                . " , STATUS "
                . " , DTHR "
                . " , DTHR_CEL "
                . " , DTHR_TRANS "
                . " ) "
                . " VALUES ("
                . " " . $cabec->auditorCabecSoqueira
                . " , " . $cabec->osCabecSoqueira
                . " , " . $cabec->equipCabecSoqueira
                . " , " . $cabec->statusCabecSoqueira
                . " , " . $ajusteDataHoraDAO->dataHoraGMT($cabec->dthrCabecSoqueira)
                . " , TO_DATE('" . $cabec->dthrCabecSoqueira . "','DD/MM/YYYY HH24:MI')"
                . " , SYSDATE "
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    
    }
    
}
