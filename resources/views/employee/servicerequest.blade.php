@extends('layouts.employeeapp')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form action="{{route('servicerequest')}}" method="POST" style="margin-left: 14%">
                <input type="hidden" value="{{ Session::token() }}" name="_token">
                <table>
                    <tr>
                        <td colspan="2">Kliendi pöördumine nr </td>
                    </tr>
                    <tr>
                        <td>Klient:</td>
                        <td><input type="button" value="Otsi klienti"></td>
                    </tr>
                    <tr>
                        <td>Kliendi kirjeldus:</td>
                        <td><textarea></textarea></td>
                    </tr>
                    <tr>
                        <td>Vastuvõtja kirjeldus:</td>
                        <td><textarea></textarea></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Salvesta kliendi pöördumine"></td>
                        <td><input type="button" value="Vormista tellimus"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<script src="{{ URL::to('src/js/servicerequest.js') }}"></script>
@endsection
