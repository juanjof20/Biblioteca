<?php

namespace App\Http\Controllers;

use App\Libro;
use App\Usuario;
use Illuminate\Http\Request;

class PrestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Usuario $usuario)
    {
        $usuarios = $usuario->with('libros')->get();
        return $this->showAll($usuarios);
        // return $this->showAll(Prestamo::all()); crear modelo factory seeder
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $rules = [
        //     'usuario_id' => 'required',
        //     'libro_id' => 'required',
        // ];
        // $messages = [
        //     'required' => 'El campo :attribute es obligatorio.',
        // ];
        // $validatedData = $request->validate($rules, $messages);
        // $libro = Libro::create($validatedData);
        // return $this->showOne($libro,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = Usuario::find($id)->libros;
        return $this->showAll($usuario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
