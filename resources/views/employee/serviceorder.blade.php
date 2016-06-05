@extends('layouts.employeeapp')

@section('content')

<script>
var token = '{{ Session::token() }}';
var urlToGetSoStatusTypes = '{{ route('getsostatustypes') }}';
var urlToGetServiceTypes = '{{ route('getservicetypes') }}';
var urlToGetDeviceTypes = '{{ route('getdevicetypes') }}';

var urlToSearchDevices = '{{ route('finddevices') }}';
var urlToCreateDevice = '{{ route('createdevice') }}';
var urlToGetDeviceName = '{{ route('getdevicename') }}';
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('serviceorder.create')}}" method="POST">
                <input type="hidden" value="{{ Session::token() }}" name="_token">
                <table>
                    <tr>
                        <td colspan="2">Tellimus nr {{ $newID }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Vali tellimuse seade:</td>
                        <td><select name="device" id="device"></select></td>
                        <td><input type="button" value="Otsi seadet" onclick="showDeviceSearchForm()"></td>
                        <td colspan="2"><input type="button" value="Lisa uus seade" onclick="showDeviceAddForm()"></td>
                    </tr>
                    <tr>
                        <td colspan="2">Summa kokku:</td>
                        <td>{{ $servicerequest->total_order_price }}</td>
                    </tr>
                    <tr>
                        <td>Töö:</td>
                        <td><input type="text" name="job"></td>
                        <td>Teenus:</td>
                        <td><select name="service" id="service_types"></select></td>
                        <td>kogus:</td>
                        <td><input type="number" name="amount1" id="amount1"></td>
                        <td id="unit_type1">[h]</td>
                        <td>ühiku hind:</td>
                        <td><input type="number" name="unit_price1" id="unit_price1"></td>
                        <td>hind kokku:</td>
                        <td><input type="number" name="total_price1" id="total_price1" disabled></td>
                    </tr>
                    <tr>
                        <td>Osa:</td>
                        <td colspan="3"><input type="text" name="part"></textarea></td>
                        <td>kogus:</td>
                        <td><input type="number" name="amount2"></td>
                        <td>[tk]</td>
                        <td>ühiku hind:</td>
                        <td><input type="number" name="unit_price2"></td>
                        <td>hind kokku:</td>
                        <td><input type="number" name="total_price2" disabled></td>
                    </tr>
                    <tr>
                        <td><a href="">Lisa töö</a></td>
                        <td><a href="">Lisa osa</a></td>
                    </tr>
                    <tr>
                        <td>tellimuse staatus:</td>
                        <td><select name="order_status" id="order_status"></select></td>
                        <td colspan="2"><input type="button" value="Salvesta tellimus"></td>
                        <td><input type="submit" value="Tee arve" id="arve_nupp"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3" id="deviceAddForm">
            <div action="">
                <table>
                    <tr>
                        <td colspan="2">SEADME LISAMINE</td>
                    </tr>
                    <tr>
                        <th>nimi</th>
                        <td><input type="text" name="name" id="name1"></td>
                    </tr>
                    <tr>
                        <th>mudel</th>
                        <td><input type="text" name="model" id="model1"></td>
                    </tr>
                    <tr>
                        <th>kirjeldus</th>
                        <td><input type="text" name="description" id="description1"></td>
                    </tr>
                    <tr>
                        <th>tootja</th>
                        <td><input type="text" name="manufacturer" id="manufacturer1"></td>
                    </tr>
                    <tr>
                        <th>seerianumber</th>
                        <td><input type="text" name="serial_nr" id="serial_nr1"></td>
                    </tr>
                    <tr>
                        <th>seadme tüüp</th>
                        <td><select name="type" id="device_type1"></select></td>
                    </tr>
                    <tr>
                        <td><button type="submit" onclick="createDevice()">Lisa</button></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-3" id="deviceSearchForm">
            <div>
                <table>
                    <tr>
                        <td colspan="2">SEADME OTSING</td>
                    </tr>
                    <tr>
                        <th>nimi</th>
                        <td><input type="text" id="device_name2"></td>
                    </tr>
                    <tr>
                        <th>mudel</th>
                        <td><input type="text" id="model2"></td>
                    </tr>
                    <tr>
                        <th>seerianumber</th>
                        <td><input type="text" id="serial_nr2"></td>
                    </tr>
                    <tr>
                        <th>tootja</th>
                        <td><input type="text" id="manufacturer2"></td>
                    </tr>
                    <tr>
                        <th>seadme tüüp</th>
                        <td><select name="type" id="device_type2"></select></td>
                    </tr>
                    <tr>
                        <th>kliendi nimi</th>
                        <td><input type="text" id="client_name2"></td>
                    </tr>
                    <tr>
                        <td><button type="submit" onClick="searchForDevice()">Otsi</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-6" id="searchResultDiv">
            Tulemus:<br>
            <ul>
                <span id="search_result"></span>
            </ul>
        </div>
    </div>
</div>
<script src="{{ URL::to('src/js/serviceorder.js') }}"></script>
@endsection
