<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class M_usuario extends CI_Model {
    public function inserir($usuario, $senha, $nome, $tipo_usuario){
        //Query de inserção dos dados

        $this->db->query("insert into usuario(usuario, senha, nome, tipo)
                        values('$usuario', md5('$senha'), '$nome', '$tipo_usuario')");

        // Verifica se a inserção ocorreu com sucesso
        
        if($this->db->affected_rows() > 0) {
            $dados = array('codigo' => 1,
                           'msg' => 'Usuário cadastrado corretamente');
        } 
        
        else {
            $dados = array ('codigo' => 6,
                            'msg' => 'Houve algum problema na inserção na tabela de usuário');
        }

        //Envia o arry $dados com as informações tratadas acima pela estrutura de decisão if
        
        return $dados;
    
    }





    public function consultar($usuario, $nome, $tipo_usuario){
        //---------------------------------------------
        //Função que servirá para quatro tipos de consulta:
        // * Para todos os usuarios;
        // * Para um determinado usuarios;
        // * Para um tipo de usuarios;
        // * Para nome de usuarios;

        
        // Query para consultar dados de acordo com parametros passados
        $sql = "select * from usuarios where estatus = ''";
        
        if($usuario != '') {
            $sql = $sql . "and usuario = '$usuario'";
        } 

        if($tipo_usuario != '') {
            $sql = $sql . "and tipo = '$tipo_usuario'";
        } 

        if($nome != '') {
            $sql = $sql . "and nome like = '%$nome%' ";
        } 

        $retorno = $this->db->query($sql);

        // Verificar se a consulta ocorreu com sucesso

        if($retorno->num_rows() > 0) {
            $dados = array('codigo' => 1,
                           'msg' => 'Consulta efetuada com sucesso',
                            'dados' => $retorno -> result());
        } 
        
        else {
            $dados = array ('codigo' => 6,
                            'msg' => 'Dados não encontrados');
        }

        //Envia o arry $dados com as informações tratadas acima pela estrutura de decisão if
        
        return $dados;
    
    }





    public function alterar($usuario, $nome, $senha, $tipo_usuario){
        //Query de alteração dos dados

        $this->db->query("update usuarios set nome = '$nome', senha = md5('$senha'), nome = '$nome', tipo = '$tipo_usuario'
                        where usuario = '$usuario'");

        // Verifica se a inserção ocorreu com sucesso
        
        if($this->db->affected_rows() > 0) {
            $dados = array('codigo' => 1,
                           'msg' => 'Usuário atualizado corretamente');
        } 
        
        else {
            $dados = array ('codigo' => 6,
                            'msg' => 'Houve algum problema na atualização na tabela de usuário');
        }

        //Envia o arry $dados com as informações tratadas acima pela estrutura de decisão if
        
        return $dados;
    
    }





    public function desativar($usuario){
        //Query de atualização dos dados

        $this->db->query("update usuarios set estatus = 'D'
                        where usuario = '$usuario'");

        // Verifica se a inserção ocorreu com sucesso
        
        if($this->db->affected_rows() > 0) {
            $dados = array('codigo' => 1,
                           'msg' => 'Usuário DESATIVADO corretamente');
        } 
        
        else {
            $dados = array ('codigo' => 6,
                            'msg' => 'Houve algum problema na DESATIVAÇÃO na tabela de usuário');
        }

        //Envia o arry $dados com as informações tratadas acima pela estrutura de decisão if
        
        return $dados;
    
    }

}

?>
