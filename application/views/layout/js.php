<script>
    
      function PrintDiv() {  
          
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=1750,height=800');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
       popupWin.document.close();
        
            } 

    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
    csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

   $("a[id$='-fid']").click(function () {
       var value = $(this).attr("id");
       var id = value.replace("-fid", "");

       $.ajax({
           type: "POST",
           url: '<?php echo base_url("training_records/edit"); ?>',
           data: {
               id: id,
               [csrfName]: csrfHash
           },
           dataType: 'html',
           success: function (data) {
               $('#editdiv').html(data);
               $('#submit').removeAttr("disabled");
               $("#dob,#date_of_appointment,#training_date").datepicker({dateFormat: 'dd/mm/yy'});
           }
       });
   });
   




      $("a[id$='-sid']").click(function () {
       var value = $(this).attr("id");
       var id = value.replace("-sid", "");
       $.ajax({
           type: "POST",
           url: '<?php echo base_url("specialities_record/edit"); ?>',
           data: {
               id: id,
               [csrfName]: csrfHash
           },
           dataType: 'html',
           success: function (data) {
               $('#editdiv').html(data);
               $('#submit').removeAttr("disabled");
               $("#dob,#date_of_appointment").datepicker({dateFormat: 'dd/mm/yy'});
           }
       });
   });



        $("a[id$='-did']").click(function () {
        var value = $(this).attr("id");
        var id = value.replace("-did", "");
       
        $.ajax({
            type: "POST",
            url: '<?php echo base_url("district_management/edit"); ?>',
            data: {
                id: id,
                [csrfName]: csrfHash
            },
            dataType: 'html',
            success: function (data) {
                $('#editdiv').html(data);
                $('#submit').removeAttr("disabled");
                $("#dob,#date_of_appointment").datepicker({dateFormat: 'dd/mm/yy'});
            }
        });
    });

    $("a[id$='-uid']").click(function () {
        var value = $(this).attr("id");
        var id = value.replace("-uid", "");
        alert(id);


        $.ajax({
            type: "POST",
            url: '<?php echo base_url("users_management/edit"); ?>',
            data: {
                id: id,
                [csrfName]: csrfHash
            },
            dataType: 'html',
            success: function (data) {
                $('#editdiv').html(data);
                $('#submit').removeAttr("disabled");
                $("#dob,#date_of_appointment").datepicker({dateFormat: 'dd/mm/yy'});
            }
        });
    });


        $("a[id$='-uuid']").click(function () {
        var value = $(this).attr("id");
        var id = value.replace("-uuid", "");
        alert(id);

        $.ajax({
            type: "POST",
            url: '<?php echo base_url("university_management/edit"); ?>',
            data: {
                id: id,
                [csrfName]: csrfHash
            },
            dataType: 'html',
            success: function (data) {
                $('#editdiv').html(data);
                $('#submit').removeAttr("disabled");
                $("#dob,#date_of_appointment").datepicker({dateFormat: 'dd/mm/yy'});
            }
        });
    });
     $("a[id$='-deid']").click(function () {
        var value = $(this).attr("id");
        var id = value.replace("-deid", "");
        alert(id);

        $.ajax({
            type: "POST",
            url: '<?php echo base_url("degree_management/edit"); ?>',
            data: {
                id: id,
                [csrfName]: csrfHash
            },
            dataType: 'html',
            success: function (data) {
                $('#editdiv').html(data);
                $('#submit').removeAttr("disabled");
                $("#dob,#date_of_appointment").datepicker({dateFormat: 'dd/mm/yy'});
            }
        });
    });


      $("a[id$='-cid']").click(function () {
        var value = $(this).attr("id");
        var id = value.replace("-cid", "");
        alert(id);

        $.ajax({
            type: "POST",
            url: '<?php echo base_url("cadre_management/edit"); ?>',
            data: {
                id: id,
                [csrfName]: csrfHash
            },
            dataType: 'html',
            success: function (data) {
                $('#editdiv').html(data);
                $('#submit').removeAttr("disabled");
                $("#dob,#date_of_appointment").datepicker({dateFormat: 'dd/mm/yy'});
            }
        });
    });
 $("a[id$='-catid']").click(function () {
        var value = $(this).attr("id");
        var id = value.replace("-catid", "");

        $.ajax({
            type: "POST",
            url: '<?php echo base_url("category/edit"); ?>',
            data: {
                id: id
                [csrfName]: csrfHash
            },
            dataType: 'html',
            success: function (data) {
                $('#editdiv').html(data);
                $('#submit').removeAttr("disabled");
                $("#dob,#date_of_appointment").datepicker({dateFormat: 'dd/mm/yy'});
            }
        });
    });




      //add personal record js function

    //      function duplicate_emp_number(emp)

    // {
    //     $.ajax(
    //             {
    //                 type: "POST",
    //                 data: {emp: emp},
    //                 url: "ajax_duplicate_empnumber.php"
    //             })
    //             .success(function (e)
    //             {
    //                 if (e == 'true') {
    //                     alert("employee number already exist");
    //                 }
    //             }
    //             );
    // }


    // $(function () {
    //     $("#chkposting").click(function () {
    //         if ($(this).is(":checked")) {
    //             $("#dvposting").hide();
    //             $("#ed").val('00/00/0000');
    //         } else {
    //             $("#dvposting").show();
    //         }
    //     });
    // });

    $("#personalbutton").click(function (e) {
        var form = $("#addpersonalform");
        form.validate({
            rules: {
                // simple rule, converted to {required:true}
                name: "required",
                // compound rule
                contact_no: {
                    required: true,
                    number: true,
                    [csrfName]: csrfHash
                }
            }
        });

        if (form.valid()) {

            var data = $('#addpersonalform').serialize();
            $.post('<?php echo base_url("profile/add"); ?>', data).done(function (arsalan) {
                $('.widget').find('.widget-body').collapse('toggle');
                $("#personal_id").val(arsalan);
                $("#pers_specility_id").val(arsalan);
                $("#pers_training_id").val(arsalan);
                //            $("#family_children_id").val(arsalan);
                $("#pers_post_id").val(arsalan);
                $("#pers_spouse_id").val(arsalan);

                document.documentElement.scrollTop = 0;
            });
        } else {
            e.preventDefault();
            alert("Please fill the form");
        }
    });
    /*$("a[id$='-fid']").click(function () {
        var value = $(this).attr("id");
        var id = value.replace("-fid", "");

        $.ajax({
            type: "POST",
            url: "ajax-edit.php",
            data: {
                id: id
            },
            dataType: 'html',
            success: function (data) {
                $('#editdiv').html(data);
                $('#submit').removeAttr("disabled");
                $("#dob,#date_of_appointment").datepicker({dateFormat: 'dd/mm/yy'});
            }
        });
    });

    $("a[id$='-pid']").click(function () {
        var value = $(this).attr("id");
        var id = value.replace("-pid", "");

        $.ajax({
            type: "POST",
            url: "ajax-upload.php",
            data: {
                id: id
            },
            dataType: 'html',
            success: function (data) {
                $('#uploaddiv').html(data);
                $('#submit').removeAttr("disabled");
            }
        });
    });*/

    function minmax(value, min, max)
    {
        if (parseInt(value) < min || isNaN(parseInt(value)))
            return min;
        else if (parseInt(value) > max)
            return max;
        else
            return value;
    }

    function emailIsValid(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
    }

    function cnicIsValid(cnic) {
        return /\d{5}-\d{7}-\d/.test(cnic)
    }

    $("#dob,#date_of_appointment").datepicker({dateFormat: 'dd/mm/yy'});

/*    $("a[id$='-did']").click(function () {
        var value = $(this).attr("id");
        var id = value.replace("-did", "");

        $.ajax({
            type: "POST",
            url: "ajax-detail.php",
            data: {
                id: id
            },
            dataType: 'html',
            success: function (data) {
                $('#detaildiv').html(data);
                $('#submit').removeAttr("disabled");
            }
        });
    });*/
</script>