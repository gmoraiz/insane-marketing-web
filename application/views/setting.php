<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/sidebar', array('setting' => true));
$this->load->view('templates/toast');
?>
<main class="full-container" id="panel">
    <section class="row" id="menu">
        <h3>Settings</h3>
        <div class="row" id="options">
        </div>
        <form class="row" method="POST" action="" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col xl4 l10 s12">
                    <input class='validate' type='text' name='name' id='name' value="<?= $administrator->name ?>" required/>
                    <label for='name'>Name</label>
                </div>
                <div class="input-field col xl4 l10 s12">
                    <input class='validate' type='text' name='owner' id='owner' value="<?= $administrator->owner ?>" required/>
                    <label for='owner'>Owner</label>
                </div>
                 <div class="input-field col xl4 l10 s12">
                    <input class='validate' type='email' name='email' id='email' value="<?= $administrator->email ?>" required/>
                    <label for='email'>Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col xl4 l10 s12">
                    <input class='validate' type='text' name='username' id='username' value="<?= $administrator->username ?>" required/>
                    <label for='username'>Username</label>
                </div>
                <div class="input-field col xl4 l10 s12">
                    <input class='validate' type='password' name='password' id='password' value=""/>
                    <label for='password'>New password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col xl8 l10 s12">
                    <input class='validate' type='text' name='address' id='address' value="<?= $administrator->address ?>" required/>
                    <label for='address'>Address</label>
                </div>
            </div>
            <div class="row row-with-image">
                <div class="input-field col xl4 l10 s12">
                    <textarea id="rule" name="rule" class="materialize-textarea"><?= $administrator->rule ?></textarea>
                    <label for="rule">Rule (Optional)</label>
                </div>
                <div class="file-field input-field col xl5 l9 s12">
                    <div class="btn border white grey-text text-darken-4">
                        <span>Picture</span>
                        <input type="file" name="picture">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" value="Choose to update picture...">
                    </div>
                </div>
                <?php if($administrator->picture): ?>
                    <div class="col xl2 l3 s12">
                        <span class="red-text text-darken-4">Current picture</span>
                        <img src="../assets/img/company/<?= $administrator->picture?>" width="80px" class="materialboxed responsive-img">
                    </div>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class='input-field col s12'>
                    <p class="grey-text text-darken-4">Change type fidelity:</p>
                    <input name="type_fidelity" type="radio" id="pounds" value="POUNDS" <?php if($administrator->type_fidelity == 'POUNDS'): ?>checked<?php endif; ?> required />
                    <label for="pounds">Pounds</label>
                
                    <input name="type_fidelity" type="radio" id="points" value="POINTS" <?php if($administrator->type_fidelity == 'POINTS'): ?>checked<?php endif; ?> required/>
                    <label for="points">Points</label>
                </div>
            </div>
            <div class="row">
                <div class='input-field col s12'>
                    <p class="grey-text text-darken-4">Change your layout:</p>
                    
                    <input name="layout" type="radio" id="layout1" value="ONE" <?php if($administrator->layout == 'ONE'): ?>checked<?php endif; ?>/>
                    <label for="layout1"><img width="300px" class="responsive-img" src="assets/img/template.png" alt="Template" required/></label>
                    
                    <input name="layout" type="radio" id="layout2" value="TWO" <?php if($administrator->layout == 'TWO'): ?>checked<?php endif; ?>/>
                    <label for="layout2"><img width="300px" class="responsive-img" src="assets/img/template.png" alt="Template" required/></label>
                    
                    <input name="layout" type="radio" id="layout3" value="THREE" <?php if($administrator->layout == 'THREE'): ?>checked<?php endif; ?>/>
                    <label for="layout3"><img width="300px" class="responsive-img" src="assets/img/template.png" alt="Template" required/></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <button class="btn waves-effect waves-light grey darken-4" type="submit" name="action">Edit
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </section>
    
</main>