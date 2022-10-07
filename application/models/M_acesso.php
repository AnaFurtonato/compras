<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class M_acesso extends CI_Model {
    public function validalogin($usuario, $senha) {
        // Atributo retorno recebe o resultado do SELECT
        // realizado na tabela de usuários lembrando da funcao MD5()
        // por causa da criptografia

        $retorno = $this->db->query("select * from usuarios
                                     where usuario ='$usuario'
                                      and senha = md5('$senha')
                                      and estatus = '' ");

        // Verifica se a quantidade de linhas trazidas na consulta pe superior a 0,
        // isso quer dizer que foi enciontrado o usuario e senha passados pela Controller


        // Criando um array co dois eleementos para retorno do resultado 
        // 1 - Codigo da mensagem
        // 2 - Descricao da mensagem

        if($retorno->num_rows() > 0) {
            $dados = array('codigo' => 1,
                           'msg' => 'Usuário correto');
        } 
        
        else {
            $dados = array ('codigo' => 4,
                            'msg' => 'Usuário ou senha inválidos');
        }

        //Envia o arry $dados com as informações tratadas acima pela estrutura de decisão if
        
        return $dados;
    
    }
}



?>
