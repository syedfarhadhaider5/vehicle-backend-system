function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -33.8688, lng: 151.2195},
        zoom: 13
    });
    var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    autocomplete.addListener('place_changed', function () {

        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }

        for (var i = 0; i < place.address_components.length; i++) {
            // for (var j = 0; j < place.address_components[i].types.length; j++) {
            //     if (place.address_components[i].types[j] == "postal_code") {
            //         document.getElementById('becustomer-zip').value = place.address_components[i].long_name;
            //     }
            //
            //     if (place.address_components[i].types[j] == "country") {
            //         document.getElementById('becustomer-country').value = place.address_components[i].short_name;
            //     }
            //
            //     if (place.address_components[i].types[j] == "administrative_area_level_1") {
            //         document.getElementById('becustomer-province').value = place.address_components[i].short_name;
            //     }
            //
            //     if (place.address_components[i].types[j] == "locality") {
            //         document.getElementById('becustomer-city').value = place.address_components[i].long_name;
            //     }
            // }
        }
        // Location details
        // for (var i = 0; i < place.address_components.length; i++) {
        //     if(place.address_components[i].types[0] == 'postal_code'){
        //         document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
        //     }
        //     if(place.address_components[i].types[0] == 'country'){
        //         document.getElementById('country').innerHTML = place.address_components[i].long_name;
        //     }
        // }
        $('#searchInput').val(place.formatted_address);
    });
}

