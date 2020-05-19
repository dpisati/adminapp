// MAP
var pin = L.icon({
    iconUrl: "/images/pin.png",
    url: "https://goo.gl/maps/PkC2ub5uTL7F8cfHA",
    iconSize: [45, 45], // size of the icon
    iconAnchor: [20, 60], // point of the icon which will correspond to marker's location
    popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
});

var mymap = L.map("mapid").setView([-43.541305, 172.696977], 15);
L.tileLayer(
    "https://api.mapbox.com/styles/v1/dpisati/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}",
    {
        attribution:
            'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        zoomAnimation: true,
        id: "ckaamrjux14ls1ipf1g8u05nd",
        tileSize: 512,
        zindex: 1,
        zoomOffset: -1,
        accessToken:
            "pk.eyJ1IjoiZHBpc2F0aSIsImEiOiJja2FhbTZ0anoxNjdtMnJxdm1wb3A3b3oyIn0.KkdcCPaC1EfZlZ1OZD883g"
    }
).addTo(mymap);
var marker = L.marker([-43.541305, 172.696977], {
    icon: pin
}).addTo(mymap);

function onMapClick(e) {
    window.open("https://goo.gl/maps/PkC2ub5uTL7F8cfHA", "_blank");
}

marker.on("click", onMapClick);

// MAP END
