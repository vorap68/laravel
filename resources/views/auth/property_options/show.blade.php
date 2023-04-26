@extends('auth.layouts.master')

@section('title', 'Свойства ' . $propertyOption->name)

@section('content')
    <div class="col-md-12">
        <h1>Свойства {{ $property->name }}</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                   свойство
                </th>
                <th>
                    Значение
                </th>
            </tr>
           
            <tr>
                <td>{{ $property->name }}</td>
                <td>{{ $propertyOption->name }}</td>
            </tr>
          
           
            </tbody>
        </table>
    </div>
@endsection
