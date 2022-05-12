<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of LiderDAO
 *
 * @author anderson
 */
class LiderDAO extends Conn {
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                    . " LIDER_ID AS \"idLider\" "
                    . " , LIDER_MATRIC AS \"matricLider\" "
                    . " , LIDER_NOME AS \"nomeLider\" "
                . " FROM "
                    . " USINAS.V_SIMOVA_LIDER_MOBRA "
                . " ORDER BY "
                    . " LIDER_MATRIC "
                . " ASC ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
    
}
