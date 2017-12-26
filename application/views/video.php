<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('sidebar', array('video'    => true));
$this->load->view('modal-deletar', array('mensagem'    => "Tem certeza que deseja deletar o video?"));
$this->load->view('toast');
?>

<body>
    <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; } </style>
    <main>
        <section class="row" id="cadastro">
            <div class="row">
                <h3>Vídeos</h3>
                <a class="btn-flat blue-text" id="btnFormVideo">Novo vídeo</a>
            </div>
            <form class="col s12" method="POST" id="formVideo" action="inserir-video">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="nome" type="text" name="nome" class="validate">
                        <label class="active" for="nome">Titulo</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="descricao" type="text" name="descricao" class="validate" required>
                        <label class="active" for="descricao">Vídeo (link)</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s3">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Cadastrar
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>
        </section>

        <section class="row" id="lista">
            <div class="row">
                <?foreach($videos as $video):?>
                <div class="col s12 m4 l3">
                    <div class="card purple lighten-5">
                        <div class="card-content black-text" style="padding:0px">
                            <span class="card-title" style="margin-left:10px; word-wrap: break-word"><?= $video['nome'] ?></span>
                            <div class='embed-container'>
                                <iframe src="https://www.youtube.com/embed/<?= $video['descricao']?>" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="card-action">
                            <a href="#!" class="deletarVideo" data-id="<?=$video['cd']?>">
                                <i class="material-icons small red-text">delete</i>
                            </a>
                            <a href="editar-video/<?=$video['cd']?>">
                                <i class="material-icons small blue-text">refresh</i>
                            </a>
                        </div>
                    </div>
                </div>
                <?endforeach;?>
            </div>
        </section>
    </main>
</body>