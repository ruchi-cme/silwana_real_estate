"use strict";
var KTSigninGeneral = function () {
    var t, e, i;
    return {
        init: function () {
            t = document.querySelector("#amenitiesFrom"), e = document.querySelector("#create_button"), i = FormValidation.formValidation(t, {
                fields: {
                    amenity_name: {
                        validators: {
                            notEmpty: {
                                message: "amenity_name   is required"
                            },

                        }
                    },
                    amenity_detail: {
                        validators: {
                            notEmpty: {
                                message: "The amenity_detail is required"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row"
                    })
                }
            }), e.addEventListener("click", (function (n) {
                n.preventDefault(), i.validate().then((function (i) {
                    "Valid" == i ? (
                        e.setAttribute("data-kt-indicator", "on"),
                        e.disabled = !0,
                        document.querySelector("#amenitiesFrom").submit()
                        ) : Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    })
                }))
            }))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTSigninGeneral.init()
}));
