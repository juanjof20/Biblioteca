<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;

class PrestaController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Usuario $usuario)
    {
        $usuarios = $usuario->with('libros')->get();
        return $this->showAll($usuarios);
    }

    /*
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario, $id)
    {
        $prestamo = $usuario->with('libros')->find($id);
        return $this->showOne($prestamo);
    }
}