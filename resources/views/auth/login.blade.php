@extends('layouts.app')

@section('titulo', 'Iniciar sesión')

@section('contenido')
    <section class="tarjeta tarjeta--formulario">
        <h1>Iniciar sesión</h1>

        <form action="{{ route('login.store') }}" method="POST" class="formulario">
            @csrf

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            @if ($errors->any())
                <p class="error">{{ $errors->first() }}</p>
            @endif

            <button type="submit" class="boton">Entrar</button>
        </form>

        <p>¿No tienes cuenta? <a href="{{ route('register') }}">Crea una aquí</a>.</p>
    </section>
@endsection
