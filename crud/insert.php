<?php
require_once 'crud.php';

$novaMusica = [
    'nome_msc' => 'Música Teste', 
    'genero' => 'Gênero Teste',
    'autor' => 'Autor Teste', # Usar com post
    'duracao' => '00:04:21', # HH:MM:SS
    'data_cadastro' => '2026-04-30' # Buscar com current date
];
/* dentro do sistema com post
// $novaMusica = [
//     'nome_msc' => $POST['nome_msc'],
//     'genero' => $POST['genero'],
//     'autor' => $POST['autor'],
//     'duracao' => $POST['duracao'], # HH:MM:SS
//     'data_cadastro' => $POST['data_cadastro']
// ];
*/

$idNovaMusica = create($pdo, 'musicas', $novaMusica);
echo 'Nova música inserida, com o ID: '.$idNovaMusica;