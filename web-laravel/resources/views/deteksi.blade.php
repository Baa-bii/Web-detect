<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Deteksi Merek Mobil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-500 to-indigo-600 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md text-center">
        
        <h1 class="text-2xl font-bold text-gray-800 mb-2">
            🚗 Deteksi Merek Mobil
        </h1>
        <p class="text-gray-500 mb-6">
            Upload gambar mobil untuk mengetahui mereknya
        </p>

        <form action="/predict" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <label class="block">
                <input 
                    type="file" 
                    name="image" 
                    required
                    class="block w-full text-sm text-gray-600
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-500 file:text-white
                    hover:file:bg-blue-600
                    cursor-pointer"
                >
            </label>

            <button 
                type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition duration-300">
                🔍 Deteksi Sekarang
            </button>
        </form>

        <div class="mt-6 text-sm text-gray-400">
            Sistem Deteksi Menggunakan YOLOv11
        </div>

    </div>

</body>
</html>