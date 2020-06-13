$(document).ready(function() {

    $("#type").change(function(){
        var type = $("#type").val();
        // alert (type);
        if (type == "Admin") {
            //
            $("#permissions").addClass("hidden")
            
        }else{
            //
            $("#permissions").removeClass("hidden");
        }
    });
    $("#current_pwd").keyup(function() {
        var current_pwd = $(this).val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "post",
            url: "/admin/checkpass",

            data: { current_pwd: current_pwd },
            success: function(response) {
                console.log(response);
                if (response == "false") {
                    $("#checkpassword").html(
                        "<font color='red'> Incorrect Password</font>"
                    );
                } else if (response == "true") {
                    $("#checkpassword").html(
                        "<font color='green'> Correct Password</font>"
                    );
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

    $("input[type=checkbox],input[type=radio],input[type=file]").uniform();
    $("select").select2();
    $("#password_validate").validate({
        rules: {
            current_pwd: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            new_pwd: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            confirm_pwd: {
                required: true,
                minlength: 6,
                maxlength: 20,
                equalTo: "#new_pwd"
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element)
                .parents(".control-group")
                .addClass("error");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element)
                .parents(".control-group")
                .removeClass("error");
            $(element)
                .parents(".control-group")
                .addClass("success");
        }
    });
    /***********************category add validations******************************/
    $("#add_category").validate({
        rules: {
            category_name: {
                required: true
            },
            description: {
                required: true
            },
            url: {
                required: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element)
                .parents(".control-group")
                .addClass("error");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element)
                .parents(".control-group")
                .removeClass("error");
            $(element)
                .parents(".control-group")
                .addClass("success");
        }
    });

    /**************************************product add validations***************** */
    $("#add_product").validate({
        rules: {
            category_name: {
                required: true
            },
            product_name: {
                required: true
            },
            product_code: {
                required: true
            },
            product_color: {
                required: true
            },
            price: {
                required: true,
                number: true
            },
            image: {
                required: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element)
                .parents(".control-group")
                .addClass("error");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element)
                .parents(".control-group")
                .removeClass("error");
            $(element)
                .parents(".control-group")
                .addClass("success");
        }
    });
    /**************************************product edit validations***************** */

    $("#edit_product").validate({
        rules: {
            category_name: {
                required: true
            },
            product_name: {
                required: true
            },
            product_code: {
                required: true
            },
            product_color: {
                required: true
            },
            price: {
                required: true,
                number: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element)
                .parents(".control-group")
                .addClass("error");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element)
                .parents(".control-group")
                .removeClass("error");
            $(element)
                .parents(".control-group")
                .addClass("success");
        }
    });

    /**************************************sweet alert delete********************** */
    $(".deleteRecord").click(function() {
        var id = $(this).attr("rel");
        var deleteFunction = $(this).attr("rel1");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to recover deleted data !!",
            icon: "error",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#000",
            confirmButtonText: "Yes, delete it!"
        }).then(result => {
            if (result.value) {
                window.location.href = "/admin/" + deleteFunction + "/" + id;
            }
        });
    });
});
$(document).ready(function() {
    var maxField = 10; //Input fields increment limitation
    var addButton = $(".add_button"); //Add button selector
    var wrapper = $(".field_wrapper"); //Input field wrapper
    var fieldHTML =
        '<div class="field_wrapper" style="margin-top:5px;"> <input type="text" name="sku[]"  id="sku"  placeholder="SKU" required/> <input type="text" name="size[]"  id="Size"  placeholder="Size" required/> <input type="number" name="price[]"  id="price"  placeholder="Price" required/> <input type="number" name="stock[]"  id="stock"  placeholder="Stock" required/> <a href="javascript:void(0);" class="remove_button btn btn-danger"><i class="icon-minus"></i></a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function() {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on("click", ".remove_button", function(e) {
        e.preventDefault();
        $(this)
            .parent("div")
            .remove(); //Remove field html
        x--; //Decrement field counter
    });
});

