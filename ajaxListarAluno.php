<?php
include "conexao.php";

$pagina    = $_GET['page']; 
$linPorPag = $_GET['rows']; 
$campo     = $_GET['sidx']; 
$ordem     = $_GET['sord']; 

$where = " WHERE 1=1 ";

if (!empty($_REQUEST['txtAluno'])) {
    $where .= " AND a.nomeAluno LIKE '%" . $_REQUEST['txtAluno'] . "%'";
}


$sql = "SELECT COUNT(*) as total FROM aluno a $where";
$rsTotal = $db->query($sql)->fetch();
$totalReg = $rsTotal['total'];

$totalPag = $totalReg > 0 ? ceil($totalReg / $linPorPag) : 0;
if ($pagina > $totalPag) $pagina = $totalPag;
$start = $linPorPag * $pagina - $linPorPag;


$sql = "
    SELECT 
        a.idAluno,
        a.nomeAluno,
        a.CPF,
        c.nomeCurso,
        m.datahora
    FROM Aluno a
    LEFT JOIN Matricula m ON a.idAluno = m.idAluno
    LEFT JOIN Curso c ON m.idCurso = c.idCurso
    $where
    ORDER BY $campo $ordem 
    LIMIT $start, $linPorPag
";

$response = new stdClass();
$response->page = $pagina;
$response->total = $totalPag;
$response->records = $totalReg;
$i = 0;

foreach ($db->query($sql) as $row) {
    $response->rows[$i]['id'] = $row['idAluno'];
    $response->rows[$i]['idAluno'] = $row['idAluno'];
    $response->rows[$i]['nomeAluno'] = $row['nomeAluno'];
    $response->rows[$i]['CPF'] = $row['CPF'];
    $response->rows[$i]['nomeCurso'] = $row['nomeCurso'];
    $response->rows[$i]['datahora'] = $row['datahora'];
    $i++;
}

echo json_encode($response);
?>
