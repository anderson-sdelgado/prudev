<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/AtivDAO.class.php');
require_once('../model/dao/AmostraFitoDAO.class.php');
require_once('../model/dao/CaracOrganFitoDAO.class.php');
require_once('../model/dao/EquipDAO.class.php');
require_once('../model/dao/FuncDAO.class.php');
require_once('../model/dao/LiderDAO.class.php');
require_once('../model/dao/OSDAO.class.php');
require_once('../model/dao/OrganFitoDAO.class.php');
require_once('../model/dao/ParadaDAO.class.php');
require_once('../model/dao/RFuncaoAtivParDAO.class.php');
require_once('../model/dao/ROCAFitoDAO.class.php');
require_once('../model/dao/ROSAtivDAO.class.php');
require_once('../model/dao/TalhaoDAO.class.php');
require_once('../model/dao/TipoApontDAO.class.php');
require_once('../model/dao/TurmaDAO.class.php');
/**
 * Description of BaseDadosCTR
 *
 * @author anderson
 */
class BaseDadosCTR {
    
    public function dadosAmostraFito($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        $amostraFitoDAO = new AmostraFitoDAO();
        
        if($versao >= 2.00){
        
            $dados = array("dados"=>$amostraFitoDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosAtiv($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        $ativDAO = new AtivDAO();
        
        if($versao >= 2.00){

            $dados = array("dados"=>$ativDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosCaracOrganFito($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        $caracOrganFitoDAO = new CaracOrganFitoDAO();
        
        if($versao >= 2.00){
       
            $dados = array("dados"=>$caracOrganFitoDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosEquip($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        $equipDAO = new EquipDAO();
        
        if($versao >= 2.00){
       
            $dados = array("dados"=>$equipDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }

    public function dadosFunc($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        $funcDAO = new FuncDAO();
        
        if($versao >= 2.00){
        
            $dados = array("dados"=>$funcDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosLider($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        $liderDAO = new LiderDAO();
        
        if($versao >= 2.00){

            $dados = array("dados"=>$liderDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    
    public function dadosOS($versao, $info) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 2.00){
        
            $osDAO = new OSDAO();
            $rOSAtivDAO = new ROSAtivDAO();

            $dado = $info['dado'];

            $dadosOS = array("dados" => $osDAO->dados($dado));
            $resOS = json_encode($dadosOS);

            $dadosROSAtiv = array("dados" => $rOSAtivDAO->dados($dado));
            $resROSAtiv = json_encode($dadosROSAtiv);

            return $resOS . "#" . $resROSAtiv;
        
        }
        
    }
    
    public function dadosOrganFito($versao) {

        $versao = str_replace("_", ".", $versao);
        
        $organFitoDAO = new OrganFitoDAO();
        
        if($versao >= 2.00){
        
            $dados = array("dados" => $organFitoDAO->dados());
            $resOS = json_encode($dados);
            return $resOS;
        
        }
                
    }
    
    public function dadosParada($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        $paradaDAO = new ParadaDAO();
        
        if($versao >= 2.00){
        
            $dados = array("dados"=>$paradaDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
     public function dadosRFuncaoAtivPar($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        $rFuncaoAtivParDAO = new RFuncaoAtivParDAO();
        
        if($versao >= 2.00){
        
            $dados = array("dados"=>$rFuncaoAtivParDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosROSAtiv($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        $rOSAtivDAO = new ROSAtivDAO();

        if($versao >= 2.00){
        
            $dados = array("dados"=>$rOSAtivDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;

        }
        
    }
    
    public function dadosROCAFito($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        $rOCAFitoDAO = new ROCAFitoDAO();

        if($versao >= 2.00){

            $dados = array("dados"=>$rOCAFitoDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosTalhao($versao) {
      
        $versao = str_replace("_", ".", $versao);
        
        $talhaoDAO = new TalhaoDAO();

        if($versao >= 2.00){
        
            $dados = array("dados"=>$talhaoDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosTipoApont($versao) {
      
        $versao = str_replace("_", ".", $versao);
        
        $tipoApontDAO = new TipoApontDAO();
        
        if($versao >= 2.00){
        
            $dados = array("dados"=>$tipoApontDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosTurma($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        $turmaDAO = new TurmaDAO();
        
        if($versao >= 2.00){

            $dados = array("dados"=>$turmaDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
}
