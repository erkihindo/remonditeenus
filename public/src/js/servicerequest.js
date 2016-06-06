/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var checkbox = $("#status_type");
var clientIsChosen = false;

console.log("loaded servicerequest js");

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

function saveRequest() {
    var customer = document.getElementById('customer').value;
    var customer_desc = document.getElementById('customer_desc').value;
    var employee_desc = document.getElementById('employee_desc').value;
    var status_type = checkbox.checked;
    
    $.ajax({
        method: 'POST',
        url: urlToSaveRequest,
        data: {customer: customer,customer_desc: customer_desc, employee_desc: employee_desc, status_type:status_type,  _token: token}
    })
    .done(function (msg) {
        console.log("SAVED: ");
        console.log(msg);
        window.location.href = urlToHome;
        
    });
}    

function handleButton() {

    if (document.getElementById('status_type').checked == false) {
        document.getElementById('submitButton').removeAttribute('disabled');
    }       
}


checkbox.change(function(event) {
    var checkbox = event.target;
    if (!checkbox.checked && clientIsChosen) {
        document.getElementById('submitButton').removeAttribute('disabled');    
    } else {
        document.getElementById('submitButton').setAttribute('disabled', true);
    }
});

name.change(function(event) {
    var name = event.target;
    if (!checkbox.checked && clientIsChosen) {
        document.getElementById('submitButton').removeAttribute('disabled');    
    } else {
        document.getElementById('submitButton').setAttribute('disabled', true);
    }
});