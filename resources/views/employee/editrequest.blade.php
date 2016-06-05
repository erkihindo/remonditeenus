@extends('layouts.employeeapp')

@section('content')

<script>
var token = '{{ Session::token() }}';
var urlToGetCustomers = '{{ route('getAllCustomers') }}';
var urlToUpdateRequest = '{{ route('updaterequest') }}';
var urlToHome = '{{ route('/') }}';
</script>

<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-2">
            <form action="{{route('servicerequest.create')}}" method="POST" style="margin-left: 14%">
                <input type="hidden" value="{{ Session::token() }}" name="_token">
                <table>
                    <tr>
                        <td colspan="2">Kliendi pöördumine nr {{ $request->id }}</td>
                    <input type="hidden" name="id" id="id" value="{{$request->id}}">
                    </tr>
                    <tr>
                        <td>Klient:</td>
                        <td><span id="name">{{ $request->user->name }}</span><input type="button" value="Otsi klienti" onclick="showClientSearchForm()"></td>
                    <input type="hidden" name ="customer" value="{{ $request->user->name }}" id="customer">
                    </tr>
                    <tr>
                        <td>Kliendi kirjeldus:</td>
                        <td><textarea name="customer_desc" id="customer_desc">{{ $request->service_desc_by_customer }}</textarea></td>
                    </tr>
                    <tr>
                        <td>Vastuvõtja kirjeldus:</td>
                        <td><textarea name="employee_desc" id="employee_desc">{{ $request->service_desc_by_employee }}</textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="checkbox" name="is_rejected" id="status_type"
                                               @if($request->service_request_status_type_id == 2)
                                                checked="checked"
                                               @endif
                                               >Registreeri tagasilükkamine</td>
                    </tr>
                    <tr>
                        <td><input type="button" onclick="editRequest()" value="Salvesta kliendi pöördumine"></td>
                        <td><input type="submit" value="Vormista tellimus"></td>
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
<script src="{{ URL::to('src/js/editrequest.js') }}"></script>

@endsection
