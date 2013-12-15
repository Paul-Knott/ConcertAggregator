<?php

/***********************************************************************
 * File: sign-in.php
 * Author: PK
 * Date: 05/11/13 11:50
 * 
 * Description: Login Page template
 *********************************************************************/

?>

<div id="page" class="page">
    <div class="row">
        <div class="col-xs-12">
            <form class="userform form-signin" method="post">
                <h2 class="form-signin-heading">Sign In</h2>
                <input type="text" class="form-control" id="signin-email" name="email" placeholder="Email" autofocus maxlength="30">
                <input type="password" class="form-control" id="signin-password" name="password" placeholder="Password" maxlength="30">
                <button class="btn btn-lg btn-primary btn-block" type="submit" id="submit" name="form" value="login">Sign In</button>
            </form>
        </div>
    </div>
</div>
<div>
</div>