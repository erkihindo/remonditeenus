/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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
    document.getElementById('name_input').value = name;
    hideClientSearchForm();
}