define([
    "jQuery",
    "bootstrap4",
    "superslides",
    "bootsnav",
], function (
    $,
    bootstrap4,
    superslides,
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

                $('#slides-shop').superslides({
                    inherit_width_from: '.cover-slides',
                    inherit_height_from: '.cover-slides',
                    play: 5000,
                    animation: 'fade',
                });
                $(".cover-slides ul li").append("<div class='overlay-background'></div>");
            }
        }
    });
