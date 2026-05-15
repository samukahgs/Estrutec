<?php
require_once 'crud.php';

$musicas = readAll($pdo, 'musicas', 'id>=0');
// echo '<pre>'; 
// print_r($musicas);
// echo '</pre>';
echo '<h3>readAll com Where id>=0</h3>';
echo '<p>';
foreach($musicas as $musica) {
    echo 'ID: ' .$musica['id']. ', Título: ' .$musica['nome_msc'].', Gênero: '.$musica['genero'].', Duração: '.$musica['duracao'].', Autor: '.$musica['autor'].', Data de Cadastro (Música): '.$musica['data_cadastro'].'<br>';
};
echo '</p>';
echo '<br><br>';


// $musica = read($pdo, 'musicas', 'id=1'); # buscar chave primária do where com get
// echo '<h3>read (único) com Where id = 1</h3>';
// if($musica) {
//     echo 'ID: ' .$musica['id']. ', Título: ' .$musica['nome_msc'].', Gênero: '.$musica['genero'].', Duração: '.$musica['duracao'].', Autor: '.$musica['autor'].', Data de Cadastro (Música): '.$musica['data_cadastro'].'<br>';
// } else {
//     echo '<p>Música não encontrada</p>';
// };