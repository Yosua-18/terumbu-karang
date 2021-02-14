define([
    "jQuery",
    "bootstrap4",
    "bootsnav",
    "leaflet"
], function (
    $,
    bootstrap4, 
    bootsnav , 
    leaflet 
    ) {
        return { 
            url:$("#base_url").val(),
            init: function () {
                App.initFunc();
                App.initEvent();
                App.loadMap();
                console.log("loaded");
                $(".loadingpage").hide(); 
            },

            initEvent: function () { 
                $("#pilih-lokasi").on("click",function(){
                    // console.log($("#id").val());
                   $('#map-detail').modal('hide');
                    window.location.href=App.url+"shop/"+$("#id").val();
                });
            },
            loadMap:function(){
                var mymap = L.map('map-container').setView([-5.132193, 119.488449], 4); 
                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                    maxZoom: 20,
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    id: 'mapbox/streets-v11',
                    tileSize: 512,
                    zoomOffset: -1
                }).addTo(mymap);
                $.ajax({
                  method: "GET",
                  url: App.url+"map/locations"
                }).done(function( msg ) { 
                    var json = JSON.parse(msg);
                    var locations = json.data;
                    console.log(locations);
                    for (var i = 0; i < locations.length; i++) { 
                        var coord = [locations[i].lat, locations[i].long];
                        var data = {
                            id: locations[i].id,
                            name: locations[i].name,
                            lat: locations[i].lat,
                            long: locations[i].long,
                            luas: locations[i].luas,
                            kerusakan: locations[i].kerusakan
                        };
                        L.marker(coord, data).addTo(mymap).on('click', function(e){ 
                            App.getDetail(e);
                        }); 
                    }
                }); 
            },
            getDetail:function(e){ 
                console.log(e.target.options); 

                $("#id").val(e.target.options.id);
                $(".nama").html(" :"+e.target.options.name);
                $(".lat").html(" :"+e.target.options.lat);
                $(".long").html(" :"+e.target.options.long);
                $(".luas").html(" :"+e.target.options.luas);
                $(".kerusakan").html(" :"+e.target.options.kerusakan);
                $('#map-detail').modal({backdrop: 'static', keyboard: false})  
            }
        }
    });
