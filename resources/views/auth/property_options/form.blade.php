@extends('auth.layouts.master')


@isset($propertyOption)
    @section('title', 'Редактировать значение свойства ' . $propertyOption->name)
@else
    @section('title', 'Создать значение свойства'. $property->name)
@endisset



@section('content')

<div class="col-md-12">

   @isset($propertyOption)
            <h1>Редактировать значение свойства <b>{{  $propertyOption->name }}</b></h1>
                @else
                    <h1>Добавить значение для свойства <b>{{ $property->name }}</b></h1>
                @endisset

    <form method="post" 
          @isset($propertyOption)
                      action="{{ route('property-options.update',[$property,$propertyOption]) }}"
                      @else
                      action="{{ route('property-options.store',$property) }}"
                    @endisset>
        <div>
             @isset($propertyOption)
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
                               value="@isset($propertyOption){{ $propertyOption->name }}@endisset">
                    </div>
                </div>
                <br>
              
                <br>
              
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
    </form>
    @endsection