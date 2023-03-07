// DataTable
$(function() {
	"use strict";

    $(document).ready(function() {
        $('#department').DataTable();
      } );


    //   $(document).ready(function() {
    //     var table = $('#example2').DataTable( {
    //         lengthChange: false,
    //         buttons: [ 'copy', 'excel', 'pdf', 'print']
    //     } );
     
    //     table.buttons().container()
    //         .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
    // } );


});
// Select2
$(document).ready(function() {
    $('.select2-department').select2();
});
$("#checkbox").click(function () {
    if ($("#checkbox").is(':checked')) {
        $(".select2-department > option").prop("selected", "selected");
        $(".select2-department").trigger("change");
    } else {
        $(".select2-department > option").removeAttr("selected");
        $(".select2-department").val("");
        $(".select2-department").trigger("change");
    }
});