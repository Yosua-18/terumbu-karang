require(["../common" ], function (common) {  
    require(["main-function","../app/app-penjadwalan"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});