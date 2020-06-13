/*price range*/

$("#sl2").slider();

var RGBChange = function() {
    $("#RGB").css(
        "background",
        "rgb(" + r.getValue() + "," + g.getValue() + "," + b.getValue() + ")"
    );
};

/*scroll to top*/

$(document).ready(function() {
    $(function() {
        $.scrollUp({
            scrollName: "scrollUp", // Element ID
            scrollDistance: 300, // Distance from top/bottom before showing element (px)
            scrollFrom: "top", // 'top' or 'bottom'
            scrollSpeed: 300, // Speed back to top (ms)
            easingType: "linear", // Scroll to top easing (see http://easings.net/)
            animation: "fade", // Fade, slide, none
            animationSpeed: 200, // Animation in speed (ms)
            scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
            //scrollTarget: false, // Set a custom target element for scrolling to the top
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
            scrollTitle: false, // Set a custom <a> title if required.
            scrollImg: false, // Set true to use image
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
    });
});
$(document).ready(function() {
    /*********change price & stockin details page */
    $("#selSize").change(function() {
        var idSize = $(this).val();
        if (idSize == "") {
            return false;
        }
        $.ajax({
            type: "get",
            url: "/get-product-price",
            data: { idSize: idSize },
            success: function(resp) {
                // alert(resp);
                // return false;
                var arr = resp.split("#");
                $("#getPrice").html("US $" + arr[0]);
                $("#price").val(arr[0]);
                if (arr[1] == 0) {
                    $("#cartButton").hide();
                    $("#Availability").text("Out Of Stock");
                } else {
                    $("#cartButton").show();
                    $("#Availability").text(arr[1] + " Left In Stock");
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });
});
/******************image change******************** */
$(document).ready(function() {
    $(".changeImage").click(function() {
        var image = $(this).attr("src");
        $(" .mainImage").attr("src", image);
    });
});

/********js for easyzoom*******************/
// Instantiate EasyZoom instances
var $easyzoom = $(".easyzoom").easyZoom();

// Setup thumbnails example
var api1 = $easyzoom.filter(".easyzoom--with-thumbnails").data("easyZoom");

$(".thumbnails").on("click", "a", function(e) {
    var $this = $(this);

    e.preventDefault();

    // Use EasyZoom's `swap` method
    api1.swap($this.data("standard"), $this.attr("href"));
});

// Setup toggles example
var api2 = $easyzoom.filter(".easyzoom--with-toggle").data("easyZoom");

$(".toggle").on("click", function() {
    var $this = $(this);

    if ($this.data("active") === true) {
        $this.text("Switch on").data("active", false);
        api2.teardown();
    } else {
        $this.text("Switch off").data("active", true);
        api2._init();
    }
});
setTimeout(function() {
    $(".alert").slideUp();
}, 10000);

$().ready(function() {
    //validate register form on keyup and submit
    // $("#registerForm").validate({
    //     rules: {
    //         name: {
    //             required: true,
    //             minlength: 2
    //         },
    //         password: {
    //             required: true
    //         },
    //         email: {
    //             required: true,
    //             email: true,
    //             remote: "/check-email"
    //         },
    //         conpassword: {
    //             required: true,
    //             equalTo: "#myPassword"
    //         }
    //     },
    //     messages: {
    //         name: {
    //             required: "Please Enter Your Name",
    //             minlength: "Your name must be atleast of 2 character"
    //         },
    //         password: {
    //             required: "Please Provide Your Password"
    //         },
    //         email: {
    //             required: "Please enter your Email",
    //             email: "Please Enter valid email",
    //             remote: "Email already exists"
    //         },
    //         conpassword: "Passwords donot match"
    //     }
    // });
    $("#registerForm").validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true
            },
            password: {
                required: true
            },
            conpassword: {
                required: true,
                equalTo: "#myPassword"
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

    //password strength script
    $("#myPassword").passtrength({
        minChars: 6,
        passwordToggle: true,
        tooltip: true,
        eyeImg: "/images/frontend_images/eye.svg"
    });
    $("#conpassword").passtrength({
        minChars: 6,
        passwordToggle: true,
        tooltip: true,
        eyeImg: "/images/frontend_images/eye.svg"
    });
    $("#loginForm").validate({
        rules: {
            password: {
                required: true
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            password: {
                required: "Please Provide Your Password"
            },
            email: {
                required: "Please enter your Email",
                email: "Please Enter valid email"
            }
        }
    });
    $("#forgotPasswordForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            email: {
                required: "Please enter your Email",
                email: "Please Enter valid email"
            }
        }
    });
    $("#accountForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            address: {
                required: true
            },
            city: {
                required: true
            },
            state: {
                required: true
            },
            country: {
                required: true
            },
            mobile: {
                required: true,
                number: true
            }
        }
    });
    //check current user pwd
    $("#current_pwd").keyup(function() {
        var current_pwd = $(this).val();
        // alert(current_pwd);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "post",
            url: "/check-user-pwd",
            data: { current_pwd: current_pwd },
            success: function(resp) {
                if (resp == "false") {
                    $("#chkPwd").html(
                        "<font style='font-size:13px' color='red'>Incorrect Password</font>"
                    );
                } else if (resp == "true") {
                    $("#chkPwd").html(
                        "<font style='font-size:13px' color='green'>Correct Password </font>"
                    );
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

    $("#passwordForm").validate({
        rules: {
            current_pwd: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            new_pwd: {
                required: true
            },
            confirm_pwd: {
                required: true,
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

    $("#new_pwd").passtrength({
        minChars: 6,
        passwordToggle: true,
        tooltip: true,
        eyeImg: "/images/frontend_images/eye.svg"
    });
    $("#confirm_pwd").passtrength({
        minChars: 6,
        passwordToggle: true,
        tooltip: true,
        eyeImg: "/images/frontend_images/eye.svg"
    });
    //copy billind details to shipping details
    $("#copyAddress").on("click", function() {
        if (this.checked) {
            $("#shipping_name").val($("#billing_name").val());
            $("#shipping_address").val($("#billing_address").val());
            $("#shipping_city").val($("#billing_city").val());
            $("#shipping_state").val($("#billing_state").val());
            $("#shipping_country").val($("#billing_country").val());
            $("#shipping_pincode").val($("#billing_pincode").val());
            $("#shipping_mobile").val($("#billing_mobile").val());
        } else {
            $("#shipping_name").val("");
            $("#shipping_address").val("");
            $("#shipping_city").val("");
            $("#shipping_state").val("");
            $("#shipping_country").val("");
            $("#shipping_pincode").val("");
            $("#shipping_mobile").val("");
        }
    });
});

function selectPaymentMethod() {
    // if ($("#COD").is(":checked") || $("#Paypal").is(":checked")) {
    if ($("#COD").is(":checked")) {
        // alert("checked");
    } else {
        alert("Please select a payment method");
        return false;
    }
}

$(document).on("ready", function() {
    $(".regular").slick({
        dots: false,
        slidesToShow: 8,
        slidesToScroll: 4,
        autoplay: true,
        autoplaySpeed: 4000,
        arrows: false,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    $(".regular1").slick({
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        infinite: false,
        autoplay: true
    });
});
