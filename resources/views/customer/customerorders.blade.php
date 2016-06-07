@extends('layouts.customerapp')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <th>
                    id
                </th>
                <th>
                    staatus
                </th>
                <th>
                    Summa
                </th>
                <th>
                    mure
                </th>
                <th>
                    uuendatud
                </th>
                @foreach($orders as $order)
                <tr class="clickable" onclick="window.open('{{ URL::to('notes') . "/". $order->id }}','_self');">
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
                        {{ $order->updated_at }}
                    </td>
                </tr> 
                @endforeach
            </table>
            
        </div>
    </div>
</div>

@endsection
