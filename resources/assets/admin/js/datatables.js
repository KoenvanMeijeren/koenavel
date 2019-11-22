$(document).ready(function() {
    var table = $('.table').DataTable({
        scrollX: true,
        aaSorting: [],
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Alles"]],
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: true,
            targets:   0
        } ],
        language: {
            lengthMenu: "Toon _MENU_ gegevens per pagina",
            zeroRecords: "Geen gegevens gevonden",
            info: "Toon _PAGE_ van _PAGES_",
            infoEmpty: "Geen gegevens beschikbaar",
            infoFiltered: "(gefilterd uit _MAX_ gegevens)",
            decimal: ",",
            thousands: ".",
            search: "Zoeken:",
            emptyTable: "Geen gegevens beschikbaar in deze tabel",
            infoPostFix: "",
            loadingRecords: "Laden...",
            processing: "Verwerken...",
            paginate: {
                first: "Eerste",
                last: "Laatste",
                next: "Volgende",
                previous: "Vorige"
            },
            aria: {
                sortAscending: ": activeren om de kolom oplopend te sorteren",
                sortDescending: ": activeren om de kolom aflopend te sorteren"
            }
        },
    });
});


