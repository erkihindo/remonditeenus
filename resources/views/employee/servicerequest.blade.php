@extends('layouts.employeeapp')

@section('content')

<script>
var token = '{{ Session::token() }}';
var urlToGetCustomers = '{{ route('getAllCustomers') }}';
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
                        <td><input type="button" value="Otsi klienti" onclick="showClientSearchForm()"></td>
                    </tr>
                    <tr>
                        <td>Kliendi kirjeldus:</td>
                        <td><textarea name="customer_desc"></textarea></td>
                    </tr>
                    <tr>
                        <td>Vastuvõtja kirjeldus:</td>
                        <td><textarea name="employee_desc"></textarea></td>
                    </tr>
                    <tr>
                        <td><input type="button" value="Salvesta kliendi pöördumine"></td>
                        <td><input type="submit" value="Vormista tellimus"></td>
                    </tr>
                </table>
            </form>
            
        </div>
        <div class="col-md-5">
            <form id="clientSearchForm" action="">
                Kliendi otsing<br>
                Nimi:<input type="text"><br>
                <input type="submit" value="Otsi">
            </form>
        </div>
    </div>
</div>

<script src="{{ URL::to('src/js/servicerequest.js') }}"></script>
@endsection
