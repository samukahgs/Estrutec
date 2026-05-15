<?php

// Configurações de conexão com o banco de dados (ajuste conforme sua configuração)
$host = "localhost"; #HOST_DO_BANCO
$port = 3306; #PORTA_DO_BANCO
$dbname = "db_teste"; #NOME_DO_BANCO
$username = "dev"; #USUÁRIO_DO_BANCO
$password = "123"; #SENHA_DO_BANCO

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password); /* objeto PDO -> Forma de conexão do php moderno */
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); /* Seta atributos para essa conexão */

    // Função para inserir um novo registro
    function create($pdo, $table, array $data) { /* função create que passa pdo (conexão), tabela, e os dados em um array */
        $columns = implode(', ', array_keys($data)); /* proteção contra sql injection -> pega esse array e cria a quantidade de colunas dele */
        $placeholders = implode(', ', array_fill(0, count($data), '?')); /* proteção contra sql injection -> pega esse array e cria cada placeholder com valor "?" */

        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array_values($data));
        return $pdo->lastInsertId();
    }

    // Função para ler registros
    function readAll($pdo, $table, $where = null) {
        $sql = "SELECT * FROM $table";
        if ($where) {
            $sql .= " WHERE $where";
        }
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); /* Traz todas as correspondencias para a condição que passar */
    }

    function read($pdo, $table, $where = null) { /* Passar aqui noo where sempre um campo único */
        $sql = "SELECT * FROM $table";
        if ($where) {
            $sql .= " WHERE $where";
        }
        $stmt = $pdo->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC); /* Traz apenas a primeira correspondencia desse registro */
    }

    // Função para atualizar um registro
    function update($pdo, $table, array $data, $where) { /* Não passar nulo no where para nao substituir toda a tabela */
        $set = [];
        foreach ($data as $column => $value) {
            $set[] = "$column = ?";
        }
        $set = implode(', ', $set);

        $sql = "UPDATE $table SET $set WHERE $where";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array_values($data));
        return $stmt->rowCount();
    }

    // Função para excluir um registro
    function delete($pdo, $table, $where) {
        $sql = "DELETE FROM $table WHERE $where";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}