<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

class Midia_model extends CI_Model {

    public function do_insert($dados = NULL, $redir = TRUE) {
        if ($dados != NULL):
            $this->db->insert('midia', $dados);
            if ($this->db->affected_rows() > 0):
                auditoria('Inclusão de mídia', 'Nova mídia cadastrada no sistema');
                set_msg('msgok', 'Cadastro efetuado com sucesso', 'sucesso');
            else:
                set_msg('msgerro', 'Erro ao inserir dados', 'erro');
            endif;
            if ($redir)
                redirect(current_url());
        endif;
    }
    
    public function do_insert_gal($dados = NULL, $redir = TRUE) {
        if ($dados != NULL):
            $this->db->insert('galerias', $dados);
            if ($this->db->affected_rows() > 0):
                auditoria('Inclusão de Galeria', 'Nova galeria cadastrada no sistema');
                set_msg('msgok', 'Cadastro efetuado com sucesso', 'sucesso');
            else:
                set_msg('msgerro', 'Erro ao inserir a galeria', 'erro');
            endif;
            if ($redir)
                redirect(current_url());
        endif;
    }

    public function do_update($dados = NULL, $condicao = NULL, $redir = TRUE) {
        if ($dados != NULL && is_array($condicao)):
            $this->db->update('midia', $dados, $condicao);
            if ($this->db->affected_rows() > 0):
                auditoria('Alteração de mídia', 'A mídia com o id "' . $condicao['id'] . '" foi alterada');
                set_msg('msgok', 'Alteração efetuada com sucesso', 'sucesso');
            else:
                set_msg('msgerro', 'Erro ao atualizar dados', 'erro');
            endif;
            if ($redir)
                redirect(current_url());
        endif;
    }
    public function do_update_gal($dados = NULL, $condicao = NULL, $redir = TRUE) {
        if ($dados != NULL && is_array($condicao)):
            $this->db->update('galerias', $dados, $condicao);
            if ($this->db->affected_rows() > 0):
                auditoria('Alteração de Galeria', 'A galeria com o id "' . $condicao['id'] . '" foi alterada');
                set_msg('msgok', 'Alteração efetuada com sucesso', 'sucesso');
            else:
                set_msg('msgerro', 'Erro ao atualizar dados', 'erro');
            endif;
            if ($redir)
                redirect(current_url());
        endif;
    }

    public function do_delete($condicao = NULL, $redir = TRUE) {
        if ($condicao != NULL && is_array($condicao)):
            $this->db->delete('midia', $condicao);
            if ($this->db->affected_rows() > 0):
                auditoria('Exclusão de mídia', 'A mídia com o id "' . $condicao['id'] . '" foi excluída');
                set_msg('msgok', 'Registro excluído com sucesso', 'sucesso');
            else:
                set_msg('msgerro', 'Erro ao excluir registro', 'erro');
            endif;
            if ($redir)
                redirect(current_url());
        endif;
    }
    public function do_delete_gal($condicao = NULL, $redir = TRUE) {
        if ($condicao != NULL && is_array($condicao)):
            $this->db->delete('galerias', $condicao);
            if ($this->db->affected_rows() > 0):
                auditoria('Exclusão de Galeria', 'A galeria com o id "' . $condicao['id'] . '" foi excluída');
                set_msg('msgok', 'Registro excluído com sucesso', 'sucesso');
            else:
                set_msg('msgerro', 'Erro ao excluir registro', 'erro');
            endif;
            if ($redir)
                redirect(current_url());
        endif;
    }

    public function do_upload($campo, $caminho) {
        $this->load->library('upload');
        if(!file_exists($caminho)){
            mkdir($caminho, DIR_WRITE_MODE, true);
        }
        $config['upload_path']    = $caminho;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']          = '5000';
        $config['encrypt_name']  = TRUE;        
        $this->upload->initialize($config);
        if ($this->upload->do_upload($campo)):
            return $this->upload->data();
        else:
            return $this->upload->display_errors();
        endif;
    }

    public function get_all() {
        return $this->db->get('midia');
    }
    public function get_banner() {
        $this->db->where('tipo', 'B');
        $this->db->order_by('id', 'desc');
        $this->db->limit(20);
        return $this->db->get('midia');
    }

    public function get_byid($id = NULL) {
        if ($id != NULL):
            $this->db->where('id', $id);
            $this->db->limit(1);
            return $this->db->get('midia');
        else:
            return FALSE;
        endif;
    }
    public function get_byid_gal($id = NULL) {
        if ($id != NULL):
            $this->db->where('idgaleria', $id);
            $this->db->limit(1);
            return $this->db->get('midia');
        else:
            return FALSE;
        endif;
    }
    
    public function get_gal_all() {
        return $this->db->get('galerias');
    }
    public function get_gal_byid($id = NULL) {
        if ($id != NULL):
            $this->db->where('id', $id);
            $this->db->limit(1);
            return $this->db->get('galerias');
        else:
            return FALSE;
        endif;
    }
    public function get_gal_img($slug) {
        if ($slug != NULL):
            $this->db->select('*');
            $this->db->from('midia mid');
            $this->db->join('galerias gal', 'gal.id = mid.idgaleria');
            $this->db->join('paginas pag', "pag.id = gal.idpagina AND pag.slug LIKE '%$slug%'");
            return $this->db->get();
        else:
            return FALSE;
        endif;
    }
}

/* End of file midia_model.php */
/* Location: ./application/models/midia_model.php */