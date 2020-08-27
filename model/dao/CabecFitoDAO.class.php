<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of CabecFitoDAO
 *
 * @author anderson
 */
class CabecFitoDAO extends Conn {
    //put your code here
    
    
    public function verifCabec($cabec) {

        $select = " SELECT "
            . " COUNT(*) AS QTDE "
            . " FROM "
            . " USINAS.IMPORT_INFEST "
            . " WHERE "
            . " DT = TO_DATE('" . $cabec->dthrCabecFito . "','DD/MM/YYYY HH24:MI') "
            . " AND "
            . " FUNC_ID = " . $cabec->auditorCabecFito . " ";

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
                . " IMPFEST_ID AS ID "
                . " FROM "
                . " USINAS.IMPORT_INFEST "
                . " WHERE "
                . " DT = TO_DATE('" . $cabec->dthrCabecFito . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " FUNC_ID = " . $cabec->auditorCabecFito;

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

        $sql = "INSERT INTO USINAS.IMPORT_INFEST ("
                . " DT "
                . " , FUNC_ID "
                . " , PROPRAGR_ID "
                . " , TALHAO_ID "
                . " , ORGDANINHO_ID "
                . " , GRCARACORG_ID "
                . " , DT_HR_GERA "
                . " , STATUS "
                . " ) "
                . " VALUES ("
                . " TO_DATE('" . $cabec->dthrCabecFito . "','DD/MM/YYYY HH24:MI') "
                . " , " . $cabec->auditorCabecFito
                . " , 0 "
                . " , " . $cabec->talhaoCabecFito
                . " , " . $cabec->idOrgCabecFito
                . " , " . $cabec->idCaracOrgCabecFito
                . " , SYSDATE "
                . " , 2 "
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    
    }

    
}
