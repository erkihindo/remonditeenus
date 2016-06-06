@extends('layouts.employeeapp')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-2">
                   
            <table class="table">
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
                    uuendatud
                </th>
                @foreach($invoices as $invoice)
                 <tr onclick="window.open('{{ URL::to('editinvoice') . "/". $invoice->id }}','_self');">
                    <td>
                        {{ $invoice->id }}
                    </td>
                   <td>
                        {{ $invoice->invoice_status_type->type_name }}
                    </td>
                    <td>
                        {{ $invoice->service_order->price_total }}
                    </td>
                    <td>
                        {{ $invoice->invoice_date }}
                    </td>
                </tr> 
                @endforeach
            </table>
            
        </div>
    </div>
</div>

@endsection
