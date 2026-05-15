<?php
$nomeLoja = "ConstruTech";

$categorias = [
    'bruto' => 'Bruto',
    'ferramentas' => 'Ferramentas',
    'acabamento' => 'Acabamento'
];

$emailCerto = 'teste@teste.com'; 
$senhaCerta = 'teste123';
$erro = '';

$qtd = (float) str_replace(',', '.', $produto['quantidade'] ?? 0);
$preco = (float) str_replace(',', '.', $produto['preco'] ?? 0);


$produtos_base = [
    ['id' => 1, 'nome' => 'Cimento CP-II', 'quantidade' => 35, 'preco' => 32.90, 'categoria' => 'bruto'],
    ['id' => 2, 'nome' => 'Areia Lavada Fina', 'quantidade' => 12, 'preco' => 95.00, 'categoria' => 'bruto'],
    ['id' => 3, 'nome' => 'Martelo de Unha', 'quantidade' => 86, 'preco' => 24.90, 'categoria' => 'ferramentas'],
    ['id' => 4, 'nome' => 'Furadeira de Impacto', 'quantidade' => 86, 'preco' => 249.90, 'categoria' => 'ferramentas'],
    ['id' => 5, 'nome' => 'Piso Porcelanato 60x60', 'quantidade' => 86, 'preco' => 50.90, 'categoria' => 'acabamento'],
    ['id' => 6, 'nome' => 'Torneira Monocomando', 'quantidade' => 86, 'preco' => 189.90, 'categoria' => 'acabamento'],
    ['id' => 7, 'nome' => 'Brita nº 1', 'quantidade' => 86, 'preco' => 88.00, 'categoria' => 'bruto'],
    ['id' => 8, 'nome' => 'Cal de Pintura', 'quantidade' => 1, 'preco' => 12.50, 'categoria' => 'bruto'],
    ['id' => 9, 'nome' => 'Tijolo Baiano 8 Furos', 'quantidade' => 1, 'preco' => 0.85, 'categoria' => 'bruto'],
    ['id' => 10, 'nome' => 'Vergalhão de Aço 3/8', 'quantidade' => 1, 'preco' => 45.90, 'categoria' => 'bruto'],
    ['id' => 11, 'nome' => 'Alicate Universal', 'quantidade' => 1, 'preco' => 35.00, 'categoria' => 'ferramentas'],
    ['id' => 12, 'nome' => 'Serra Tico-Tico', 'quantidade' => 1, 'preco' => 310.00, 'categoria' => 'ferramentas'],
    ['id' => 13, 'nome' => 'Chave de Fenda Kit', 'quantidade' => 0, 'preco' => 42.00, 'categoria' => 'ferramentas'],
    ['id' => 14, 'nome' => 'Nível de Alumínio', 'quantidade' => 0, 'preco' => 28.50, 'categoria' => 'ferramentas'],
    ['id' => 15, 'nome' => 'Trena 5 Metros', 'quantidade' => 0, 'preco' => 0.90, 'categoria' => 'ferramentas'],
];