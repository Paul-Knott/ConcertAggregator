<?php

/***********************************************************************
 * File: videoinfo.php
 * Author: PK
 * Date: 30/11/13 18:14
 * 
 * Description: video info and credits template
 *
 * Variables:   $videoinfo["owner"] : Owner of the video
 *********************************************************************/

?>

<span class="prev glyphicon glyphicon-chevron-left pointer"></span>
&nbsp; <b>Recorded By: <? if($videoinfo["owner"]): ?><?= htmlspecialchars($videoinfo["owner"]) ?><? ELSE: ?>Unnamed Channel<? ENDIF ?></b> &nbsp;
<span class="next glyphicon glyphicon-chevron-right pointer"></span>