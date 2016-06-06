@extends('layouts.employeeapp')

@section('content')

<script>
var token = '{{ Session::token() }}';
var urlToGetCustomers = '{{ route('getAllCustomers') }}';
var urlToSaveRequest = '{{ route('saverequest') }}';
var urlToHome = '{{ route('/') }}';
</script>

<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-2">
            <form action="{{route('servicerequest.create')}}" method="POST" style="margin-left: 14%">
                <input type="hidden" value="{{ Session::token() }}" name="_token">
                <table>
                    <tr>
                        <td colspan="2">Kliendi pöördumine nr {{ $newID }}</td>
                    </tr>
                    <tr>
                        <td>Klient:</td>
                        <td><span id="name"></span><input type="button" value="Otsi klienti" onclick="showClientSearchForm()"></td>
                    <input type="hidden" name ="customer" id="customer">
                    </tr>
                    <tr>
                        <td>Kliendi kirjeldus:</td>
                        <td><textarea name="customer_desc" id="customer_desc"></textarea></td>
                    </tr>
                    <tr>
                        <td>Vastuvõtja kirjeldus:</td>
                        <td><textarea name="employee_desc" id="employee_desc"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="checkbox" name="is_rejected" id="status_type">Registreeri tagasilükkamine</td>
                    </tr>
                    <tr>
                        <td><input type="button" onclick="saveRequest()" value="Salvesta kliendi pöördumine"></td>
                        <td><input type="submit" value="Vormista tellimus" id="submitButton" disabled></td>
                    </tr>
                </table>
            </form>
            
        </div>
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
<script src="{{ URL::to('src/js/servicerequest.js') }}"></script>

@endsection
