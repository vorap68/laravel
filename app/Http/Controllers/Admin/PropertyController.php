<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Requests\PropertyRequest;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::all();
        return view('auth.properties.index', compact('properties'));
    }

    public function create()
    {
        return view('auth.properties.form');
    }

    public function store(PropertyRequest $request)
    { 
        Property::create($request->all());
        return redirect()->route('property.index');
    }

   
    public function show(Property $property)
    {
        //$property = Property::find($pr)
        return view('auth.properties.show', compact('property'));
    }

    public function edit(Property $property)
    {
        return view('auth.properties.form', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, Property $property)
    {
        $property->update($request->all());
        return redirect()->route('property.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $property->delete();
         return redirect()->route('property.index');
    }
}
