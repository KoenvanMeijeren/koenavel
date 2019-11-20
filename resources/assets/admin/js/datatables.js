$(document).ready(function () {
    $('.table').DataTable({
        "aaSorting": [],
        'columnDefs': [{
            'orderable': true, /* true or false */
        }],
        "language": {
            "lengthMenu": "Toon _MENU_ gegevens per pagina",
            "zeroRecords": "Geen gegevens gevonden",
            "info": "Toon _PAGE_ van _PAGES_",
            "infoEmpty": "Geen gegevens beschikbaar",
            "infoFiltered": "(gefilterd uit _MAX_ gegevens)",
            "decimal": ",",
            "thousands": ".",
            "search": "Zoeken:",
            "emptyTable": "Geen gegevens beschikbaar in deze tabel",
            "infoPostFix": "",
            "loadingRecords": "Laden...",
            "processing": "Verwerken...",
            "paginate": {
                "first": "Eerste",
                "last": "Laatste",
                "next": "Volgende",
                "previous": "Vorige"
            },
            "aria": {
                "sortAscending": ": activeren om de kolom oplopend te sorteren",
                "sortDescending": ": activeren om de kolom aflopend te sorteren"
            }
        }
    });
});

$(document).ready( function () {
    $('.table').DataTable();
} );


