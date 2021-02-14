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
                 var user_id = $("#user_id").val();
                 var location_id = $("#location_id").val();
                 if(user_id.length ==0 && location_id == 0){
                     
                 }else{
                     
                 }
            }
        }
    });
