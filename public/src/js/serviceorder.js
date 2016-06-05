var services = [];
var servicedropdown;
var serviceamount;

window.onload = function () {
        hideDeviceSearchForm();
        hideDeviceAddForm();
};

function show(id) {
    document.getElementById(id).removeAttribute('hidden');
}

function hide(id) {
    document.getElementById(id).setAttribute('hidden', true);
}
    
function showDeviceSearchForm() {
    hide('deviceAddForm');
    show('deviceSearchForm');
}

function showDeviceAddForm() {
    hide('deviceSearchForm');
    show('deviceAddForm');
}

//Seadme tüüp
$.ajax({
    method: 'GET',
    url: urlToGetDeviceTypes,
    data: { _token: token}
})
.done(function (msg) {
    console.log("Device types: ");
    console.log(msg);
    var dropdown = document.getElementById("device_type");
    for(var i=0; i<msg.length; i++) {
        var option = document.createElement("option");
        option.text = msg[i][1];
        option.value = msg[i][0];
        dropdown.add(option);
    }
 
});


//tellimuse staatus
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
        option.text = msg[i][1];
        option.value = msg[i][0];
        dropdown.add(option);
    }
 
});

//teenus
$.ajax({
    method: 'GET',
    url: urlToGetServiceTypes,
    data: { _token: token}
})
.done(function (msg) {
    services = msg;
    console.log("Service types: ");
    console.log(services);
    servicedropdown = document.getElementById("service_types");
    for(var i=0; i<services.length; i++) {
        var option = document.createElement("option");
        option.text = services[i][1];
        option.value = services[i][0];
        servicedropdown.add(option);
    }
    
    servicedropdown.addEventListener("change", function() {
        console.log("Changed service " + servicedropdown.value);
        changeUnits();
        calculateTotal();
    });
    serviceamount = document.getElementById("amount1");
    serviceamount.addEventListener("change", function() {
        console.log("Changed amount " + serviceamount.value);
        calculateTotal();
    });
    
    document.getElementById("unit_price1").value = services[0][3];
    document.getElementById("unit_type1").innerHTML = services[0][2];
    
 
});

function changeUnits() {
    if(servicedropdown.value == 1) {
        document.getElementById("unit_price1").value = services[0][3];
    document.getElementById("unit_type1").innerHTML = services[0][2];
    } else if(servicedropdown.value == 2) {
        document.getElementById("unit_price1").value = services[1][3];
    document.getElementById("unit_type1").innerHTML = services[1][2];
    } else {
        document.getElementById("unit_price1").value = services[2][3];
    document.getElementById("unit_type1").innerHTML = services[2][2];
    }
}
function calculateTotal() {
    document.getElementById("total_price1").value = serviceamount.value * document.getElementById("unit_price1").value;
    //ENTER PART PRICE CALCULATION HERE
    
    //ENTER TOTAL PRICE CALCULATION HERE
}


function searchForDevice() {
    console.log("searching");
    var device_name = document.getElementById("device_name").value;
    var model = document.getElementById("model").value;
    var serial_nr = document.getElementById("serial_nr").value;
    var manufacturer = document.getElementById("manufacturer").value;
    var device_type = document.getElementById("device_type").value;
    var client_name = document.getElementById("client_name").value;
    
    
    
    $.ajax({
    method: 'GET',
    url: urlToSearchDevices,
    data: {device_name: device_name,model: model, serial_nr: serial_nr,manufacturer: manufacturer, device_type: device_type,client_name: client_name,  _token: token}
    }).done(function (msg) {
        console.log("Searched: ");
        console.log(msg);
        

    });
    
}