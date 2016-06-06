@extends('layouts.employeeapp')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                   
            <table class="table table-hover">
                <tr>
                    <th>id</th>
                    <th>staatus</th>
                    <th>Summa</th>
                    <th>Kliendi seletus</th>
                    <th>Töötaja seletus</th>
                    <th>uuendatud</th>
                </tr>
                
                @foreach($orders as $order)
                <tr class="clickable" onclick="window.open('{{ URL::to('serviceorder') . "/". $order->service_request->id }}','_self');">
                    <td>
                        {{ $order->id }}
                    </td>
                    <td>
                        {{ $order->so_status_type->type_name }}
                    </td>
                    <td>
                        {{ $order->price_total }}
                    </td>
                    <td>
                        {{ $order->service_request->service_desc_by_customer }}
                    </td>
                    <td>
                        {{ $order->service_request->service_desc_by_employee }}
                    </td>
                    <td>
                        {{ $order->updated_at }}
                    </td>
                </tr> 
                @endforeach
            </table>
            
        </div>
    </div>
</div>


@endsection
