function initMap() {
  var uluru = {
    lat: 48.94180590000001,
    lng: 2.577942300000018
  };
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: uluru
  });
  var marker = new google.maps.Marker({
    position: uluru,
    map: map
  });
}
