<?php
include "conexao.php";


header('Content-Type: application/json');


$idAluno = $_REQUEST['idAluno'] ;
$idCurso = $_REQUEST['idCurso'] ;
$datahora = $_REQUEST['datahora'] ;
$valorPago = $_REQUEST['valorPago'];

// Validação
if ($idAluno == '' || $idCurso == '') {
    echo json_encode(['retorno' => '<font color=red><b>ID do Aluno e ID do Curso são obrigatórios.</b></font>']);
    exit;
}

try {
    //verificações
    $aluno = $db->prepare("SELECT COUNT(*) FROM Aluno WHERE idAluno = ?");
    $aluno->execute([$idAluno]);
    if ($aluno->fetchColumn() == 0) {
        echo json_encode(['retorno' => '<font color=red><b>Aluno não encontrado.</b></font>']);
        exit;
    }

    
    $curso = $db->prepare("SELECT COUNT(*) FROM Curso WHERE idCurso = ?");
    $curso->execute([$idCurso]);
    if ($curso->fetchColumn() == 0) {
        echo json_encode(['retorno' => '<font color=red><b>Curso não encontrado.</b></font>']);
        exit;
    }

    
    $matricula = $db->prepare("SELECT COUNT(*) FROM Matricula WHERE idAluno = ? AND idCurso = ?");
    $matricula->execute([$idAluno, $idCurso]);
    if ($matricula->fetchColumn() > 0) {
        echo json_encode(['retorno' => '<font color=red><b>Este aluno já está matriculado neste curso.</b></font>']);
        exit;
    }


    $inserir = $db->prepare("INSERT INTO Matricula (datahora, idAluno, idCurso, valorPago) VALUES (?, ?, ?, ?)");
    $inserir->execute([$datahora, $idAluno, $idCurso, $valorPago]);

    echo json_encode(['retorno' => '<font color=blue><b>Matrícula realizada com sucesso!</b></font>']);

} catch (PDOException $e) {
    echo json_encode(['retorno' => '<font color=red><b>Erro: ' . $e->getMessage() . '</b></font>']);
}
?>
