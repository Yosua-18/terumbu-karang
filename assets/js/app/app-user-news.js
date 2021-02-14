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
            init: function () {
                App.initFunc();
                App.initEvent();
                console.log("loaded");
                $(".loadingpage").hide();
            },

            initEvent: function () {

                 
            }
        }
    });
