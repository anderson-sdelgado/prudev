<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./dbutil/Conn.class.php');
/**
 * Description of InsBolAbertoMMDAO
 *
 * @author anderson
 */
class InsBolAbertoDAO extends ConnDEV {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function salvarDados($dadosBoletim, $dadosAponta, $dadosAlocaFunc) {

        $this->Conn = parent::getConn();
        
        foreach ($dadosBoletim as $bol) {

            $select = " SELECT "
                    . " COUNT(*) AS QTDE "
                    . " FROM "
                    . " PRU_BOLETIM "
                    . " WHERE "
                    . " DTHR_INICIAL = TO_DATE('" . $bol->dthrInicioBoletim . "','DD/MM/YYYY HH24:MI') "
                    . " AND "
                    . " LIDER_MATRIC = " . $bol->idLiderBoletim . " ";

            $this->Read = $this->Conn->prepare($select);
            $this->Read->setFetchMode(PDO::FETCH_ASSOC);
            $this->Read->execute();
            $result = $this->Read->fetchAll();

            foreach ($result as $item) {
                $v = $item['QTDE'];
            }

            if ($v == 0) {

                $sql = "INSERT INTO PRU_BOLETIM ("
                        . " LIDER_MATRIC "
                        . " , TURMA_ID "
                        . " , OS_NRO "
                        . " , ATIVAGR_PRINC_ID "
                        . " , DTHR_INICIAL "
                        . " , DTHR_TRANS_INICIAL "
                        . " , STATUS "
                        . " , SIT "
                        . " ) "
                        . " VALUES ("
                        . " " . $bol->idLiderBoletim
                        . " , " . $bol->idTurmaBoletim
                        . " , " . $bol->osBoletim
                        . " , " . $bol->ativPrincBoletim
                        . " , TO_DATE('" . $bol->dthrInicioBoletim . "','DD/MM/YYYY HH24:MI') "
                        . " , SYSDATE "
                        . " , 1 "
                        . " , 0 "
                        . " )";

                $this->Create = $this->Conn->prepare($sql);
                $this->Create->execute();

                $select = " SELECT "
                        . " ID AS ID "
                        . " FROM "
                        . " PRU_BOLETIM "
                        . " WHERE "
                        . " DTHR_INICIAL = TO_DATE('" . $bol->dthrInicioBoletim . "','DD/MM/YYYY HH24:MI') "
                        . " AND "
                        . " LIDER_MATRIC = " . $bol->idLiderBoletim . " ";

                $this->Read = $this->Conn->prepare($select);
                $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                $this->Read->execute();
                $result = $this->Read->fetchAll();

                foreach ($result as $item) {
                    $idBol = $item['ID'];
                }

                foreach ($dadosAlocaFunc as $alocfunc) {

                    if ($bol->idBoletim == $alocfunc->idBolAlocaFunc) {

                        $sql = "INSERT INTO PRU_ALOCA_FUNC ("
                                . " BOLETIM_ID "
                                . " , FUNC_MATRIC "
                                . " , TIPO "
                                . " , DTHR "
                                . " , DTHR_TRANS "
                                . " ) "
                                . " VALUES ("
                                . " " . $idBol
                                . " , " . $alocfunc->codFuncionarioAlocaFunc
                                . " , " . $alocfunc->tipoAlocaFunc
                                . " , TO_DATE('" . $alocfunc->dthrAlocaFunc . "','DD/MM/YYYY HH24:MI') "
                                . " , SYSDATE "
                                . " )";

                        $this->Create = $this->Conn->prepare($sql);
                        $this->Create->execute();
                    }
                }
                
                foreach ($dadosAponta as $apont) {

                    if ($bol->idBoletim == $apont->idBolAponta) {

                        $sql = "INSERT INTO PRU_APONTAMENTO ("
                                . " BOLETIM_ID "
                                . " , OS_NRO "
                                . " , ATIVAGR_ID "
                                . " , MOTPARADA_ID "
                                . " , DTHR "
                                . " , DTHR_TRANS "
                                . " ) "
                                . " VALUES ("
                                . " " . $idBol
                                . " , " . $apont->osAponta
                                . " , " . $apont->ativAponta
                                . " , " . $apont->paradaAponta
                                . " , TO_DATE('" . $apont->dthrAponta . "','DD/MM/YYYY HH24:MI') "
                                . " , SYSDATE "
                                . " )";

                        $this->Create = $this->Conn->prepare($sql);
                        $this->Create->execute();
                    }
                }
                
            }
        }

        return "GRAVOU+id=" . $idBol . "_";
    }

}