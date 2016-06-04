window.onload = function () {
        hideDeviceSearchForm();
        hideDeviceAddForm();
};
    
function showDeviceSearchForm() {
    hideDeviceAddForm();
    document.getElementById('deviceSearchForm').removeAttribute('hidden');
}

function hideDeviceSearchForm() {
    document.getElementById('deviceSearchForm').setAttribute('hidden', true);
}

function showDeviceAddForm() {
    hideDeviceSearchForm();
    document.getElementById('deviceAddForm').removeAttribute('hidden');
}

function hideDeviceAddForm() {
    document.getElementById('deviceAddForm').setAttribute('hidden', true);
}

$.ajax({
    method: 'GET',
    url: urlToGetSoStatusTypes,
    data: { _token: token}
})
.done(function (msg) {
    console.log("Status types: ");
    console.log(msg);
    var dropdown = document.getElementById("order_status");
    for(var i=0; i<msg.length; i++) {
        var option = document.createElement("option");
        option.text = msg[i];
        dropdown.add(option);
    }
 
});


$.ajax({
    method: 'GET',
    url: urlToGetServiceTypes,
    data: { _token: token}
})
.done(function (msg) {
    console.log("Service types: ");
    console.log(msg);
    var dropdown = document.getElementById("service_types");
    for(var i=0; i<msg.length; i++) {
        var option = document.createElement("option");
        option.text = msg[i];
        dropdown.add(option);
    }
 
});
