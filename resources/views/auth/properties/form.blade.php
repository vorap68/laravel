@extends('auth.layouts.master')


@isset($property)
    @section('title', 'Редактировать свойства ' . $property->name)
@else
    @section('title', 'Создать свойства')
@endisset



@section('content')

<div class="col-md-12">

   @isset($property)
            <h1>Редактировать свойства <b>{{ $property->name }}</b></h1>
                @else
                    <h1>Добавить свойства</h1>
                @endisset

    <form method="post" @isset($property)
                      action="{{ route('property.update', $property) }}"
                      @else
                      action="{{ route('property.store') }}"
                    @endisset>
        <div>
             @isset($property)
                            @method('PUT')
                        @endisset
            @csrf
            <div class="input-group row">
               
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Название: </label>
                    <div class="col-sm-6">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" class="form-control" name="name" id="name"
                               value="@isset($property){{ $property->name }}@endisset">
                    </div>
                </div>
                <br>
              
                <br>
              
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
    </form>
    @endsection