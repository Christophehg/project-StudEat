// Initialize and add the map
function initMap () {
  // The location of Esin
  const esin = { lat: 48.8798491, lng: 2.3657837 }
  const resto = { lat: 48.8819448, lng: 2.3667026 }
  const elNopal = { lat: 48.877844, lng: 2.3651419 }
  // The map, centered at Esin
  const map = new google.maps.Map(document.getElementById('map'), {
  zoom: 16,
  center: esin
  })
  // The marker, positioned at Esin
  const marker = new google.maps.Marker({
  position: esin,
  map: map
  })
  // The marker, positioned at Esin
  const marker1 = new google.maps.Marker({
  position: resto,
  map: map
  })
  // The marker, positioned at Esin
  const marker2 = new google.maps.Marker({
  position: elNopal,
  map: map
  })
  }
  window.initMap = initMap


  function updatemenu() {
    if (document.getElementById('responsive-menu').checked == true) {
      document.getElementById('menu').style.borderBottomRightRadius = '0';
      document.getElementById('menu').style.borderBottomLeftRadius = '0';
    }else{
      document.getElementById('menu').style.borderRadius = '16px';
    }
  }