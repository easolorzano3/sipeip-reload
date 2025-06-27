<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-800 to-blue-600">
        <div class="bg-blue-900 text-white p-8 rounded-xl shadow-lg w-full max-w-md">
            <div class="flex justify-center mb-6">
                <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png" class="w-16 h-16 rounded-full" alt="User Icon">
            </div>
            <h2 class="text-center text-xl font-semibold mb-4">Iniciar Sesión</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm mb-1" for="email">Correo</label>
                    <input class="w-full p-2 rounded bg-blue-700 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400" type="email" name="email" placeholder="ejemplo@correo.com" required autofocus />
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1" for="password">Contraseña</label>
                    <input class="w-full p-2 rounded bg-blue-700 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400" type="password" name="password" placeholder="********" required />
                </div>
                <div class="flex items-center justify-between mb-4 text-sm">
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox text-blue-500" name="remember">
                        <span class="ml-2">Recordarme</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-blue-300 hover:text-white">¿Olvidaste tu clave?</a>
                </div>
                <button class="w-full bg-blue-500 hover:bg-blue-600 p-2 rounded text-white font-semibold transition duration-300" type="submit">
                    Ingresar
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
