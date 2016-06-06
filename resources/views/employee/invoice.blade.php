@extends('layouts.employeeapp')

@section('content')
<script>
var token = '{{ Session::token() }}';
var urlToGetInvoiceStatusTypes = '{{ route('getinvoicestatustypes') }}';
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('serviceorder.create')}}" method="POST">
                <input type="hidden" value="{{ Session::token() }}" name="_token">
                <input type="hidden" value="{{ $serviceorder->id }}" name="orderID">
                <table>
                    <tr>
                        <td colspan="2">Arve nr {{ $newID }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><span id="name"></span></td>
                        <input type="hidden" name ="customer" id="customer">
                        <td><input type="button" value="Otsi klienti" onclick="showClientSearchForm()"></td>
                        <td>Maksmise tähtaeg:</td>
                        <td><input type="date"></td>
                    </tr>
                    <tr>
                        <td colspan="2">Summa kokku:</td>
                        <td>{{ $total }}</td>
                    </tr>
             
                    @foreach($order->actions as $service)
                    <tr>
                        <td>Töö:</td>
                        <td>{{ $service->service_description }}</td>
                        <td>Teenus:</td>
                        <td>{{ $service->service_type }}</td>
                        <td>kogus:</td>
                        <td>{{ $service->amount }}</td>
                        <td>{{ $service->unit_type }}</td>
                        <td>ühiku hind:</td>
                        <td>{{ $service->unit_price }}</td>
                        <td>hind kokku:</td>
                        <td>{{ $service->total_price }}</td>
                    </tr>
                    @endforeach
                  
                    @foreach($order->parts as $part)
                    <tr>
                        <td>Osa:</td>
                        <td colspan="3">{{ $part->part_description }}</td>
                        <td>kogus:</td>
                        <td>{{ $part->amount }}</td>
                        <td>[tk]</td>
                        <td>ühiku hind:</td>
                        <td>{{ $part->unit_price }}</td>
                        <td>hind kokku:</td>
                        <td>{{ $part->total_price }}</td>
                    </tr>
                    @endforeach

                    <tr>
                        <td>arve staatus:</td>
                        <td><select name="order_status" id="order_status"></select></td>
                        <td colspan="3"><input type="button" onclick="saveOrder()" value="Salvesta tellimus"></td>
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

<script src="{{ URL::to('src/js/invoice.js') }}"></script>
@endsection
