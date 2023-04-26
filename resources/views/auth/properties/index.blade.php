@extends('auth.layouts.master')

@section('title', 'Свойства')
@section('content')
    <div class="col-md-12">
        <h1>Свойства</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
               
                <th>
                    Название
                </th>
                <th>
                    Действия
                </th>
            </tr>
            @foreach($properties as $property)
                <tr>
                    <td>{{ $property->id }}</td>
                   <td>{{ $property->name }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('property.destroy', $property) }}" method="POST">
                                <a class="btn btn-success" type="button" href="{{ route('property.show', $property) }}">Открыть</a>
                                <a class="btn btn-warning" type="button" href="{{ route('property.edit', $property) }}">Редактировать</a>
                                  <a class="btn btn-primary" type="button" href="{{ route('property-options.index', $property) }}">Значения свойства</a>
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Удалить"></form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
       
        <a class="btn btn-success" type="button"
           href="{{ route('property.create') }}">Добавить свойство</a>
    </div>
@endsection
