@extends('layouts.app')

@section('content')

@if($countries->isEmpty())
    <p class="message">
        Please import the data
    </p>
@else
<div class="tables-container">
    <table>
        <thead>
            <tr>
                <th>Status</th>
                <th>Countries</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($summary as $status => $count)
                <tr>
                    <td>{{ $status }}</td>
                    <td>{{ $count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($countries as $country)
                <tr>
                    <td>{{ $country->name }}</td>
                    <td>{{ $country->status->value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif



@endsection
