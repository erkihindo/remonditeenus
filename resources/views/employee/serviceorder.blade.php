@extends('layouts.employeeapp')

@section('content')
{{-- */$idCount=1;/* --}}
<script>
var token = '{{ Session::token() }}';
var urlToGetSoStatusTypes = '{{ route('getsostatustypes') }}';
var urlToGetServiceTypes = '{{ route('getservicetypes') }}';
var urlToGetDeviceTypes = '{{ route('getdevicetypes') }}';

var urlToSearchDevices = '{{ route('finddevices') }}';
var urlToCreateDevice = '{{ route('createdevice') }}';
var urlToGetDeviceName = '{{ route('getdevicename') }}';

var urlToGetOldDevices = '{{ route('getdevicesbyorderid') }}';
var urlToGetSaveOrder = '{{ route('saveserviceorder') }}';
var urlToGetUpdateOrder = '{{ route('updateserviceorder') }}';

var urlToGetOldSoState = '{{ route('getsostatebyorderid') }}';
var urlToList = '{{ route('allserviceorders') }}';
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('serviceorder.create')}}" method="POST">
                <input type="hidden" value="{{ Session::token() }}" name="_token">
                <input type="hidden" value="{{ $servicerequest->id }}" name="requestID" id="oldReqID">
                <table id="orderTable">
                    <tr>
                        @if($oldOrder != null)
                            <td colspan="2">Tellimus nr {{ $oldOrder->id }}</td>
                        @else
                            <td colspan="2">Tellimus nr {{ $newID }}</td>
                        @endif
                        
                    </tr>
                    <tr>
                        <td colspan="2">Vali tellimuse seade:</td>
                        <td><select name="device" id="device"></select></td>
                    <input type="hidden" name="device" id="device_input">
                        <td><input type="button" value="Otsi seadet" onclick="showDeviceSearchForm()"></td>
                        <td colspan="2"><input type="button" value="Lisa uus seade" onclick="showDeviceAddForm()"></td>
                    </tr>
                    <tr>
                        <td colspan="2">Summa kokku:</td>
                        <td><span id="total">0</span></td>
                    <input type="hidden" name="price_total" id="price_total">
                    </tr>
                    @if($oldOrder != null)
                        @foreach($oldOrder->actions as $service)
                        <tr>
                            <td>Töö:</td>
                            <td><input type="text" name="service[]" id="service_description{{$idCount}}" value="{{ $service->action_description }}" required></td>
                            <td>Teenus:</td>
                            <td><select name="service_type[]" id="service_types{{$idCount}}" onchange="changeUnits(1)"></select></td>
                        <input type="hidden" id="oldType{{$idCount}}" value="{{ $service->service_type_id }}">
                            <td>kogus:</td>
                            <td><input type="number" name="amount1[]" id="amount{{$idCount}}" value="{{ $service->service_amount }}" onchange="calculateTotal({{$idCount}});" required></td>
                            <td><span id="unit_type{{$idCount}}"></span></td>
                            <td>ühiku hind:</td>
                            <td><input type="number" name="unit_price1[]" id="unit_price{{$idCount}}" value="{{ $service->price }}" onchange="calculateTotal({{$idCount}});" required></td>
                            <td>hind kokku:</td>
                            <td><input type="number" name="total_price1[]" id="total_price{{$idCount++}}" value="{{ $service->service_amount * $service->price }}" disabled required></td>
                        </tr>
                        @endforeach
                    
                    @else
                    <tr>
                        <td>Töö:</td>
                        <td><input type="text" name="service[]" id="service_description1" required></td>
                        <td>Teenus:</td>
                        <td><select name="service_type[]" id="service_types1" onchange="changeUnits(1)"></select></td>
                        <input type="hidden" id="oldType1" value="1">
                        <td>kogus:</td>
                        <td><input type="number" name="amount1[]" id="amount1" onchange="calculateTotal(1);" required></td>
                        <td><span id="unit_type1"></span></td>
                        <td>ühiku hind:</td>
                        <td><input type="number" name="unit_price1[]" id="unit_price1" onchange="calculateTotal(1);" required></td>
                        <td>hind kokku:</td>
                        <td><input type="number" name="total_price1[]" id="total_price1" disabled value="0" required></td>
                    </tr>
                    @endif
                    @if($oldOrder != null)
                        @foreach($oldOrder->parts as $part)
                        <tr>
                            <td>Osa:</td>
                            <td colspan="3"><input type="text" name="part[]" id="part_description{{$idCount}}" value="{{ $part->part_name }}" required style="width: 100%;"></td>
                            <td>kogus:</td>
                            <td><input type="number" name="amount2[]" id="amount{{$idCount}}" value="{{ $part->part_count }}" onchange="calculateTotal({{$idCount}});" required></td>
                            <td>[tk]</td>
                            <td>ühiku hind:</td>
                            <td><input type="number" name="unit_price2[]" id="unit_price{{$idCount}}" value="{{ $part->part_price }}" onchange="calculateTotal({{$idCount}});" required></td>
                            <td>hind kokku:</td>
                            <td><input type="number" name="total_price2[]" id="total_price{{$idCount++}}" disabled value="{{ $part->part_price * $part->part_count }}"required></td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td>Osa:</td>
                        <td colspan="3"><input type="text" name="part[]" id="part_description2" required style="width: 100%;"></td>
                        <td>kogus:</td>
                        <td><input type="number" name="amount2[]" id="amount2" onchange="calculateTotal(2);" required></td>
                        <td>[tk]</td>
                        <td>ühiku hind:</td>
                        <td><input type="number" name="unit_price2[]" id="unit_price2" onchange="calculateTotal(2);" required></td>
                        <td>hind kokku:</td>
                        <td><input type="number" name="total_price2[]" id="total_price2" disabled value="0"required></td>
                    </tr>
                    @endif
                    <tr>
                        <td><a href="javascript:addNewService()">Lisa töö</a></td>
                        <td><a href="javascript:addNewPart()">Lisa osa</a></td>
                    </tr>
                    <tr>
                        <td>tellimuse staatus:</td>
                        <td><select name="order_status" id="order_status"></select></td>
                        <td colspan="3"><input type="button" onclick="saveOrder()" value="Salvesta tellimus"></td>
                        <td><input type="submit" value="Tee arve" id="arve_nupp" disabled></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3" id="deviceAddForm">
            <div action="">
                <table class="table-bordered">
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
                <table class="table-bordered">
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
<script> 
    
@if($idCount>2)
    var addition = {{$idCount}} - 3;
    var actionCount = {{ count($oldOrder->actions) }}
@else
    var addition =0;
    var actionCount =1;
@endif

@if($oldOrder != null) 
    var oldDevice = true;
    var oldOrderID = {{ $oldOrder->id }};
@else
    var oldDevice = false;
@endif
</script>
<script src="{{ URL::to('src/js/serviceorder.js') }}"></script>
@endsection
