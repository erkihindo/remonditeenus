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

    });