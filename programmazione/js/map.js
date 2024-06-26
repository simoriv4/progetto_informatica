class map {
  constructor() {
    this.map = null;
  }

  async initMap() {
    // The location of Milano
    const position = { lat: 45.4627338, lng: 9.1777323 };

    // Request needed libraries.
    //@ts-ignore
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

    // The map, centered at Milano
    this.map = new Map(document.getElementById("map"), {
      zoom: 12,
      center: position,
      mapId: "DEMO_MAP_ID",
    });

    this.setPosizioneStazione(AdvancedMarkerElement);  // Chiamata al metodo della classe
  }

  async setPosizioneStazione(AdvancedMarkerElement) {
    // Ottengo tutte le stazioni dal db
    $.get("../AJAX/set_position.php", {}, (data) => {
      if (data["status"] == "ok") {
        data.stations.forEach(station => {
          const position = { lat: parseFloat(station.lat), lng: parseFloat(station.lng) };
          const marker = new AdvancedMarkerElement({
            map: this.map,  // Usare this.map
            position: position,
            title: station.name,
          });
        });
      } else if (data["status"] == "ko") {
        alert(data["message"]);
      }
    }, 'json');
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const mapAdminInstance = new map();
  mapAdminInstance.initMap();
});
