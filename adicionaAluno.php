<?php
include "conexao.php";
header('Content-Type: application/json');

$nome = $_REQUEST['nomeAluno'] ?? '';
$cpf = $_REQUEST['cpf'] ?? '';
$idCursoPadrao = 1; // ID do curso que será atribuído automaticamente
$valorPadrao = 0.00;

if ($nome == '' || $cpf == '') {
    echo json_encode(['retorno' => '<font color=red><b>Nome e CPF são obrigatórios.</b></font>']);
    exit;
}

try {
    $verifica = $db->prepare("SELECT COUNT(*) FROM Aluno WHERE CPF = ?");
    $verifica->execute([$cpf]);
    
    if ($verifica->fetchColumn() > 0) {
        echo json_encode(['retorno' => '<font color=red><b>CPF já cadastrado.</b></font>']);
        exit;
    }

    // Inserir aluno
    $inserir = $db->prepare("INSERT INTO Aluno (nomeAluno, CPF) VALUES (?, ?)");
    $inserir->execute([$nome, $cpf]);

    $idAluno = $db->lastInsertId();

    // Criar matrícula padrão
    $matricula = $db->prepare("INSERT INTO Matricula (idAluno, idCurso, valorPago) VALUES (?, ?, ?)");
    $matricula->execute([$idAluno, $idCursoPadrao, $valorPadrao]);

    echo json_encode(['retorno' => '<font color=blue><b>Aluno cadastrado com sucesso com matrícula padrão!</b></font>']);

} catch (PDOException $e) {
    echo json_encode(['retorno' => '<font color=red><b>Erro: ' . $e->getMessage() . '</b></font>']);
}
?>
