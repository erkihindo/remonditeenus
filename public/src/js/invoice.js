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