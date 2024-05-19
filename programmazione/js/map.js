// Initialize and add the map
let map;

async function initMap() {
  // The location of Milano
  const position = { lat: 45.4627338, lng: 9.1777323 };
  // Request needed libraries.
  //@ts-ignore
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

  // The map, centered at Milano
  map = new Map(document.getElementById("map"), {
    zoom: 11,
    center: position,
    mapId: "DEMO_MAP_ID",
  });

  set_posizion_stazione(AdvancedMarkerElement);
}

function set_posizion_stazione(AdvancedMarkerElement) {
  // Ottengo tutte le stazioni dal db
  $.get("../AJAX/set_position.php", {}, function (data) {
    // console.log(data);
    if (data["status"] == "ok") {
      data.stations.forEach(station => {
        const position = { lat: parseFloat(station.lat), lng: parseFloat(station.lng) };
        const marker = new AdvancedMarkerElement({
          map: map,
          position: position,
          title: station.name,
        });
      });
    } else if (data["status"] == "ko") {
      alert(data["message"]);
    }
  }, 'json');
}

initMap();
