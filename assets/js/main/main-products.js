require(["../common" ], function (common) {  
    require(["main-function","../app/app-products"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});