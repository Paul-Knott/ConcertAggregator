<?php

/***********************************************************************
 * File: footer.php
 * Author: PK
 * Date: 18/10/13 18:28
 *
 * Description: footer template
 *********************************************************************/

?>
<!--suppress ALL -->
</div>

<!--
#
# SIDEBAR
#
-->
<a href="#"><span class="glyphicon glyphicon-expand rotate sidebar-toggle logo"></span></a>
<div class="sidebar-wrapper">
    <ul class="list-group">
        <li class="search list-group-item">
            <div class="row">
                <div class="col-xs-12 left-row">
                    <form id="search" class="form-inline" role="search">
                        <div class="form-group">
                            <input type="text" name="artist" id="searchText" class="form-control search-query" autocomplete="off" maxlength="18" placeholder="Artist/Band Search" autofocus="autofocus" />

                            <button type="submit" id="searchButton" class="btn btn-default"><span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </li>
        <li class="artist list-group-item">
            <div id="loading" class="nowrap">
                &nbsp; &nbsp; &nbsp; <small><b>Search for an Artist/Band to begin</b></small>
            </div>
        </li>
    </ul>
    <div id="playlist">
    </div>
    <div id="affiliates" class="center">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <small><b>Data Provided By:</b></small><br />
        <a href="http://songkick.com"><img src="img/songkick.png" width="180px" alt="songkick"></a><br />
        <a href="http://last.fm"><img src="img/lastfm.png"  width="180px" alt="last.fm"></a><br />
        <a href="http://youtube.com"><img src="img/youtube.png"  width="180px" alt="youtube"></a><br />
        <p>&nbsp;</p>
        <p><small><b>&copy; Idlesquad.net 2013</b></small></p>
    </div>
</div>
</div>

<!--
#
# END OF TEMPLATE
#
-->

<!-- Load JS last & use CDNs for faster page loading -->
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="js/jquery.tubeplayer.min.js"></script>
<script src="js/jquery.ui.touch-punch.min.js"></script>
<script src="js/jquery.navgoco.min.js"></script>
<script src="js/sidebar.js"></script>

<!-- Google Analytics -->

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-26809599-3', 'idlesquad.net');
    ga('send', 'pageview');

</script>

<div id="message" token="<?= $this->getToken() ?>"></div>

</body>
</html>