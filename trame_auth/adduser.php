<?php

include("auth/EtreInvite.php");

if (empty($_POST['login'])) {
    include('adduser_form.php');
    exit();
}

$error = "";

foreach (['nom', 'prenom', 'login', 'mdp','role','mdp2'] as $name) {
    if (empty($_POST[$name])) {
        $error .= "La valeur du champs '$name' ne doit pas �tre vide";
    } else {
        $data[$name] = $_POST[$name];
    }
}


// V�rification si l'utilisateur existe
$SQL = "SELECT uid FROM users WHERE login=?";
$stmt = $db->prepare($SQL);
$res = $stmt->execute([$data['login']]);

if ($res && $stmt->fetch()) {
    $error .= "Login d�j� utilis�";
}

if ($data['mdp'] != $data['mdp2']) {
    $error .="MDP ne correspondent pas";
}

if (!empty($error)) {
    include('adduser_form.php');
    exit();
}


foreach (['nom', 'prenom', 'login', 'mdp','role'] as $name) {
    $clearData[$name] = $data[$name];
}

$passwordFunction =
    function ($s) {
        return password_hash($s, PASSWORD_DEFAULT);
    };

$clearData['mdp'] = $passwordFunction($data['mdp']);

try {
    $SQL = "INSERT INTO users(nom,prenom,login,mdp,role) VALUES (:nom,:prenom,:login,:mdp, :role)";
    $stmt = $db->prepare($SQL);
    $res = $stmt->execute($clearData);
    $id = $db->lastInsertId();
    $auth->authenticate($clearData['login'], $data['mdp']);
    // echo "Utilisateur $clearData[nom] : " . $id . " ajout� avec succ�s.";
    redirect($pathFor['root']);
} catch (\PDOException $e) {
    http_response_code(500);
    echo "Erreur de serveur.";
    exit();
}




