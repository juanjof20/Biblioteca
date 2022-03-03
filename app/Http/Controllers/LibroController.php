<?php

namespace App\Http\Controllers;

use App\Libro;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Rule;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->showAll(Libro::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'titulo' => 'required|max:255|unique:libros,titulo',
            'descripcion' => 'max:500',
        ];
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
        ];
        $validatedData = $request->validate($rules, $messages);
        $libro = Libro::create($validatedData);
        return $this->showOne($libro,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show(Libro $libro)
    {
        return $this->showOne($libro);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Libro $libro)
    {
        $rules = [
            'titulo' => 'min:5|max:255|unique:libros,titulo',
            'descripcion' => 'max:500',
        ];
        $validatedData = $request->validate($rules);

        $libro->fill($validatedData);

        if(!$libro->isDirty())
        {
            return response()->json(['error'=>['code' => 422, 'message' => 'especifica al menos un valor diferente' ]], 422);
        }
        $libro->save();
        return $this->showOne($libro);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Libro $libro)
    {
        $libro->delete();
        return $this->showOne($libro);
    }
}
