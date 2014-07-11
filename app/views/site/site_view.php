<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="<?php echo get_setting('descricao_site'); ?>" />
        <meta name="abstract" content="<?php echo get_setting('descricao_curta'); ?>" />
        <meta name="keywords" content="<?php echo get_setting('keywords_site'); ?>" />
        <meta name="robot" content="all" />
        <title><?php if(isset($titulo)): ?>{titulo} | <?php endif; ?>{titulo_padrao}</title>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/favicon.ico">
        {headerinc}
    </head>
    <body>
        <!-- Inicio do body -->
        <img src="<?php echo base_url('assets/img/bg.gif'); ?>" class="fundoFakeBody" />
        <div class="fakeBody">
            <nav class="top-bar" data-topbar>
                <div class="small-12 medium-10 columns medium-offset-1">
                    <ul class="title-area">
                        <li class="name"><h1><a href="<?php echo base_url(); ?>"><img src="<?php echo get_setting('url_logomarca'); ?>" alt="logo-passeio-em-miami" title="Logo Passeio em Miami" /></a></h1></li>
                        <!-- Mobile Menu Toggle -->
                        <li class="toggle-topbar menu-icon"><a href="#"><i class="fi-list-bullet large"></i></a></li>
                    </ul>
                    <!-- menu top-bar  -->
                    
                    <dl class="sub-nav medium-8 right subnav-lineheight">
                        <?php 
                        $paginas = $this->pagina->get_all()->result();
                        if ($paginas != null):
                        echo '<dl class="sub-nav medium-8 right subnav-lineheight">';                        
                        foreach ($paginas as $prod) {
                        ?>
                        <dd <?php echo ($this->uri->segment('3') == $prod->slug) ? ' class="active"' : ""; ?>><?php echo anchor('site/pagina/'.$prod->slug, $prod->titulo); ?></dd>
                        <?php
                            }
                            endif;
                        ?>
                        <dd <?php echo ($this->uri->segment('2') == "depoimentos") ? ' class="active"' : ""; ?>><?php echo anchor('site/depoimentos', 'Depoimentos'); ?></dd>
                    </dl>
                </div>
            </nav>
            <div class="row shadow painel">
                {conteudo}
                <span class="clearfix"></span>
                <hr class="shadow" />
                <div class="small-12 medium-12">
                    <div class="small-12 medium-6 columns">
                        <div class="panel small-12 columns bordas-radius">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d114964.60398683863!2d-80.23108009999999!3d25.782323950000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d9b0a20ec8c111%3A0xff96f271ddad4f65!2sMiami%2C+Florida!5e0!3m2!1spt-BR!2sbr!4v1403466622754" width="100%" height="303" frameborder="0" style="border:0"></iframe>
                        </div>
                    </div>
                    <div class="small-12 medium-6 columns">
                        <div class="panel small-12 columns bordas-radius">
                            <h4>Deixe aqui o seu depoimento.</h4>
                            <?php 
                            	if($this->uri->uri_string() != 'site/contato_sucesso' || $this->uri->uri_string() != 'site/contato_erro'){
                            		get_msg('msgok');	get_msg('msgerro');
                            	}
                            ?>
                            <form method="post" action="site/send_depo">
                                <input type="text" name="nome" placeholder="Seu nome" />
                                <textarea rows="6" name="depoimento" placeholder="Exemplo: Gostei muito do seviço, devido a atenção empregada a minha familia."></textarea>
                                <input type="hidden" name="data" value="<?php echo date('Y-m-d H:i:s')?>" />
                                <input type="submit" name="enviar" value="Enviar" class="button expand success contato radius"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="small-12 columns sub-footer-bar text-center shadow">
                {rodape}
            </footer>
        </div>
        <!-- Fim do body -->
        {footerinc}
        <script>
            $(document).foundation();
        </script>
    </body>
</html>