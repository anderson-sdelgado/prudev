<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of RespFitoDAO
 *
 * @author anderson
 */
class RespFitoDAO extends Conn {
    
    public function verifResp($idCabec, $resp) {

        $select = " SELECT "
                . " COUNT(ITIMPFEST_ID) AS QTDE "
                . " FROM "
                . " USINAS.ITEM_IMPORT_INFEST "
                . " WHERE "
                . " ITAMOSORGA_ID = " . $resp->idAmostraRespFito
                . " AND "
                . " NRO_PONTO = " . $resp->pontoRespFito
                . " AND "
                . " IMPFEST_ID = " . $idCabec;

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
    
    public function insResp($idCabec, $resp) {

        $sql = " INSERT INTO USINAS.ITEM_IMPORT_INFEST ( "
            . " IMPFEST_ID "
            . " , NRO_PONTO "
            . " , ITAMOSORGA_ID "
            . " , VL "
            . " ) "
            . " VALUES ("
            . " " . $idCabec
            . " , " . $resp->pontoRespFito
            . " , " . $resp->idAmostraRespFito
            . " , " . $resp->valorRespFito
            . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    
}
