<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class HT_Sistema {

    protected $CI;
    public $tema = array();
    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->helper('funcoes');
    }
    public function enviar_email($para, $nome, $email, $telefone, $assunto, $mensagem, $formato = 'html') {
        $this->CI->load->library('email');
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = $formato;        
        $this->CI->email->initialize($config);
        $this->CI->email->from($email, $nome);
        $this->CI->email->to($para);
        $this->CI->email->subject('Contato através do site - '.$assunto);
        $this->CI->email->message("<b>Assunto:</b> ".$assunto."<br/><br/> <b>Mensagem:</b> <br/><br/>". $mensagem ."<br/><br/> <b>Telefone:</b> $telefone <br/><br/> <b>Data de Envio:</b> ".date('d/m/Y')." às ".date('H:i:s'));
        if ($this->CI->email->send()):
            return TRUE;
        else:
            return $this->CI->email->print_debugger();
        endif;
    }

}

/* End of file sistema.php */
/* Location: ./application/libraries/sistema.php */