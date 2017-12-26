<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
  $(function(){
        let msg = <?php echo json_encode($this->session->flashdata('MSG')); ?>;
        if(msg)
            Materialize.toast(msg, 4000);
    });
</script>