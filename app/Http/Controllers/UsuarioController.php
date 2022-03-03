<?php

use PhpParser\Builder\Namespace_;

Namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->showAll(Usuario::all());
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
        $rules = [
            'nombre' => 'required|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:6|confirmed',
        ];
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'email.email' => 'El campo correo no tiene el formato adecuado.',
            'password' => 'La contraseña es un campo obligatorio',
        ];
        $validatedData = $request->validate($rules, $messages);
        $validatedData['password'] = bcrypt($validatedData['password']);
        $usuario = Usuario::create($validatedData);
        return $this->showOne($usuario,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        return $this->showOne($usuario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        $rules = 
        [
            'nombre' => 'min:5|max:255',
            'email' => ['email', Rule::unique('usuarios')->ignore($usuario->id)],
            'password' => 'min:8',
        ];
        $validatedData = $request->validate($rules);

        if ($request->filled('password'))
        {
            $validatedData['password'] = bcrypt($request->input('password'));
        }

        $usuario->fill($validatedData);

        if(!$usuario->isDirty())
        {
            return response()->json(['error'=>['code' => 422, 'message' => 'especifica al menos un valor diferente' ]], 422);
        }
        $usuario->save();
        return $this->showOne($usuario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return $this->showOne($usuario);
    }
}
