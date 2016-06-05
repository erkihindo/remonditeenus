/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


console.log("loaded adddevice js");

$.ajax({
        method: 'GET',
        url: urlToGetTypes,
        data: { _token: token}
    })
    .done(function (msg) {
        console.log("TYPES: ");
        console.log(msg);
        var dropdown = document.getElementById("type");
        for(var i=0; i<msg.length; i++) {
            var option = document.createElement("option");
            option.text = msg[i][1];
            option.value = msg[i][0];
            dropdown.add(option);
        }
    });
