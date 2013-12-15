<?php

/***********************************************************************
 * File: alert.php
 * Author: PK
 * Date: 30/11/13 23:38
 * 
 * Description: template for alerts
 *
 * Variables:   $type   : type of alert
 *              $msg    : message to display
 *********************************************************************/

?>

<script type="text/javascript">
    $( "#message").html(" <div class='container'><span class='alert alert-<? if($type == "error") : ?>danger<? ELSE: ?><?= $type ?><? ENDIF ?> popup'><strong><?= ucfirst($type) ?>:</strong> <?= $msg ?></span></div>").fadeIn("slow").delay( 3000).fadeOut("slow");
</script>
