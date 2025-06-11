<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Alunos</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>  

    <script type="text/javascript" src="js/jquery-ui-1.8.17.custom/js/jquery-1.7.1.min.js"></script>
    <link rel="stylesheet" href="js/jquery-ui-1.8.17.custom/css/smoothness/jquery-ui-1.8.17.custom.css">
    <script src="js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.core.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.widget.js" type="text/javascript"></script> 
    <script src="js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.button.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.datepicker.js" type="text/javascript"></script> 

    <script type="text/javascript" src="js/jquery.form.js"></script>
    <script src="js/jquery.jqGrid-3.8.2/js/i18n/grid.locale-pt-br.js" type="text/javascript"></script>
    <script src="js/jquery.jqGrid-3.8.2/js/jquery.jqGrid.min.js" type="text/javascript"></script>
    <link href="js/jquery.jqGrid-3.8.2/css/ui.jqgrid.css" rel="stylesheet" type="text/css"/>

    <script>
    $(function() {
        jQuery("#alunoGrid").jqGrid({
            url: 'ajaxListarAluno.php',
            editurl: 'adicionaAluno.php',
            datatype: 'json',
            mtype: 'GET',
            jsonReader: { repeatitems: false },
            pager: '#alunoPagerGrid',
            rowNum: 10,
            rowList: [10, 20, 30],
            sortable: true,
            viewrecords: true,
            gridview: true,
            autowidth: true,
            height: 370,
            shrinkToFit: true,
            forceFit: true,
            hidegrid: false,
            sortname: 'nomeAluno',
            sortorder: 'asc',
            caption: "Alunos Cadastrados",
            colModel:[
                { label:'ID', width: 40, align: 'center', name:'idAluno' },
                { label:'Nome', width: 200, align: 'left', name:'nomeAluno' },
                { label:'CPF', width: 120, align: 'center', name:'CPF' },
                { label:'Curso', width: 150, align: 'left', name:'nomeCurso' },
                { label:'Data Matrícula', width: 120, align: 'center', name:'datahora' }
            ]
        });

        jQuery("#alunoGrid").jqGrid('navGrid', '#alunoPagerGrid', { del:false, add:false, edit:false, search:false, refresh:true });

        $("#btnCadastrar").click(function(){
            window.location = "adicionaAluno.php";    
        });

        $("#btnEditar").click(function(){
            var linhaSelecionada = jQuery("#alunoGrid").getGridParam('selrow');
            var id = jQuery("#alunoGrid").getCell(linhaSelecionada, 0);
            if(id != null){
                window.location = "alunoEditar.php?id=" + id;
            } else {
                alert("Selecione um Registro");
            }
        });

        $("#btnDeletar").click(function(){
            var linhaSelecionada = jQuery("#alunoGrid").getGridParam('selrow');
            var id = jQuery("#alunoGrid").getCell(linhaSelecionada, 0);
            if(linhaSelecionada != null){
                if(confirm("Confirma a exclusão?")){
                    $('#objetoQualquer').load('alunoExcluir.php?id=' + id, function() {
                        jQuery("#alunoGrid").jqGrid('setGridParam', { url:'ajaxListarAluno.php', page:1 }).trigger('reloadGrid');
                    });
                }
            } else {
                alert("Selecione um Registro");
            }
        });

        $("#btnPesquisar").click(function(){
            var nome = $('#txtAluno').val();
            jQuery("#alunoGrid").jqGrid('setGridParam', { 
                url:'ajaxListarAluno.php?txtAluno=' + encodeURIComponent(nome), 
                page:1 
            }).trigger('reloadGrid');
        });

        $("#btnLimpar").click(function(){
            $('#txtAluno').val('');
            jQuery("#alunoGrid").jqGrid('setGridParam', { url:'ajaxListarAluno.php', page:1 }).trigger('reloadGrid');
        });
    });
    </script>
</head>
<body>
<div id="botoes" style="padding:4px; font-size:12px; font-weight:bold;">
    <input type="button" id="btnCadastrar" value="Cadastrar"/>
    <input type="button" id="btnEditar" value="Editar"/>
    <input type="button" id="btnDeletar" value="Deletar"/>
    <input type="text" id="txtAluno" name="txtAluno" placeholder="Pesquisar por nome"/>
    <input type="button" id="btnPesquisar" value="Pesquisar"/>  
    <input type="button" id="btnLimpar" value="Limpar"/>       
</div> 

<table id="alunoGrid"></table>
<div id="alunoPagerGrid"></div>
<div id="objetoQualquer"></div>
</body>
</html>
