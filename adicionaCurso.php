<?php
include('conexao.php'); 
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Cabeçalho JSON
header('Content-Type: application/json');

$tipo = $_REQUEST['tipo'];

function buscarIdCurso($nomeCurso, $db) {
    $sql = "SELECT idCurso FROM Curso WHERE nomeCurso = ";
    $stmt = $db->prepare($sql);
    $stmt->execute([$nomeCurso]);
    return $stmt->fetchColumn();
}

try {
    if (!$db) {
        throw new Exception("Erro na conexão com o banco de dados.");
    }

    switch ($tipo) {
        case 'curso':
            $nomeCurso = $_REQUEST['nomeCurso'] ;
            $duracao   = $_REQUEST['duracao'] ;
            $professor = $_REQUEST['professor'] ;
            $valor     = $_REQUEST['valor'] ;

            if (empty($nomeCurso) || empty($duracao) || empty($professor) || empty($valor)) {
                throw new Exception("Todos os campos devem ser preenchidos.");
            }

            //decimal
            $valor = floatval($valor);

            
            if (buscarIdCurso($nomeCurso, $db)) {
                throw new Exception("Erro: Já existe um curso com este nome.");
            }

            
            $sql = "INSERT INTO Curso (nomeCurso, duracao, professor, valor) VALUES (,,,)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$nomeCurso, $duracao, $professor, $valor]);

            echo json_encode(['retorno' => 'Curso cadastrado com sucesso.']);
            break;

        default:
            throw new Exception("Tipo de cadastro inválido.");
    }
} catch (Exception $e) {
    echo json_encode(['retorno' => 'Erro ao salvar: ' . $e->getMessage()]);
}
?>