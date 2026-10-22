@extends('layouts.app')

@section('titulo', 'Inicio')

@section('contenido')
    <section class="tarjeta">
        @if (session('token'))
            <h1>Bienvenido, {{ session('name') }}</h1>
            <p>Has iniciado sesión. Tu token de sesión está guardado en los datos de la sesión.</p>
        @else
            <h1>Bienvenido</h1>
            <p>Inicia sesión o crea una cuenta desde los botones del header.</p>
        @endif
    </section>
@endsection
