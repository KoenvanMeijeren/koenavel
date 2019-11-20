$('#datepicker').datepicker({
    uiLibrary: 'bootstrap4',
    format: "dd-mm-yyyy",
    maxViewMode: 1,
    todayBtn: "linked",
    language: "nl",
    calendarWeeks: true,
    autoclose: true,
    todayHighlight: true
});

$(document).ready(function(){
    $("#searchLog").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".list-group a").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
