<header class="cabecera">
    <div class="contenedor cabecera__contenido">
        <a href="{{ route('home') }}" class="cabecera__logo">Práctica Sesiones</a>

        <nav class="menu" aria-label="Menú de usuario">
            @if (session('token'))
                <span class="menu__saludo">Hola, {{ session('name') }}</span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="boton boton--secundario">Cerrar sesión</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="boton boton--secundario">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="boton">Crear cuenta</a>
            @endif
        </nav>
    </div>
</header>
