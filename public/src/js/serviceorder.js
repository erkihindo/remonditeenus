var services = [];
var serviceamount;
var rowCount = 2;
var parts = [];
var services = [];

window.onload = function () {
        hide('deviceAddForm');
        hide('deviceSearchForm');
        hide('searchResultDiv');
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
    var dropdown1 = document.getElementById("device_type1");
    for(var i=0; i<msg.length; i++) {
        var option1 = document.createElement("option");
        option1.text = msg[i][1];
        option1.value = msg[i][0];
        dropdown1.add(option1);
    }
    
    var dropdown2 = document.getElementById("device_type2");
    for(var i=0; i<msg.length; i++) {
        var option2 = document.createElement("option");
        option2.text = msg[i][1];
        option2.value = msg[i][0];
        dropdown2.add(option2);
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
    if(dropdown.value != 3) {
        document.getElementById("arve_nupp").style.display = 'none';
    }
    dropdown.addEventListener("change", function() {
        console.log("Changed order status " + dropdown.text);
        if(dropdown.value == 3) {
            document.getElementById("arve_nupp").style.display = 'block';
        } else {
            document.getElementById("arve_nupp").style.display = 'none';
        }
    });
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
    populateServiceDropdown(1);
});

function populateServiceDropdown(rowNo) {
    for(var i=0; i<services.length; i++) {
        var option = document.createElement("option");
        option.text = services[i][1];
        option.value = services[i][0];
        document.getElementById("service_types" + rowNo).add(option);
    }
    changeUnits(rowNo);
    calculateTotal(rowNo);
    /*servicedropdown.addEventListener("change", function() {
        console.log("Changed service " + servicedropdown.value);
        changeUnits(rowNo);
        calculateTotal(rowNo);
    });
    serviceamount = document.getElementById("amount1");
    serviceamount.addEventListener("change", function() {
        console.log("Changed amount " + serviceamount.value);
        calculateTotal(rowNo);
    });
    
    unit_price = document.getElementById("unit_price1");
    unit_price.value = services[0][3];
    unit_price.addEventListener("change", function() {
        calculateTotal(rowNo);
    });*/
    //document.getElementById("unit_type2").innerHTML = services[0][2];  
}

function changeUnits(rowNo) {
    var servicedropdown = document.getElementById("service_types" + rowNo);
    if(servicedropdown.value == 1) {
        document.getElementById("unit_price" + rowNo).value = services[0][3];
        document.getElementById("unit_type" + rowNo).innerHTML = services[0][2];
    } else if(servicedropdown.value == 2) {
        document.getElementById("unit_price" + rowNo).value = services[1][3];
        document.getElementById("unit_type" + rowNo).innerHTML = services[1][2];
    } else {
        document.getElementById("unit_price" + rowNo).value = services[2][3];
        document.getElementById("unit_type" + rowNo).innerHTML = services[2][2];
    }
    calculateTotal(rowNo);
}

function calculateTotal(rowNo) {
    var total = 0;
    document.getElementById("total_price" + rowNo).value = document.getElementById("unit_price" + rowNo).value * document.getElementById("amount" + rowNo).value;
    
    for (var i = 1; i <= rowCount; i++) {
        total += parseInt(document.getElementById('total_price' + i).value);
    }
    document.getElementById("total").innerHTML = total;
}

function createDevice() {
    var device_name = document.getElementById("name1").value;
    var model = document.getElementById("model1").value;
    var serial_nr = document.getElementById("serial_nr1").value;
    var manufacturer = document.getElementById("manufacturer1").value;
    var device_type = document.getElementById("device_type1").value;
    var description = document.getElementById("description1").value;
    
    $.ajax({
    method: 'POST',
    url: urlToCreateDevice,
    data: {name: device_name,model: model, serial_nr: serial_nr,description: description ,manufacturer: manufacturer, type: device_type,  _token: token}
    }).done(function (msg) {
        console.log("Created new device: ");
        console.log(msg);
        
    });
}


function searchForDevice() {
    console.log("searching");
    var device_name = document.getElementById("device_name2").value;
    var model = document.getElementById("model2").value;
    var serial_nr = document.getElementById("serial_nr2").value;
    var manufacturer = document.getElementById("manufacturer2").value;
    var device_type = document.getElementById("device_type2").value;
    var client_name = document.getElementById("client_name2").value;
    
    
    
    $.ajax({
    method: 'GET',
    url: urlToSearchDevices,
    data: {device_name: device_name,model: model, serial_nr: serial_nr,manufacturer: manufacturer, device_type: device_type,client_name: client_name,  _token: token}
    }).done(function (devicesfound) {
        console.log("Searched: ");
        console.log(devicesfound);
        var printout = "";
        for (var i = 0; i < devicesfound.length; i++) {
            printout += '<li>';
            printout += devicesfound[i].name;
            printout += ' ' + devicesfound[i].model;
            printout += ' ' + devicesfound[i].reg_no;
            printout += ' ' + '<a href="javascript:addToOrder(' + devicesfound[i].id + ');" target="_self">lisa tellimusele</a>';
            printout += '</li>';
        }
        document.getElementById("search_result").innerHTML = printout;
        show('searchResultDiv');
    });
    
}

function addToOrder(id) {
    console.log("Adding to order");
    var deviceDropdown = document.getElementById("device");
    var option = document.createElement("option");
    option.value = id;
    
    
        $.ajax({
        method: 'GET',
        url: urlToGetDeviceName,
        data: {id: id, _token: token}
    })
    .done(function (msg) {
        option.text = msg;
        deviceDropdown.add(option);
    });
    hide('deviceSearchForm');
    hide('searchResultDiv');
}

function addNewService() {
    rowCount++;
    var row = document.getElementById('orderTable').insertRow(rowCount + 2);
    row.insertCell(0).innerHTML = 'Töö';
    row.insertCell(1).innerHTML = '<input type="text" name="service"' + rowCount + '>';
    row.insertCell(2).innerHTML = 'Teenus:';
    row.insertCell(3).innerHTML = '<select name="service' + rowCount + '" id="service_types' + rowCount + '" onchange="changeUnits(' + rowCount + ');"></select>';   
    row.insertCell(4).innerHTML = 'kogus:';
    row.insertCell(5).innerHTML = '<input type="number" name="amount' + rowCount + '" id="amount' + rowCount + '" onchange="calculateTotal(' + rowCount + ');">';   
    row.insertCell(6).innerHTML = '<span id="unit_type' + rowCount + '"></span>';    
    row.insertCell(7).innerHTML = 'ühiku hind:';
    row.insertCell(8).innerHTML = '<input type="number" name="unit_price' + rowCount + '" id="unit_price' + rowCount + '" onchange="calculateTotal(' + rowCount + ');">';
    row.insertCell(9).innerHTML = 'hind kokku:';
    row.insertCell(10).innerHTML = '<input type="number" name="total_price' + rowCount + '" id="total_price' + rowCount + '" disabled value="0">';
    populateServiceDropdown(rowCount);
}

function addNewPart() {
    rowCount++;
    var row = document.getElementById('orderTable').insertRow(rowCount + 2);
    row.insertCell(0).innerHTML = 'Osa:';
    var partDescription = row.insertCell(1);
    partDescription.innerHTML = '<input type="text" name="part' + rowCount + '">';
    partDescription.colSpan = "3";
    row.insertCell(2).innerHTML = 'kogus:';
    row.insertCell(3).innerHTML = '<input type="number" name="amount' + rowCount + '" id="amount' + rowCount + '" onchange="calculateTotal(' + rowCount + ');">';   
    row.insertCell(4).innerHTML = '[tk]';
    row.insertCell(5).innerHTML = 'ühiku hind:';   
    row.insertCell(6).innerHTML = '<input type="number" name="unit_price' + rowCount + '" id="unit_price' + rowCount + '" onchange="calculateTotal(' + rowCount + ');">';    
    row.insertCell(7).innerHTML = 'hind kokku:';
    row.insertCell(8).innerHTML = '<input type="number" name="total_price' + rowCount + '" id="total_price' + rowCount + '" disabled value="0">';
}