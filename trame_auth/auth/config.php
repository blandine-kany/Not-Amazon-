<?php

$authTableData = [
    'table' => 'users',
    'idfield' => 'login',
    'cfield' => 'mdp',
    'uidfield' => 'uid',
    'rfield' => 'role',
];

$pathFor = [
    "login"  => "/pw/ProjetVente/trame_auth/login.php",
    "logout" => "/pw/ProjetVente/trame_auth/logout.php",
    "adduser" => "/pw/ProjetVente/trame_auth/adduser.php",
    "root"   => "/pw/ProjetVente/trame_auth/",
];

const SKEY = '_Redirect';