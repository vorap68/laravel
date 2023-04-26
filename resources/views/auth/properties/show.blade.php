@extends('auth.layouts.master')

@section('title', 'Свойства ' . $property->name)

@section('content')
    <div class="col-md-12">
        <h1>Свойства {{ $property->name }}</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    Поле
                </th>
                <th>
                    Значение
                </th>
            </tr>
           
            <tr>
                <td>Название</td>
                <td>{{ $property->name }}</td>
            </tr>
          
           
            </tbody>
        </table>
    </div>
@endsection
