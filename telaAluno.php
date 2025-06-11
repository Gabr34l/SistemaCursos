<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Aluno</title>
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
            $('#formAluno')[0].reset();
            $('#retorno_aluno').html('');
        }

        function salvar() {
            const nome = $('#nomeAluno').val();
            const cpf = $('#cpfAluno').val();

            $.ajax({
                type: "POST",
                url: "adicionaAluno.php",
                data: { nomeAluno: nome, cpf: cpf },
                dataType: "json",
                success: function(res) {
                    $('#retorno_aluno').html(res.retorno);
                },
                error: function() {
                    $('#retorno_aluno').html("<font color='red'><b>Erro ao salvar.</b></font>");
                }
            });
        }
    </script>
</head>
<body>

<div class="card">
    <h2>CADASTRO DE ALUNO</h2>
    <p>Insira os dados abaixo para cadastrar</p>

    <form id="formAluno" onsubmit="event.preventDefault(); salvar();">
        <input type="text" id="nomeAluno" name="nomeAluno" placeholder="Nome Completo" required />
        <input type="text" id="cpfAluno" name="cpf" placeholder="CPF" required />

        <button type="submit" class="btn">CADASTRAR</button>
        <button type="button" class="btn" onclick="limparCampos()">LIMPAR</button>

        <div id="retorno_aluno" class="msg"></div>
    </form>
</div>

</body>
</html>
