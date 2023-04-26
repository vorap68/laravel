<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyOptions;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyOptionsController extends Controller
{
   
    public function index(Property $property)
    {
       $propertyOptions = PropertyOptions::where('property_id',$property->id)->get();
        return view('auth.property_options.index', compact('propertyOptions','property'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Property $property)
    {
        //dd($property);
       return view('auth.property_options.form',compact('property')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Property $property)
    {
        $params = $request->all();
        $params['property_id']= $request->property->id;
       // dd($params);
        PropertyOptions::create($params);
        return redirect()->route('property.index',$property);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PropertyOptions  $propertyOptions
     * @return \Illuminate\Http\Response
     */
   public function show(Property $property, PropertyOptions $propertyOption)
    {
        return view('auth.property_options.show', compact('property','propertyOption'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PropertyOptions  $propertyOptions
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property,PropertyOptions $propertyOption)
    {
       // dd($property);
       // dd($propertyOptions);
        return view('auth.property_options.form',compact('propertyOption','property')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PropertyOptions  $propertyOptions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Property $property, PropertyOptions $propertyOption)
    {
         $params = $request->all();
        //$params['property_id']= $request->property->id;
      //  dd($params);
       $propertyOption->update($params);
      // dd(PropertyOptions::all());
        return redirect()->route('property.index',$property);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropertyOptions  $propertyOptions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property, PropertyOptions $propertyOption)
    {
        $propertyOption->delete();
        return redirect()->route('property-options.index', $property);
    }
}
