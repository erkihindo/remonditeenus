@extends('layouts.employeeapp')

@section('content')

<script>
var token = '{{ Session::token() }}';
var urlToGetTypes = '{{ route('getdevicetypes') }}';
</script>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form action="{{route('device.create')}}" method="POST" style="margin-left: 14%">
                <input type="hidden" value="{{ Session::token() }}" name="_token">
                <table>
                    <tr>
                        <td colspan="2">SEADME LISAMINE</td>
                    </tr>
                    <tr>
                        <th>nimi</th>
                        <td><input type="text" name="name" required></td>
                    </tr>
                    <tr>
                        <th>mudel</th>
                        <td><input type="text" name="model" required></td>
                    </tr>
                    <tr>
                        <th>kirjeldus</th>
                        <td><input type="text" name="description" required></td>
                    </tr>
                    <tr>
                        <th>tootja</th>
                        <td><input type="text" name="manufacturer" required></td>
                    </tr>
                    <tr>
                        <th>seerianumber</th>
                        <td><input type="text" name="serial_nr" required></td>
                    </tr>
                    <tr>
                        <th>seadme tüüp</th>
                        <td><select name="type" id="type"></select></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Lisa"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<script src="{{ URL::to('src/js/adddevice.js') }}"></script>
@endsection
