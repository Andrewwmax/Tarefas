$(document).ready(function(){
    $('#tabelaEditavel').Tabledit({
        deleteButton: false,
        editButton: false,
        columns: {
            identifier: [0, 'idTarefa'],
            editable: [[2, 'nomeTarefa'], [3, 'custoTarefa'], [4, 'dataLimiteTarefa']]
        },
        hideIdentifier: false,
        url: 'editarTabela.php'
    });
});
