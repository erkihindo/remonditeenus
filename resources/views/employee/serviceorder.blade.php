@extends('layouts.employeeapp')

@section('content')
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
                        <td>{{ $servicerequest->total_order_price }}</td>
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
                        <td><a href="">Lisa töö</a></td>
                        <td><a href="">Lisa osa</a></td>
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
        <div>
            <form action="" style="margin-left: 14%">
                <table>
                    <tr>
                        <td colspan="2">SEADME LISAMINE</td>
                    </tr>
                    <tr>
                        <th>nimi</th>
                        <td><input type="text" name="name"></td>
                    </tr>
                    <tr>
                        <th>mudel</th>
                        <td><input type="text" name="model"></td>
                    </tr>
                    <tr>
                        <th>kirjeldus</th>
                        <td><input type="text" name="description"></td>
                    </tr>
                    <tr>
                        <th>tootja</th>
                        <td><input type="text" name="manufacturer"></td>
                    </tr>
                    <tr>
                        <th>seerianumber</th>
                        <td><input type="text" name="serial_nr"></td>
                    </tr>
                    <tr>
                        <th>seadme tüüp</th>
                        <td><select name="type"></select></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Lisa"></td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="col-md-10 col-md-offset-1">
            <form action="" style="margin-left: 14%">
                <input type="hidden" value="{{ Session::token() }}" name="_token">
                <table>
                    <tr>
                        <td colspan="2">SEADME OTSING</td>
                    </tr>
                    <tr>
                        <th>nimi</th>
                        <td><input type="text" name="device_name"></td>
                    </tr>
                    <tr>
                        <th>mudel</th>
                        <td><input type="text" name="model"></td>
                    </tr>
                    <tr>
                        <th>seerianumber</th>
                        <td><input type="text" name="serial_nr"></td>
                    </tr>
                    <tr>
                        <th>seadme tüüp</th>
                        <td><select name="type"></select></td>
                    </tr>
                    <tr>
                        <th>kliendi nimi</th>
                        <td><input type="text" name="client_name"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Otsi"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

@endsection
