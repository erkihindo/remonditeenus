var services = [];
var servicedropdown;
var serviceamount;

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
