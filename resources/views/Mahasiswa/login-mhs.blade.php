<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiMON Login Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="bg-[#e8e8d8] p-10 rounded-lg shadow-lg w-full max-w-3xl h-[70vh] flex flex-col items-center gap-10">
        <h2 class="text-3xl font-bold mb-6">LOGIN MAHASISWA</h2>
        <div class="flex flex-col md:flex-row items-center gap-10 w-full justify-center">
            <img src="../assets/img/login-logo.png" alt="Login Illustration" class="w-60">

            <form action="/mahasiswa/dashboard" method="GET" class="flex flex-col gap-4 w-64">
                <input type="text" id="username" placeholder="Username" class="p-3 border rounded-lg shadow-sm w-full" required>
                <input type="password" id="password" placeholder="Password" class="p-3 border rounded-lg shadow-sm w-full" required>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-1">
                        <input type="checkbox" class="accent-red-600">
                        <span>Remember Me</span>
                    </label>
                    <a href="#" class="text-red-600">Forgot Password?</a>
                </div>
                <button type="submit" class="bg-red-700 text-white p-3 rounded-lg shadow-md hover:bg-red-800 text-center w-full">LOG IN</button>
            </form>
        </div>
    </div>
    
</body>
</html>