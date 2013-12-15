<?php

/***********************************************************************
 * File: register.php
 * Author: PK
 * Date: 04/11/13 20:51
 * 
 * Description: Registration template
 *********************************************************************/


?>

<div id="page" class="page">
    <div class="row">
        <div class="col-xs-12">
            <form class="userform form-signin" method="post">
                <h2 class="form-signin-heading">Register an Account</h2>
                <input type="text" class="form-control" id="register-email" name="email" placeholder="Email Address" autofocus maxlength="30">
                <input type="password" class="form-control" id="register-password" name="password" placeholder="Password (6 chars or more)" maxlength="30">
                <button class="btn btn-lg btn-primary btn-block" type="submit" id="submit" name="form" value="register">Register</button>
            </form>
        </div>
    </div>
</div>
<div>
    <form id="login" method="post">
        <input type="hidden" id="lemail" name="email" value="">
        <input type="hidden" id="lpassword" name="password" value="">
        <input type="hidden" name="form" value="login">
    </form>
</div>