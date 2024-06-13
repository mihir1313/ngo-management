$(document).ready(function () {
    $('#donateModal').on('hidden.bs.modal', function () {
        $('#stripe_form')[0].reset();
        $('#ModalTitle').html('');
    });

    $("#chectoutform").validate({
        rules: {
            "first_name": {
                required: true,
            },
            "last_name": {
                required: true,

            },
            "company": {
                required: true,

            },
            "email": {
                required: true,
                email: true,
            },

            "state": {
                required: true,

            },

            "street_address": {
                required: true,

            },

            "city": {
                required: true,

            },
            "zipCode": {
                required: true,

            },
            "phonenumber": {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            }

        },
        messages: {

            "first_name": {
                required: "First Name is required",

            },
            "last_name": {
                required: "Last Name is required",

            },
            "company": {
                required: "Company is required",
            },
            "email": {
                required: "Email is required",
                email: "Invalid email address. Please enter a valid email address",
            },
            "state": {
                required: "State is required",

            },
            "street_address": {
                required: "Street Address is required",

            },
            "city": {
                required: "City is required",
            },
            "zipCode": {
                required: "ZipCode is required",
                digits: " ZipCode can only contain numbers",
            },
            "phonenumber": {
                required: "Phone number is required",
                digits: " Phone number can only contain numbers",
                minlength: " Phone number must contain min 10 characters",
                maxlength: " Phone number must contain max 10 characters",
            }

        }
    })

    $("#stripe_form").validate({
        rules: {
            "nameoncard": {
                required: true,
            },
            "cardnumber": {
                required: true,
                digits: true,
                minlength: 16,
                maxlength: 16,

            },
            "expirymonth": {
                required: true,
                digits: true,
                range: {
                    depends: function () {
                        var date = new Date($("#expiryyear").val(), $("#expirymonth").val() - 1);
                        return date < new Date(new Date().getFullYear(), new Date().getMonth());

                    }
                },

            },
            "expiryyear": {
                required: true,
                digits: true,
                range: [new Date().getFullYear(), new Date().getFullYear() + 50],
            },
            "securitycode": {
                required: true,
                digits: true,
                minlength: 3,
                maxlength: 3,
            },
            "amount": {
                required: true,
                digits: true,
            },
        },
        messages: {
            "nameoncard": {
                required: "Name On Card required",

            },
            "cardnumber": {
                required: "Card Number is required",
                digits: "Card Numbercan only contain numbers",
                minlength: "Card Number must contain min 16 characters",
                maxlength: "Card Number must contain max 16 characters",

            },
            "expirymonth": {
                required: "Expiry Month is required",
                digits: "Expiry Month can only contain numbers",
                range: " you can't enter past month please enter valid month",

            },
            "expiryyear": {
                required: "Expiry Year is required",
                digits: "Expiry Yearc contain numbers",
                range: "you can't enter past year please enter valid year"

            },
            "securitycode": {
                required: "SecurityCode is required",
                digits: "SecurityCode can only contain numbers",
                minlength: "SecurityCode must contain min 3 characters",
                maxlength: "SecurityCode must contain max 3 characters",

            },
            "amount": {
                required: "Amount is required",
                digits: "Amount can only contain numbers",
            },
        }
    })

    // $(document).on("click", ".Chectout", function () {
    //     showloader();
    //     var valid = $("#chectoutform").valid();
    //     if (valid) {

    //         var record = $("#chectoutform").serialize();
    //         var payment_type = $('input[name="payment_type"]:checked').val();
    //         if (payment_type != undefined && payment_type == "caseondelivery") {
    //             $.ajax({
    //                 url: BASE_URL + "/product/chectout",
    //                 type: "post",
    //                 data: record,
    //                 success: function (response) {
    //                     var result = JSON.parse(response);

    //                     if (result.status == 1) {
    //                         showloader();
    //                         $("#thankModal").modal("show");
    //                         setTimeout(function () { $('#thankModal').modal('hide'); }, 5000);
    //                         successMsg(result.msg);
    //                         $('#thankModal').on('hidden.bs.modal', function () {
    //                             window.location.href = BASE_URL + '/shop';
    //                         })
    //                         hideloader();
    //                     } else {
    //                         errorMsg(result.msg);
    //                         hideloader();
    //                     }
    //                 }
    //             })
    //         } else if (payment_type != undefined && payment_type == "stripe") {

    //             $('#stripeModal').modal('show');
    //             showloader();

          
    //         }
    //     }
    // })


    $(document).on("click", ".pay", function () {
        showloader();
        var validation = $("#stripe_form").valid();
        if (validation) {
            showloader();
            var record = $('#chectoutform, #stripe_form').serialize();
            $.ajax({
                url: BASE_URL + "/donate/stripe",
                type: "post",
                data: record,
                success: function (response) {
                    var result = JSON.parse(response);
                    console.log(result)
                    if (result.status == 1) {
                        // var spin =$(".pay").find(".fa-spinner").remove();
                        // $(".pay").removeAttr("disabled");
                        showloader();
                        successMsg(result.msg);
                        $('#donateModal').modal('hide');
                        $('#paymentsuceesfully').modal("show"),
                            setTimeout(function () { $('#paymentsuceesfully').modal('hide'); }, 5000);
                        hideloader();
                        // window.NavigationPreloadManager()
                        $('#paymentsuceesfully').on('hidden.bs.modal', function () {
                            window.location.href = BASE_URL + '/causes';
                        })
                    } else {
                        errorMsg(result.msg);
                        hideloader();
                    }
                }
            })
        }
    })

    $(document).on("keyup", "#nameoncard", function () {

        var nameoncard = $('#nameoncard').val();
        $("#holdername").html(nameoncard);

    })
    $(document).on("keyup", "#cardnumber", function () {

        var cardnumber = $('#cardnumber').val();
        $("#cardno").html(cardnumber);

    })
    $(document).on("keyup", "#expirydate", function () {

        var expirydate = $('#expirydate').val();
        $("#date").html(expirydate);
    })

    $(document).on('click','#donateBtn',function(){
        var causeId = $(this).data('id');

        var heading = $('#causeHeading'+causeId).html();
        $('#ModalTitle').html('');
        $('#ModalTitle').html(heading);

        $('#causeId').val(causeId);
        $('#donateModal').modal('show');
    })
})
