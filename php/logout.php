<?php
	session_start();
    $_SESSION = array();
    session_destroy();
    header("Location: http://www.gpm2014.tk");
    exit;
?>