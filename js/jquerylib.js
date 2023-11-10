(function() {
    $("#txtregend").datepicker({
    dateFormat: "yy/mm/dd",
    });


    $('#ls').DataTable(
        {
        "lengthMenu": [2, 3, 5, 10, 20],
        lengthChange: true,
        info: true,
        pageLength: 2
        }
        );


        setTimeout("removeAlert()", 3000);
        $('.logo').hide().slideDown(6000);
    });


    function removeAlert(){
        $('#msgalert').fadeOut(2000);
        }