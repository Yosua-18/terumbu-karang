define([
    "jQuery",
    "bootstrap4",,
    "bootsnav"
], function (
    $,
    bootstrap4,
    bootsnav,
    ) {
        return {
            init: function () {
                App.initFunc();
                App.initEvent();
                console.log("loaded");
                $(".loadingpage").hide();
            },

            initEvent: function () {
                $(".remove-item").on("click",function(){
                    var id = $(this).data("id");
                    var location_id = $("#location_id").val();
                    $.ajax({
                      method: "POST",
                      data: data,
                      url: App.url+"shop/remove_product/"+id
                    }).done(function( msg ) {
                        console.log();
                        window.location.href =App.url+"cart/"+location_id;
                    });
                });
            }
        }
    });
