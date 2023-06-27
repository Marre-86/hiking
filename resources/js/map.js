  var elevation_options = {
    position: "bottomleft",
    theme: "lightblue-theme",
    detached: true,
    collapsed: false,
    autohide: false,
    almostOver: true,
    edgeScale: false,
    width: 600,
    height: 150,
    waypoints: false,
  };
  var ghyb = L.tileLayer("https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}", {
    maxZoom: 19,
    attribution: 'Google Hybrid',
    subdomains: ['mt0','mt1','mt2','mt3']
  });

  var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
  });

  // Instantiate map (leaflet-ui).
  var map = L.map('map', {
        layers: [osm],
  });

  L.control.fullscreen({
    position: 'topleft', // change the position of the button can be topleft, topright, bottomright or bottomleft, default topleft
    title: 'Show me the fullscreen !', // change the title of the button, default Full Screen
    titleCancel: 'Exit fullscreen mode', // change the title of the button when fullscreen is on, default Exit Full Screen
    content: null, // change the content of the button, can be HTML, default null
    forceSeparateButton: true, // force separate button to detach from zoom buttons, default false
    forcePseudoFullscreen: true, // force use of pseudo full screen even if full screen API is available, default false
    fullscreenElement: false // Dom element to render in full screen, false by default, fallback to map._container
  }).addTo(map);

  map.on('enterFullscreen', function () {
    elevation_options.detached = false;
    elevation_options.height = 300;
    updateElevation();
  });
  
  map.on('exitFullscreen', function () {
    elevation_options.detached = true;
    elevation_options.height = 150;
    updateElevation();
  });

  function updateElevation() {
    if (controlElevation) {
      map.removeControl(controlElevation);
      controlElevation = L.control.elevation(elevation_options).addTo(map);
      controlElevation.load("/gpx/ala-archa.gpx");
    }
  }

  var baseMaps = {
    "OpenStreetMap": osm,
    "Google Hybrid": ghyb
  };

  var layerControl = L.control.layers(baseMaps).addTo(map);

  // Instantiate elevation control.
  var controlElevation = L.control.elevation(elevation_options).addTo(map);

  // Load track from url (allowed data types: "*.geojson", "*.gpx", "*.tcx")
  controlElevation.load("/gpx/ala-archa.gpx");
