@extends('layouts.customerapp')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table class="table">
                <th>
                    id
                </th>
                <th>
                    kiri
                </th>
                <th>
                    autor
                </th>
                
                @foreach($notes as $note)
                <tr>
                    <td>
                        {{ $note->id }}
                    </td>
                    <td>
                        {{ $note->note }}
                    </td>
                    <td>
                        {{ $note->user->name }}
                    </td>
                    
                    
                </tr> 
                @endforeach
                 <form action="{{route('comment.create')}}" method="POST">
                     <input type="hidden" name="order_id" value="{{ $order_id }}">
                     <input type="hidden" value="{{ Session::token() }}" name="_token">
                <tr>
                   
                    <td>
                        Lisa uus kommentaar
                    </td>
                    <td colspan="2">
                        <textarea name="note"></textarea>
                        
                    </td>
                    
                </tr>
                <tr>
                    <td colspan="3"><input type="submit" value="Lisa"></td>
                </tr>
                </form>
            </table>
            
        </div>
    </div>
</div>

@endsection
