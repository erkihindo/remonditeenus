var service_types = [];
var serviceamount;
var rowCount = 2 + addition;
   
console.log(actionCount);
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
//jälgib seadme muutust dropdownis
document.getElementById("device").addEventListener("change", function() {
        console.log("Changed device " + document.getElementById("device").value);
        document.getElementById("device_input").value = document.getElementById("device").value
    });

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
if(oldDevice == true) {
    console.log("Getting old devices");
    $.ajax({
    method: 'GET',
    url: urlToGetOldDevices,
    data: {id: oldOrderID, _token: token}
    })
    .done(function (msg) {
        console.log("Old devices: ");
        console.log(msg);
        var deviceDropdown = document.getElementById("device");
        var option = document.createElement("option");
        option.value = msg[0];
        option.text = msg[1];
        deviceDropdown.add(option);
    });
    console.log("Getting old so_state")
     $.ajax({
    method: 'GET',
    url: urlToGetOldSoState,
    data: {id: oldOrderID, _token: token}
    })
    .done(function (msg) {
        console.log("Old SoState: ");
        console.log(msg);
        var deviceDropdown = document.getElementById("order_status");
        deviceDropdown.selectedIndex = msg -1;
        if(deviceDropdown.value == 3) {
            document.getElementById("arve_nupp").style.display = 'inline';
        }
    });
}

//teenus
$.ajax({
    method: 'GET',
    url: urlToGetServiceTypes,
    data: { _token: token}
})
.done(function (msg) {
    service_types = msg;
    console.log("Service types: ");
    console.log(service_types);
    for(var i = 1; i < actionCount+1; i++) {
        populateServiceDropdown(i);
    }
    
});

function populateServiceDropdown(rowNo) {
    console.log("RowNo" + rowNo);
    for(var i=0; i<service_types.length; i++) {
        var option = document.createElement("option");
        option.text = service_types[i][1];
        option.value = service_types[i][0];
        document.getElementById("service_types" + rowNo).add(option);
        
    }
    if(oldDevice) {
        document.getElementById("service_types" + rowNo).selectedIndex = document.getElementById("oldType" + rowNo).value-1;
    
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
        document.getElementById("unit_price" + rowNo).value = service_types[0][3];
        document.getElementById("unit_type" + rowNo).innerHTML = service_types[0][2];
    } else if(servicedropdown.value == 2) {
        document.getElementById("unit_price" + rowNo).value = service_types[1][3];
        document.getElementById("unit_type" + rowNo).innerHTML = service_types[1][2];
    } else {
        document.getElementById("unit_price" + rowNo).value = service_types[2][3];
        document.getElementById("unit_type" + rowNo).innerHTML = service_types[2][2];
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
    document.getElementById("price_total").value = total;
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
        if(document.getElementById("device_input").value == 0) {
            document.getElementById("device_input").value = document.getElementById("device").value
        } 
    });
    
     
    hide('deviceSearchForm');
    hide('searchResultDiv');
}

function addNewService() {
    rowCount++;
    var row = document.getElementById('orderTable').insertRow(rowCount + 2);
    row.insertCell(0).innerHTML = 'Töö:';
    row.insertCell(1).innerHTML = '<input type="text" name="service[]" id="service_description' + rowCount + '" required>';
    row.insertCell(2).innerHTML = 'Teenus:';
    row.insertCell(3).innerHTML = '<select name="service_type[]' + rowCount + '" id="service_types' + rowCount + '" onchange="changeUnits(' + rowCount + ');" ></select>';   
    row.insertCell(4).innerHTML = 'kogus:';
    row.insertCell(5).innerHTML = '<input type="number" name="amount1[]' + rowCount + '" id="amount' + rowCount + '" onchange="calculateTotal(' + rowCount + ');" required>';   
    row.insertCell(6).innerHTML = '<span id="unit_type' + rowCount + '"></span>';    
    row.insertCell(7).innerHTML = 'ühiku hind:';
    row.insertCell(8).innerHTML = '<input type="number" name="unit_price1[]' + rowCount + '" id="unit_price' + rowCount + '" onchange="calculateTotal(' + rowCount + ');" required>';
    row.insertCell(9).innerHTML = 'hind kokku:';
    row.insertCell(10).innerHTML = '<input type="number" name="total_price1[]' + rowCount + '" id="total_price' + rowCount + '" disabled value="0"required>';
    populateServiceDropdown(rowCount);
}

function addNewPart() {
    rowCount++;
    var row = document.getElementById('orderTable').insertRow(rowCount + 2);
    row.insertCell(0).innerHTML = 'Osa:';
    var partDescription = row.insertCell(1);
    partDescription.innerHTML = '<input type="text" name="part[]' + rowCount + '" id="part_description' + rowCount + '" required  style="width: 100%;">';
    partDescription.colSpan = "3";
    row.insertCell(2).innerHTML = 'kogus:';
    row.insertCell(3).innerHTML = '<input type="number" name="amount2[]' + rowCount + '" id="amount' + rowCount + '" onchange="calculateTotal(' + rowCount + ');" required>';   
    row.insertCell(4).innerHTML = '[tk]';
    row.insertCell(5).innerHTML = 'ühiku hind:';   
    row.insertCell(6).innerHTML = '<input type="number" name="unit_price2[]' + rowCount + '" id="unit_price' + rowCount + '" onchange="calculateTotal(' + rowCount + ');" required>';    
    row.insertCell(7).innerHTML = 'hind kokku:';
    row.insertCell(8).innerHTML = '<input type="number" name="total_price2[]' + rowCount + '" id="total_price' + rowCount + '" disabled value="0" required>';
}

function saveOrder() {
    var parts = [];
    var services = [];
    console.log("Saving");
    
    for (var i = 1; i <= rowCount; i++) {
        
        if (document.getElementById('orderTable').rows[i + 2].cells[0].innerHTML == 'Töö:') {
            var serviceDescription = document.getElementById('service_description' + i).value;
            
            var serviceType = document.getElementById('service_types' + i).value;
            var serviceAmount = document.getElementById('amount' + i).value;
            var serviceUnitPrice = document.getElementById('unit_price' + i).value;
            var serviceTotal = document.getElementById('total_price' + i).value;
            services.push({
                "serviceDescription": serviceDescription,
                "serviceType": serviceType,
                "serviceAmount": serviceAmount,
                "serviceUnitPrice": serviceUnitPrice,
                "serviceTotal": serviceTotal
            });
        } else {
            var partDescription = document.getElementById('part_description' + i).value;
            var partAmount = document.getElementById('amount' + i).value;
            var partUnitPrice = document.getElementById('unit_price' + i).value;
            var partTotalPrice = document.getElementById('total_price' + i).value;
            parts.push({
                "partDescription": partDescription,
                "partAmount" : partAmount,
                "partUnitPrice": partUnitPrice,
                "partTotalPrice": partTotalPrice
            });
        }
    }
    console.log(services);
    console.log(parts);
    var oldReqID = document.getElementById("oldReqID").value;
    var so_status_type_id = document.getElementById("order_status").value;
    var price_total = document.getElementById("total").value;
    var service_device = document.getElementById("device").value;
    var price_total = document.getElementById("price_total").value;
    
    if(oldDevice == false) {
        console.log("posting save");
        $.ajax({
            method: 'POST',
            url: urlToGetSaveOrder,
            data: {oldReqID: oldReqID, so_status_type_id:so_status_type_id,price_total:price_total,service_device:service_device,  services:services, parts:parts, _token: token}
        })
        .done(function (msg) {
            
            console.log("Saved: ");
            console.log(msg);
            window.location.href = urlToList;

        });
    } else {
        console.log("posting update");
        $.ajax({
            method: 'POST',
            url: urlToGetUpdateOrder,
            data: {id: oldOrderID,so_status_type_id:so_status_type_id,price_total:price_total,service_device:service_device,  services:services, parts:parts, _token: token}
        })
        .done(function (msg) {
            
            console.log("Updated: ");
            console.log(msg);
            window.location.href = urlToList;

        });
    }
}