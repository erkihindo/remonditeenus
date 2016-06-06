/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
window.onload = function () {
        hideClientSearchForm();
    }
    
function showClientSearchForm() {
    document.getElementById('clientSearchForm').removeAttribute('hidden');
}

function hideClientSearchForm() {
    document.getElementById('clientSearchForm').setAttribute('hidden', true);
}

function saveClient() {
    var name = document.getElementById('names').value;
    document.getElementById('name').innerHTML = name;
    document.getElementById('customer').value = name;
    hideClientSearchForm();
    clientIsChosen = true;
}


$.ajax({
    method: 'GET',
    url: urlToGetInvoiceStatusTypes,
    data: { _token: token}
})
.done(function (msg) {
    console.log("Status types: ");
    console.log(msg[0]);
    var dropdown = document.getElementById("order_status");
    for(var i=0; i<msg.length; i++) {
        var option = document.createElement("option");
        option.text = msg[i]['type_name'];
        option.value = msg[i]['id'];
        dropdown.add(option);
    }
   
});


$.ajax({
        method: 'GET',
        url: urlToGetCustomers,
        data: { _token: token}
    })
    .done(function (msg) {
        console.log("NAMES: ");
        console.log(msg);
        
        $("#names").mSelectDBox({
        "list": msg,

         // enable multiple select
         "multiple": false,

           "autoComplete": true,
         // Name of instance. 
         "name": "b"


       });  
    });