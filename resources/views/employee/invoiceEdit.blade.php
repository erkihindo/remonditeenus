@extends('layouts.employeeapp')

@section('content')
<script>
var token = '{{ Session::token() }}';

var urlToGetCustomers = '{{ route('getAllCustomers') }}';
var urlToGetInvoiceStatusTypes = '{{ route('getinvoicestatustypes') }}';
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('invoice.update')}}" method="POST">
                <input type="hidden" value="{{ Session::token() }}" name="_token">
                <input type="hidden" value="{{ $serviceorder->id }}" name="orderID">
                <table>
                    <tr>
                        <td >Arve nr {{ $newID }}</td>
                    <input type="hidden" value="{{$newID}}" name="invoice_id">
                        @foreach($serviceorder->devices as $device)
                        <td >Seade: {{ $device->device->name}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td colspan="2"><span id="name">{{ $serviceorder->service_request->user->name }}</span></td>
                        <input type="hidden" name ="customer" id="customer" value="{{ $serviceorder->service_request->user->name }}">
                        <td><input type="button" value="Otsi klienti" onclick="showClientSearchForm()"></td>
                        <td>Maksmise tähtaeg:</td>
                        <td><input type="date" name="date"></td>
                    </tr>
                    <tr>
                        <td colspan="2">Summa kokku:</td>
                        <td>{{ $serviceorder->price_total }}</td>
                    </tr>
             
                    @foreach($serviceorder->actions as $service)
                    <tr>
                        <td>Töö:</td>
                        <td>{{ $service->action_description }}</td>
                        <td>Teenus:</td>
                        <td>{{ $service->service_type->type_name }}</td>
                        <td>kogus:</td>
                        <td>{{ $service->service_amount }}</td>
                        <td>{{ $service->service_type->service_unit_type->type_name }}</td>
                        <td>ühiku hind:</td>
                        <td>{{ $service->price }}</td>
                        
                    </tr>
                    @endforeach
                  
                    @foreach($serviceorder->parts as $part)
                    <tr>
                        <td>Osa:</td>
                        <td colspan="3">{{ $part->part_name }}</td>
                        <td>kogus:</td>
                        <td>{{ $part->part_count }}</td>
                        <td>[tk]</td>
                        <td>ühiku hind:</td>
                        <td>{{ $part->part_price }}</td>
                        
                    </tr>
                    @endforeach

                    <tr>
                        <td>arve staatus:</td>
                        <td><select name="order_status" id="order_status"></select></td>
                        <td><input type="submit" value="Tee arve" id="arve_nupp"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div id="clientSearchForm" >
                Kliendi otsing<br>
                Nimi:<input type="text" id="names"><br>
                <button type="submit" onclick="saveClient()">Lisa</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ URL::to('src/js/MSelectDBox.js') }}"></script>
<script src="{{ URL::to('src/js/invoice.js') }}"></script>
@endsection
