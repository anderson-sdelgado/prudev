<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/BoletimDAO.class.php');
require_once('../model/dao/ApontDAO.class.php');
require_once('../model/dao/AlocaFuncDAO.class.php');
/**
 * Description of RuricolaCTR
 *
 * @author anderson
 */
class RuricolaCTR {
    //put your code here

    public function salvarDados($info) {

        $dados = $info['dado'];

        $pos1 = strpos($dados, "_") + 1;
        $pos2 = strpos($dados, "|") + 1;

        $bol = substr($dados, 0, ($pos1 - 1));
        $apont = substr($dados, $pos1, (($pos2 - 1) - $pos1));
        $alocFunc = substr($dados, $pos2);

        $jsonObjBoletim = json_decode($bol);
        $jsonObjAponta = json_decode($apont);
        $jsonObjAlocaFunc = json_decode($alocFunc);

        $dadosBoletim = $jsonObjBoletim->boletim;
        $dadosAponta = $jsonObjAponta->aponta;
        $dadosAlocaFunc = $jsonObjAlocaFunc->alocafunc;

        $ret = $this->salvarBolFechado($dadosBoletim, $dadosAponta, $dadosAlocaFunc);

        return $ret;
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////

    private function salvarBolFechado($dadosBoletim, $dadosAponta, $dadosAlocaFunc) {
        $boletimDAO = new BoletimDAO();
        $idBoletimArray = array();
        foreach ($dadosBoletim as $bol) {
            $v = $boletimDAO->verifBoletim($bol);
            if ($v == 0) {
                $boletimDAO->insBoletim($bol);
            }
            $idBol = $boletimDAO->idBoletim($bol);
            $this->salvarApont($idBol, $bol->idBol, $dadosAponta);
            $this->salvarAlocFunc($idBol, $bol->idBol, $dadosAlocaFunc);
            $idBoletimArray[] = array("idBol" => $bol->idBol);
        }
        $dadoBol = array("boletim"=>$idBoletimArray);
        $retBol = json_encode($dadoBol);
        return 'GRAVOU-RURICOLA_' . $retBol;
    }

    private function salvarApont($idBolBD, $idBolCel, $dadosAponta) {
        $apontDAO = new ApontDAO();
        foreach ($dadosAponta as $apont) {
            if ($idBolCel == $apont->idBolApont) {
                $v = $apontDAO->verifApont($idBolBD, $apont);
                if ($v == 0) {
                    $apontDAO->insApont($idBolBD, $apont);
                }
            }
        }
    }

    private function salvarAlocFunc($idBolBD, $idBolCel, $dadosAlocaFunc) {
        $alocaFuncDAO = new AlocaFuncDAO();
        foreach ($dadosAlocaFunc as $alocaFunc) {
            if ($idBolCel == $alocaFunc->idBolAlocaFunc) {
                $v = $alocaFuncDAO->verifAlocaFunc($idBolBD, $alocaFunc);
                if ($v == 0) {
                    $alocaFuncDAO->insAlocaFunc($idBolBD, $alocaFunc);
                }
            }
        }
    }
    
}
