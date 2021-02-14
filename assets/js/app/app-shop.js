define([
    "jQuery",
    "bootstrap4",
    "bootsnav"
], function (
    $,
    bootstrap4, 
    bootsnav 
    ) {
        return {
            
            url:$("#base_url").val(),
            init: function () {
                App.initFunc();
                App.initEvent();
                console.log("loaded");
                $(".loadingpage").hide();
            },

            initEvent: function () {
                var location_id = $('#location_id').val();
                App.addToCart();
                 
            },
            addToCart:function(){
                $(".cart").on("click",function(){
                    var id = $(this).data("id");
                    var name = $(this).data("name");
                    var price = $(this).data("price");
                    var photo = $(this).data("photo"); 
                    var size = $(this).data("size");  
                    var location_id = $('#location_id').val();  
                    var data = {
                        id:id,
                        name:name,
                        price:price,
                        photo:photo,
                        size:size,
                        location_id:location_id
                    };

                    console.log(data);

                    $.ajax({
                      method: "POST",
                      data: data,
                      url: App.url+"shop/add_to_cart"
                    }).done(function( msg ) {
                        console.log();
                        window.location.href =App.url+"cart/"+location_id;
                    });
                });
            }
        }
    });
