<?php
require_once 'crud.php';
$idMusica = 21; #pode receber como $_GET
$deleted = delete($pdo, 'musicas', 'id = '.$idMusica);
if ($deleted) {
    echo 'Música excluída da playlist.';
} else {
    echo 'Não foi possível excluir a música.';
};