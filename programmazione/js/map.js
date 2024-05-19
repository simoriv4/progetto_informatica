// Initialize and add the map
let map;

async function initMap() {
  // The location of Uluru
  const position = { lat: 45.4627338, lng: 9.1777323};
  // Request needed libraries.
  //@ts-ignore
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

  // The map, centered at Uluru
  map = new Map(document.getElementById("map"), {
    zoom: 12,
    center: position,
    mapId: "DEMO_MAP_ID",
  });
  // const marker = new AdvancedMarkerElement({
  //   map: map,
  //   position: position,
  //   title: station.name,
  // });

set_posizion_stazione(AdvancedMarkerElement);
}
function set_posizion_stazione(AdvancedMarkerElement) {
  // ottengo tutte le stazioni dal db
  $.get("../AJAX/set_position.php", {}, function (data) {
    if (data["status"] == "ok") {
      data.stations.forEach(station => {
        const position = { lat: station.lat, lng: station.lng };
        const marker = new AdvancedMarkerElement({
          map: map,
          position: position,
          title: station.name,
        });
      });
    }
    else if (data["status"] == "ko") {
      alert(data["message"]);
    }
  });

}
initMap();

