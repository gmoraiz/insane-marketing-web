<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<ul id="slide-out" class="side-nav fixed">
     <li>
        <div class="user-view">
            <div class="background">
                <img width="300px" src="<?php echo base_url() . 'assets/img/salao/' . $this->session->userdata('banner'); ?>">
            </div>
            <a href="#!user"><img class="circle" src="<? echo base_url() . 'assets/img/salao/' . $this->session->userdata('banner') ?>"></a>
            <a href="#!name"><span class="white-text name"><? echo $this->session->userdata('nome') ?></span></a>
            <a href="#!email"><span class="white-text email"><? echo $this->session->userdata('login') ?></span></a>
        </div>
    </li>
    <li <? if(isset($agendamento)) echo 'class="active"'; ?>>
        <a href="<?php echo base_url() ?>agendamentos">
            <i class="material-icons">perm_contact_calendar</i>Agendamentos
        </a>
    </li>
    <li <? if(isset($bonificacao)) echo 'class="active"'; ?>>
        <a href="<?php echo base_url() ?>bonificacoes">
            <i class="material-icons">star</i>Bonificações
        </a>
    </li>
    <li <? if(isset($cronograma)) echo 'class="active"'; ?>>
        <a href="<?php echo base_url() ?>cronograma">
            <i class="material-icons">today</i>Cronograma
        </a>
    </li>
    <li <? if(isset($imagem)) echo 'class="active"'; ?>>
        <a href="<?php echo base_url() ?>imagens">
            <i class="material-icons">image</i>Imagens
        </a>
    </li>
    <li <? if(isset($profissional)) echo 'class="active"'; ?>>
        <a href="<?php echo base_url() ?>profissionais">
            <i class="material-icons">perm_identity</i>Profissionais
        </a>
    </li>
    <li <? if(isset($servico)) echo 'class="active"'; ?>>
        <a href="<?php echo base_url() ?>servicos">
            <i class="material-icons">view_module</i>Serviços
        </a>
    </li>
    <li <? if(isset($video)) echo 'class="active"'; ?>>
        <a href="<?php echo base_url() ?>videos">
            <i class="material-icons">video_library</i>Vídeos
        </a>
    </li>
    <li>
        <div class="divider"></div>
    </li>
    <li>
        <a class="subheader">Opções</a>
    </li>
    <li <? if(isset($salao)) echo 'class="active"'; ?>>
        <a href="<? echo base_url() ?>perfil">
            <i class="material-icons">home</i>Editar salão
        </a>
    </li>
    <li>
        <a href="#">
            <form method="post" id="deslogar" action="deslogar">
                <input type="submit" class="btn btn-link deslogar" value="Deslogar"/>
            </form>
        </a>
    </li>
</ul>