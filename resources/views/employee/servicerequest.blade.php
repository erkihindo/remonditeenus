@extends('layouts.employeeapp')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Enter the request</div>

                <div class="panel-body">
                    <table>
                        <tbody>
                            <tr>
                             enter form here   
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ URL::to('src/js/servicerequest.js') }}"></script>
@endsection
