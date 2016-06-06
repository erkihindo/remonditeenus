@extends('layouts.employeeapp')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-2">
            <table class="table">
                <th>id</th>
                <th>seisund</th>
                <th>klient</th>
                <th>vastuvõtja</th>
                <th>kliendi seletus</th>
                <th>vastuvõtja seletus</th>
                @foreach($requests as $request)
                <tr onclick="window.open('{{ URL::to('servicerequest') . "/". $request->id }}','_self');">
                    <td>{{ $request->id }}</td>
                    <td>{{ $request->service_request_status_type->type_name }}</td>
                    <td>{{ $request->user->name }}</td>
                    <td>{{ $request->admin->name }}</td>
                    <td>{{ $request->service_desc_by_customer}}</td>
                    <td>{{ $request->service_desc_by_employee}}</td>
                </tr>
                    
            
                @endforeach
                
            </table>
            
        </div>
    </div>
</div>


@endsection
