@extends('layouts.employeeapp')

@section('content')
{{ $servicerequest }}
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form action="{{route('serviceorder.create')}}" method="POST" style="margin-left: 14%">
                <input type="hidden" value="{{ Session::token() }}" name="_token">
                <table>
                    <tr>
                        <td colspan="2">Tellimus nr {{ $newID }}</td>
                    </tr>
                    <tr>
                        <td>Vali tellimuse seade:</td>
                        <td><select name="device"></select></td>
                    </tr>
                    <tr>
                        <td>Summa kokku:</td>
                        <td>{{ $total_order_price }}</td>
                    </tr>
                    <tr>
                        <td>Töö: <input type="text" name="job"></td>
                        <td>Teenus: <select name="service"></select></td>
                        <td>kogus: <input type="number" name="amount1"></td>
                        <td>ühiku hind: <input type="number" name="unit_price1"> [h]</td>
                        <td>hind kokku:<input type="number" name="total_price1"</td>
                    </tr>
                    <tr>
                        <td colspan="2">Osa: <input type="text" name="part"></textarea></td>
                        <td>kogus: <input type="number" name="amount2"> [tk]</td>
                        <td>ühiku hind: <input type="number" name="unit_price2"></td>
                        <td>hind kokku: <input type="number" name="total_price2"</td>
                    </tr>

                    <tr>
                        <td>tellimuse staatus:</td>
                        <td><select name="order_status"></select></td>
                        <td><input type="button" value="Salvesta tellimus"></td>
                        <td><input type="submit" value="Tee arve"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

@endsection
