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

