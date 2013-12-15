<?php

/***********************************************************************
 * File: concert.php
 * Author: PK
 * Date: 26/11/13 08:21
 * 
 * Description: template for concert playlist in sidebar
 *
 * Variables:   $concert["id"]                       : Unique ID of Concert
 *              $concert["name"]                     : Name of Concert
 *              count($concert["videos"])            : Number of Videos
 *              $concert["date"]->format("jS M Y")   : Date of Concert
 *              $concert["isFav"]                    : true/false if it is favorited videos list
 *
 *              $video["id"]                         : Youtube ID of video
 *              $video["name"]                       : name of video
 *              $video["isFav"]                      : true/false if favorited video
 *              $video["Thumbnail"]                  : url of video thumbnail
 *              $video["date"]->format("jS M Y")     : date of video
 *********************************************************************/

?>
<ul id="concert<?= $concert["id"] ?>" class="concert">
    <li class="list-group">
        <a href="#" class="concertlink list-group-item">
            <div class="row">
                <div class="col-xs-10 nowrap">
                    <b><?= htmlspecialchars($concert["name"]) ?></b> (<?= count($concert["videos"]) ?>)<br />
                    <small>
                    <? if(is_object($concert["date"])): ?><?= $concert["date"]->format("jS M Y") ?><? ENDIF ?>
                    <? if($concert["isFav"]): ?><?= $concert["description"]; ?><? ENDIF ?>
                    &nbsp;</small>
                </div>
                <div class="col-xs-2">
                    <? if($concert["isFav"]): ?><span class="glyphicon glyphicon-refresh"></span><? ELSE: ?><span class="caret"></span><? ENDIF ?>
                </div>
            </div>
        </a>
        <ul class="videos">

<?  foreach($concert["videos"] as $video): ?>

                <li class="submenu">
                    <a href="#" id="<?= $video["id"] ?>" class="video list-group-item text-center">
                        <div style="background-size:250px 188px; background: url('<?= htmlspecialchars($video["thumbnail"]) ?>') no-repeat center;" class="img-thumbnail">
                        </div><br />
                        <b><?= htmlspecialchars($video["name"]) ?></b><br />
                        <small>
                            <? if(is_object($video["date"])): ?><?= $video["date"]->format("jS M Y") ?><? ENDIF ?>
                            <? if($concert["isFav"]): ?><?= htmlspecialchars($video["artist"]); ?><? ENDIF ?>
                        </small>
                    </a>

                    <? if(isset($video["isFav"])): ?>
                        <div vid="<?= $video["id"] ?>" class="fav">
                            <span class="glyphicon <? if($video["isFav"]): ?>glyphicon-star<? ELSE: ?>glyphicon-star-empty<? ENDIF ?>"></span>
                        </div>
                    <? ENDIF ?>

                </li>

<? ENDFOREACH ?>

        </ul>
    </li>

    <? // JS Collapsable Navigation ?>
    <script type="text/javascript">
        $('#concert<?= $concert["id"] ?>').navgoco({
            caret: '',
            onClickBefore: function(e, submenu) {
                if($(this).hasClass("video"))
                {
                    e.preventDefault();
                    playVideo($(this).attr("id"));
                }
                $(".search").finish();
            }
        });

        <? if($concert["isFav"]): ?>

        $(".videos").sortable({
            containment: "#playlist",
            connectwith: ".fav",
            update: function() {
                var neworder = [];
                $(".video").each(function() {
                    neworder.push($(this).attr('id'));
                });

                if(thisVideo != null) {
                    playVideo(thisVideo);
                }

                $.post("ajax/sortfavorites.php",{ vids : neworder });

            }
        });

        <? ENDIF ?>

    </script>

</ul>


