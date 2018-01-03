<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/sidebar', array('reward' => true));
$this->load->view('templates/toast');
?>
<main class="full-container" id="panel">
    <section class="row" id="menu">
        <h3>Rewards</h3>
        <div class="row" id="options">
            <a href="../reward" class="btn-flat waves-effect waves-light red white-text darken-4 back"><i class="material-icons left">keyboard_arrow_left</i>Back</a>
        </div>
        <form class="row" method="POST" action="<?= $reward->id ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <textarea id="description" name="description" class="materialize-textarea" required><?= $reward->description ?></textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            <?php if($this->session->userdata('company')->type_fidelity == 'POUNDS'):?>
                <div class="row">
                    <div class="input-field col xl5 l10 s12">
                        <input class='validate money-input' type='text' name='required' id='pounds' value="<?= $reward->required ?>" required/>
                        <label for='pounds'>Pounds</label>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($this->session->userdata('company')->type_fidelity == 'POINTS'):?>
                <div class="row">
                    <div class="input-field col xl5 l10 s12">
                        <select name="required">
                            <option value="" disabled selected>Choose...</option>
                            <option value="2"  <?php if($reward->required == 2)  echo 'selected';?> >2</option>
                            <option value="4"  <?php if($reward->required == 4)  echo 'selected';?> >4</option>
                            <option value="6"  <?php if($reward->required == 6)  echo 'selected';?> >6</option>
                            <option value="8"  <?php if($reward->required == 8)  echo 'selected';?> >8</option>
                            <option value="10" <?php if($reward->required == 10) echo 'selected';?> >10</option>
                            <option value="12" <?php if($reward->required == 12) echo 'selected';?> >12</option>
                            <option value="24" <?php if($reward->required == 24) echo 'selected';?> >24</option>
                        </select>
                        <label>Points</label>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="file-field input-field col xl5 l9 s12">
                    <div class="btn border white grey-text text-darken-4">
                        <span>Picture</span>
                        <input type="file" name="picture">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" value="Choose to update picture...">
                    </div>
                </div>
                <?php if($reward->picture): ?>
                    <div class="col xl2 l3 s12">
                        <span class="red-text text-darken-4">Current picture</span>
                        <img src="../assets/img/reward/<?= $reward->picture?>" width="140px" class="materialboxed responsive-img">
                    </div>
                    <div class="col s12 current-picture-remove">
                        <input type="checkbox" name="no-picture" class="filled-in" id="remove-picture" />
                        <label for="remove-picture">No picture</label>
                    </div>
                <?php endif; ?>
                
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