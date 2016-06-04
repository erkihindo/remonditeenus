@extends('layouts.employeeapp')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form action="{{route('adddevice.create')}}" method="POST" style="margin-left: 14%">
                <input type="hidden" value="{{ Session::token() }}" name="_token">
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
    </div>
</div>

<script src="{{ URL::to('src/js/servicerequest.js') }}"></script>
@endsection
