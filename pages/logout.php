<?php
   $logout = new Login($GLOBALS['connection']);
   $logout->LogOut();
   header('Location: ' . Config::PATH . '/forum');
?>
