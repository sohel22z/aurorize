const componentForm = {
    locality: "long_name",
    country: "long_name",
};
const componentForm1 = {
    country: "long_name",
};

function init() {
    var inputs = document.getElementsByClassName('address');

    var options = {
        //types: ['geocode'],
        /*componentRestrictions: {country: 'ch'}*/
    };
    var autocompletes = [];
    for (var i = 0; i < inputs.length; i++) {
        var autocomplete = new google.maps.places.Autocomplete(inputs[i], options);
        autocomplete.inputId = inputs[i];
        autocomplete.addListener('place_changed', fillIn);
        autocompletes.push(autocomplete);
    
        inputs[i].addEventListener('keyup', function(){
            var _parent = $(this).closest('.location-group');
            $(_parent).find('.location, .latitude, .longitude, .country').val("");
        });
    }
}
function fillIn() {
    var _parent = $(this.inputId).closest('.location-group');
    var place = this.getPlace();

    var location = [], country = [];
    // Get each component of the address from the place details, and then fill-in the corresponding field on the form.
    for (const component of place.address_components) {
        const addressType = component.types[0];
        if (componentForm[addressType]) {
            location.push(component[componentForm[addressType]]);
        }
    }
    for (const component of place.address_components) {
        const addressType = component.types[0];
        if (componentForm1[addressType]) {
            country.push(component[componentForm1[addressType]]);
        }
    }

    $(_parent).find('.location').val(location.join(', '));
    $(_parent).find('.latitude').val(place.geometry.location.lat());
    $(_parent).find('.longitude').val(place.geometry.location.lng());
    $(_parent).find('.country').val(country.join(', '));
    $(_parent).find('.address').trigger('blur');

    $('#lat').val(place.geometry.location.lat());
    $('#long').val(place.geometry.location.lng());
    $('#loc').val(place.formatted_address).blur();
    $('#address').trigger('blur');
}
init();