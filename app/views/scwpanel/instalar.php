<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
switch ($tela):
	case 'instalar':
		echo '<div class="seven columns centered">';
		echo '<h4 class="text-center">Instalação do Sistema</h4>';
		erros_validacao();
		echo form_open('instalar/instalar_painel', array('class'=>'custom'));
		echo form_fieldset('Configurações gerais');
		echo form_label('URL de instalação (com uma / no final)');
		echo form_input(array('name'=>'url_base', 'class'=>'twelve'), set_value('url_base', str_replace('instalar', '', current_url())), 'autofocus');
		echo form_label('Chave de segurança');
		echo form_input(array('name'=>'chave_seguranca', 'class'=>'six'), set_value('chave_seguranca', md5(time())));
		echo form_label('Tempo da sessão');
		echo form_input(array('name'=>'tempo_sessao', 'class'=>'six'), set_value('tempo_sessao', 3600));		
		echo form_fieldset_close();
		
		echo form_fieldset('Banco de dados');
		echo form_label('Servidor');
		echo form_input(array('name'=>'hostname', 'class'=>'six'), set_value('hostname', 'localhost'));
		echo form_label('Usuário');
		echo form_input(array('name'=>'username', 'class'=>'six'), set_value('username'));
		echo form_label('Senha');
		echo form_input(array('name'=>'password', 'class'=>'six'), set_value('password'));
		echo form_label('Nome do BD');
		echo form_input(array('name'=>'database', 'class'=>'six'), set_value('database'));		
		echo form_fieldset_close();
		
		echo form_fieldset('Usuário administrador');
		echo form_label('Nome completo');
		echo form_input(array('name'=>'user_nome', 'class'=>'nine'), set_value('user_nome'));
		echo form_label('Email');
		echo form_input(array('name'=>'user_email', 'class'=>'nine'), set_value('user_email'));
		echo form_label('Login');
		echo form_input(array('name'=>'user_login', 'class'=>'six'), set_value('user_login'));
		echo form_label('Senha');
		echo form_password(array('name'=>'user_senha', 'class'=>'six'), set_value('user_senha'));		
		echo form_fieldset_close();
		
		echo form_submit(array('name'=>'instalar', 'class'=>'button radius right'), 'Instalar o Sistema');
		echo form_close();
		echo '</div>';
		break;
	case 'sucesso':
		?>
		<div class="seven columns centered" style="margin-top: 50px;">
			<div class="panel">
				<h6>Instalação concluída!</h6>
                                <div class="alert-box alert">
				<p>É altamente recomendável excluir os arquivos de instalação do sistema.</p>
                                <a href="<?php echo base_url('painel/exclui_install') ?>" class="button expand radius primary">Apagar Instalador</a>
                                </div>
				<p>O sistema foi instalado com sucesso, você já pode começar a utilizá-lo agora.</p>
				<a href="<?php echo base_url('usuarios/login') ?>" class="button expand radius success">Fazer login</a>
			</div>
		</div>
		<?php
		break;
	default:
		echo '<div class="alert-box alert"><p>A tela solicitada não existe</p></div>';
		break;
endswitch;