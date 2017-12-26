<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('sidebar', array('imagem'    => true));
$this->load->view('modal-deletar', array('mensagem'    => "Tem certeza que deseja deletar a imagem?"));
$this->load->view('toast');
?>

<body>
    <main>
        <section class="row" id="cadastro">
            <div class="row">
                <h3>Imagens</h3>
                <a class="btn-flat blue-text" id="btnFormImagem">Nova imagem</a>
            </div>
            <form class="col s12" method="POST" id="formImagem" action="inserir-imagem" enctype="multipart/form-data">
                <div class="row">
                    <div class="file-field input-field col s12">
                        <div class="btn">
                            <span>Imagens do salão</span>
                            <input type="file" multiple name="imagens[]">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Você pode selecionar multiplas imagens">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s3">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Confirmar
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>
        </section>

        <section class="row" id="lista">
                <?foreach($imagens as $imagem):?>
                <figure class="col s3" style="position:relative">
                    <img width="300px" class="materialboxed" src="<?php echo base_url() ?>assets/img/salao/<?= $imagem['descricao']?>">
                    <a href="#!"  title="Excluir" style="position:absolute; top:0" class="deletarImagem" data-id="<?=$imagem['cd']?>">
                        <i class="material-icons medium red-text">delete</i>
                    </a>
                </figure>
                <?endforeach;?>
        </section>
    </main>
</body>          