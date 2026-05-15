<?php
require_once 'crud.php';
$idMusica = 21; # informação pode vir de um $_GET
$dadosAtualizados = [
    'nome_msc' => 'Música Teste-2', 
    'genero' => 'Gênero Teste-2',
    'autor' => 'Autor Teste-2', # Usar com post
    'duracao' => '00:02:54', # Formato HH:MM:SS
    'data_cadastro' => '2026-04-30' # Buscar com current date
];
$linhasAfetadas = update($pdo, 'musicas', $dadosAtualizados, 'id = '.$idMusica);

if ($linhasAfetadas > 0){
    echo 'Dados da música alterados com sucesso!<br>ID: '.$idMusica;
} else {
    echo 'Não foi possível atualizar os dados da música.';
};