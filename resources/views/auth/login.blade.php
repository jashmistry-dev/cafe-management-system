<!DOCTYPE html>

<html lang="en">

<head>
    <title>Cafe Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-orange-50 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">

        
        <h2 class="text-2xl font-bold text-center mb-6 text-orange-600">
            ☕ Cafe Login
        </h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input type="email" name="email" placeholder="Email" class="w-full mb-4 p-2 border rounded-lg">

            <input type="password" name="password" placeholder="Password" class="w-full mb-4 p-2 border rounded-lg">

            <button class="w-full bg-orange-500 text-white py-2 rounded-lg">
                Login
            </button>

        </form>

        @if($errors->any())
            <p class="text-red-500 mt-3 text-sm text-center">
                {{ $errors->first() }}
            </p>
        @endif
        

    </div>

</body>

</html>