<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiKRS - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen">
    <div class="bg-blue-100 p-8 rounded-lg shadow-lg w-96">
        <div class="text-center mb-4 flex items-center justify-center">
            <img src="{{ asset('image/krs.png') }}" alt="Logo SiKRS" class="h-14 mr-1">
            <h2 class="text-2xl font-bold text-gray-800">SiKRS</h2>
        </div>
        
        <form action="/" method="POST" class="space-y-4">
            <div>
                <label class="block font-semibold">Username</label>
                <input type="text" name="username" placeholder="masukkan nip..." 
                class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block font-semibold">Password</label>
                <input type="password" name="password" placeholder="*" 
                    class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div class="flex justify-center">
                <a href="/admin/dashboard" class="btn w-full text-center bg-blue-500 text-white p-3 rounded hover:bg-blue-700">
                    LOGIN
                </a>
            </div>
            
        </form>
    </div>
</body>
</html>