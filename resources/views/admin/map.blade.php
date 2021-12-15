@extends('layouts.app_admin')

@section('content')
<style type="text/css">
      /* Set the size of the div element that contains the map */
      #map {
        height: 400px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
      }
    </style>
    <script>
      // Initialize and add the map
      function initMap() {
        // The location of Uluru
        const uluru = { lat: 6.5244, lng: 3.3792 };
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 4,
          center: uluru,
        });
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
          position: uluru,
          map: map,
        });
      }
    </script>
<div class="card card-cascade narrower">
    <div class="table-responsive"> 
    <h3> Tracking Riders  </h3>
    <!--The div element for the map -->
    <div id="map"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlzqt-yL_x-fXXTJfI4QpoVkiqwdc-1IU&callback=initMap&libraries=places,geometry&solution_channel=GMP_QB_locatorplus_v4_cA" async defer></script>
    </div>  
</div>
@endsection
