<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Matrícula</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 30px;
            width: 350px;
            text-align: center;
        }

        h2 {
            color: #5a2a0a;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 14px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            background-color: #ff6600;
            color: white;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
            margin-bottom: 10px;
        }

        .btn:hover {
            background-color: #e55c00;
        }

        #retorno_matricula {
            margin-top: 10px;
            font-size: 14px;
            color: red;
        }
    </style>
    <script>
        function limparCampos(formId) {
            document.getElementById(formId).reset();
        }

        function salvar(tipo, formId, dados) {
            $.ajax({
                type: "POST",
                url: "adicionaMatricula.php",  
                data: { tipo: tipo, ...dados },
                dataType: "json",
                success: function(res) {
                    document.getElementById("retorno_" + tipo).innerHTML = res.retorno;
                },
                error: function() {
                    document.getElementById("retorno_" + tipo).innerHTML = "Erro ao salvar.";
                }
            });
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Matricula</h2>
        <div id="formularioMatricula">
            <p>Preencha os dados corretamente para realizar a matrícula:</p>
   <form id="formMatricula" method="POST" onsubmit="event.preventDefault();">
    <input type="text" id="idAluno" name="idAluno" placeholder="ID do Aluno" required>
    <input type="text" id="idCurso" name="idCurso" placeholder="ID do Curso" required>
    <input type="date" id="dataMatricula" name="dataMatricula" required>
    <input type="number" id="valorPago" name="valorPago" placeholder="Valor Pago" step="0.01" required>

    <button type="button" class="btn" onclick="salvar('matricula', 'formMatricula', {
        idAluno: $('#idAluno').val(),
        idCurso: $('#idCurso').val(),
        datahora: $('#dataMatricula').val(),
        valorPago: $('#valorPago').val()
    })">SALVAR</button>

    <button type="button" class="btn" onclick="limparCampos('formMatricula')">LIMPAR</button>
    <div id="retorno_matricula"></div>
</form>
</div>
</div>
</body>
</html>