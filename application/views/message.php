<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/sidebar', array('message' => true));
$this->load->view('templates/delete-dialog', array('description' => "Are you sure want to delete this message?"));
$this->load->view('templates/toast');
?>
<main class="full-container" id="panel">
    <section class="row" id="menu">
        <h3>Messages</h3>
        <div class="row" id="options">
            <a class="btn-flat waves-effect waves-light red white-text darken-4 dynamic-form-trigger">New</a>
        </div>
        <form class="row dynamic-form" method="POST" action="message" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <input id="title" type="text" name="title" class="validate" required></textarea>
                    <label for="title">Title</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <textarea id="description" name="description" class="materialize-textarea validate" required></textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <select name="type" id="type">
                        <option value="" disabled selected>Choose...</option>
                        <option value="ANUALLY">ANUALLY</option>
                        <option value="BIRTHDAY">BIRTHDAY</option>
                        <option value="DAILY">DAILY</option>
                        <option value="MONTHLY">MONTHLY</option>
                        <option value="SPECIFIC">SPECIFIC</option>
                        <option value="WEEKLY">WEEKLY</option>
                    </select>                        
                    <label>Type</label>
                </div>
            </div>
            <div class="row hide" id="pickDay">
                <div class="range-field col xl5 l10 s12">
                  <input type="range" name="day" value="1" id="day" min="1" max="31" />
                  <label for='day'>Day</label>
                </div>
            </div>
            <div class="row hide" id="pickDate">
                <div class="input-field col xl5 l10 s12">
                    <input class='validate datepicker' type='text' name='date' id='date'/>
                    <label for='date'>Date</label>
                </div>
            </div>
            <div class="row hide" id="pickDayMonth">
                <div class="input-field col xl5 l10 s12">
                    <input class='validate' type='text' name='dayMonth' id='dayMonth' placeholder="dd/mm" pattern="[0-3]{1}[0-9]{1}/[0-1]{1}[0-9]{1}"/>
                    <label for='dayMonth'>Date</label>
                </div>
            </div>
            <div class="row hide" id="pickWeek">
                <div class="input-field col xl5 l10 s12">
                    <select name="week">
                        <option value="SUNDAY" selected>SUNDAY</option>
                        <option value="MONDAY">MONDAY</option>
                        <option value="TUESDAY">TUESDAY</option>
                        <option value="WEDNESDAY">WEDNESDAY</option>
                        <option value="THURSDAY">THURSDAY</option>
                        <option value="FRIDAY">FRIDAY</option>
                        <option value="SATURDAY">SATURDAY</option>
                    </select>                        
                    <label>Week's day</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="checkbox" name="activated" class="filled-in" id="activated" checked/>
                    <label for="activated">Activated</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <button class="btn waves-effect waves-light grey darken-4" type="submit" name="action">Confirm
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </section>
    
    <section class="row" id="list">
        <?php if(empty($messages)): ?>
            <p>You haven't any message.</p>
        <?php else: ?>
            <ul class="collection">
                <?php $this->load->view('lists/message') ?>
            </ul>
        <?php endif; ?>
        <?php $this->load->view('templates/loading-pagination') ?>
    </section>
    
</main>

<!-- GET JS OF THIS PAGE -->
<script src="<?php echo base_url()?>assets/js/message.js?<?php echo rand() ?>"></script>