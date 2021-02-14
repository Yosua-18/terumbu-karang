require(["../common" ], function (common) {  
    require(["main-function","../app/app-orders"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});