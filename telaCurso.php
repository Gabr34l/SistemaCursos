<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Curso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        .card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 30px;
            width: 350px;
        }

        h2 {
            text-align: center;
            color: #5a2a0a;
        }

        p {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
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

        .msg {
            text-align: center;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>

    <script>
        function limparCampos() {
            $('#formCurso')[0].reset();
            $('#retorno_curso').html('');
        }

        function salvar() {
            const nomeCurso = $('#nomeCurso').val();
            const duracao = $('#duracao').val();
            const professor = $('#professor').val();
            const valor = $('#valor').val();

            $.ajax({
                type: "POST",
                url: "adicionaCurso.php",
                data: { nomeCurso: nomeCurso, duracao: duracao, professor: professor, valor: valor },
                dataType: "json",
                success: function(res) {
                    $('#retorno_curso').html(res.retorno);
                },
                error: function() {
                    $('#retorno_curso').html("<font color='red'><b>Erro ao salvar.</b></font>");
                }
            });
        }
    </script>
</head>
<body>

<div class="card">
    <h2>CADASTRO DE CURSO</h2>
    <p>Insira os dados abaixo para cadastrar</p>

    <form id="formCurso" onsubmit="event.preventDefault(); salvar();">
        <input type="text" id="nomeCurso" name="nomeCurso" placeholder="Nome do Curso" required />
        <input type="text" id="duracao" name="duracao" placeholder="Duração (ex: 6 meses)" required />
        <input type="text" id="professor" name="professor" placeholder="Nome do Professor" required />
        <input type="number" id="valor" name="valor" placeholder="Valor (R$)" required />
        <button type="submit" class="btn">CADASTRAR</button>
        <button type="button" class="btn" onclick="limparCampos()">LIMPAR</button>

        <div id="retorno_curso" class="msg"></div>
    </form>
</div>

</body>
</html>