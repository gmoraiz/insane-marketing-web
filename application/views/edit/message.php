<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/sidebar', array('message' => true));
$this->load->view('templates/toast');
?>
<main class="full-container" id="panel">
    <section class="row" id="menu">
        <h3>Messages</h3>
        <div class="row" id="options">
            <a href="../message" class="btn-flat waves-effect waves-light red white-text darken-4 back"><i class="material-icons left">keyboard_arrow_left</i>Back</a>
        </div>
        <form class="row" method="POST" action="<?= $message->id ?>">
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <input id="title" type="text" name="title" class="validate" value="<?= $message->title ?>" required></textarea>
                    <label for="title">Title</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <textarea id="description" name="description" class="materialize-textarea" required><?= $message->description ?></textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col xl5 l10 s12">
                    <select name="type" id="type">
                        <option value="" disabled selected>Choose...</option>
                        <option value="ANUALLY"  <?php if($message->type == 'ANUALLY')  echo 'selected';?> >ANUALLY</option>
                        <option value="BIRTHDAY" <?php if($message->type == 'BIRTHDAY') echo 'selected';?> >BIRTHDAY</option>
                        <option value="DAILY"    <?php if($message->type == 'DAILY')    echo 'selected';?> >DAILY</option>
                        <option value="MONTHLY"  <?php if($message->type == 'MONTHLY')  echo 'selected';?> >MONTHLY</option>
                        <option value="SPECIFIC" <?php if($message->type == 'SPECIFIC') echo 'selected';?> >SPECIFIC</option>
                        <option value="WEEKLY"   <?php if($message->type == 'WEEKLY')   echo 'selected';?> >WEEKLY</option>
                    </select>                        
                    <label>Type</label>
                </div>
            </div>
            <div class="row hide" id="pickDay">
                <div class="range-field col xl5 l10 s12">
                    <input type="range" name="day" id="day" min="1" max="31" />
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
                    <input class='validate' type='text' name='dayMonth' id='dayMonth'  placeholder="dd/mm" pattern="[0-3]{1}[0-9]{1}/[0-1]{1}[0-9]{1}"/>
                    <label for='dayMonth'>Date</label>
                </div>
            </div>
            <div class="row hide" id="pickWeek">
                <div class="input-field col xl5 l10 s12">
                    <select name="week">
                        <option value="SUNDAY">SUNDAY</option>
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
            <?php if($message->type == 'MONTHLY'): ?>
                <script>
                $('#pickDay').removeClass('hide');
                $('#day').val(<?= json_encode($message->period) ?>);
                </script>
            <?php elseif($message->type == 'SPECIFIC'): ?>
                <script>
                    $('#pickDate').removeClass('hide');
                    $('#date').val(<?= json_encode($message->period) ?>);
                </script>
            <?php elseif($message->type == 'ANUALLY'): ?>
                <script>
                $('#pickDayMonth').removeClass('hide');
                $('#dayMonth').val(<?= json_encode($message->period) ?>);
                </script>
            <?php elseif($message->type == 'WEEKLY'): ?>
                <script>
                    $('#pickWeek').removeClass('hide');
                    $('#week').val(<?= json_encode($message->period) ?>);
                </script>
            <?php endif; ?>
            <div class="row">
                <div class="input-field col s12">
                    <input type="checkbox" name="activated" class="filled-in" id="activated" <?php if($message->activated) echo 'checked' ?>/>
                    <label for="activated">Activated</label>
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

<!-- GET JS OF THIS PAGE -->
<script src="<?= base_url() ?>assets/js/message.js?<?php echo rand() ?>"></script>