$(function($) {
    "use strict";



 

    // Active Data Table
    $("#idtable").DataTable({
        "responsive": true,
        "autoWidth": false,
      });

    // Summernote
    $('.summernote').summernote();

    // active alert js
    $('.alert').alert();

    // Bootstrap Toggle js
    $(function () {
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch({state: $(this).is(':checked')}).trigger('change');
        });
    });
    
    //color picker with addon
    $('.my-colorpicker2').colorpicker();
    $('.my-colorpicker2').on('colorpickerChange', function(event) {
    $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });




    // // Active tooltip
    // $('[data-toggle="tooltip"]').tooltip();


    // /* ======================================
    // Bootstrap Datepicker Start
    // ========================================= */


    // // Start Date
    // $('#start_date').datetimepicker({ 
    //     format: 'L'
    //     }); 

    // // Submission Date
    // $('#submission_date').datetimepicker({ 
    //     format: 'L'
    // }); 
    
    //   // Start Date
    //   $('.datepicker').datetimepicker({ 
    //     format: 'MM/YYYY'
    //  }); 
    // // From Date Year Select
    // $("#from_date").datetimepicker( {
    // format: 'YYYY'
    // });

    // // Date To Year Select
    // $("#date_to").datetimepicker( {
    //     format: 'YYYY'
    // });

    // // Toggle Date to Field
    // $('#date_check').on('change', function(){
    //     if($('#date_check').is(':checked')) {
    //         $("input[name='date_to']").val('');
    //         $('#date_to_grup').hide();
    //     } else {
    //         $('#date_to_grup').show();
    //     }
    // });
    // if($('#date_check').is(':checked')) {
    //     $('#date_to_grup').hide();
    // }
    /* ======================================
    Bootstrap Datepicker End
    ========================================= */


    /* ======================================
    Bs Cistom Input Start
    ========================================= */
    bsCustomFileInput.init();
    /* =======================================
    Bs Cistom Input End
    ========================================== */


    // Language filter
    $('.languageSelect').on('change', function () {
        let languageUrl = $(this).attr('data');
        let languageVal = $(this).val();
        languageUrl = languageUrl + languageVal;
        window.location.href = languageUrl;
    })



    /* ======================================
    IMAGE UPLOADING Start
    ========================================= */
    $(".up-img").on("change", function () {
        var imgpath = $(this).parent().parent().find('.show-img');
        console.log(imgpath);
        var file = $(this);
        readURL(this, imgpath);
    });

    function readURL(input, imgpath) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                imgpath.attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    /* ========================================
    IMAGE UPLOADING End 
    =========================================== */

     // delete warnng

     $(document).on("click", "#delete", function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $(this).parent("#deleteform").submit();
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                Swal.fire(
                    'Cancelled',
                    'Your file is safe :)',
                    'error'
                )
            }
        });
    });


    // session notification
    if (document.body.dataset.notification == undefined) {
        return false
    } else {
        var data = JSON.parse(document.body.dataset.notificationMessage);
        var msg = data.messege;

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        switch (data.alert) {
            case 'info':
                Toast.fire({
                    icon: 'info',
                    title: msg
                })
                break;
            case 'success':
                Toast.fire({
                    icon: 'success',
                    title: msg
                })
                break;
            case 'warning':
                Toast.fire({
                    icon: 'warning',
                    title: msg
                })
                break;
            case 'error':
                Toast.fire({
                    icon: 'error',
                    title: msg
                })
                break;
        }

    };

});


// Iconpicker Icon Submit Javascript Code
function store(e) {
    e.preventDefault();
    $("#inputIcon").val($(".biconpicker").find('i').attr('class'));
    document.getElementById('slink').submit();
}
