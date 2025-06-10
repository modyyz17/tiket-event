<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-sm">
        <h2 class="text-2xl font-bold mb-4 text-center text-blue-600">Login</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-600 p-2 mb-4 rounded">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-2 mb-4 rounded">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" class="w-full border rounded px-2 py-1" required>
            </div>

            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" class="w-full border rounded px-2 py-1" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white w-full py-2 rounded">Login</button>

            <p class="mt-4 text-center">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-blue-600">Register</a>
            </p>
        </form>
    </div>
</body>
</html>
