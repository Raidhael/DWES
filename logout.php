<?php

ini_set('session.name','SessionDelBlog');
session_start();
unset($_SESSION['nombre']);
unset($_SESSION['tipoUsuario']);
header('location: /');
?>