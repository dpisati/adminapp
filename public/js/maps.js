// MAP
var mymap = L.map("mapid").setView([-43.541305, 172.696977], 15);
L.tileLayer(
    "https://api.mapbox.com/styles/v1/dpisati/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}",
    {
        attribution:
            'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: "ckaamrjux14ls1ipf1g8u05nd",
        tileSize: 512,
        zoomOffset: -1,
        accessToken:
            "pk.eyJ1IjoiZHBpc2F0aSIsImEiOiJja2FhbTZ0anoxNjdtMnJxdm1wb3A3b3oyIn0.KkdcCPaC1EfZlZ1OZD883g"
    }
).addTo(mymap);
var marker = L.marker([-43.541305, 172.696977]).addTo(mymap);
// MAP END
