<!DOCTYPE html>
    <html lang="id">
        <head>
            <meta charset="UTF-8">
            <title>Hasil Deteksi</title>
            <script src="https://cdn.tailwindcss.com"></script>
        </head>

        <body class="bg-gradient-to-br from-indigo-500 to-blue-600 min-h-screen flex items-center justify-center p-6">

            <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-5xl">

                <h1 class="text-2xl font-bold text-center mb-6">
                🔍 Hasil Deteksi Merek Mobil
                </h1>

                <div class="grid grid-cols-2 gap-6">

                <!-- BEFORE IMAGE -->
                <div>
                    <h2 class="text-center font-semibold mb-2">Before</h2>
                    <img src="{{ $imagePath }}" class="rounded-xl shadow w-full">
                </div>

                <!-- AFTER IMAGE -->
                <div>
                    <h2 class="text-center font-semibold mb-2">After (Detection)</h2>

                    <div class="relative inline-block">
                        <img id="detectedImage" src="{{ $imagePath }}" class="rounded-xl shadow">

                        <canvas id="bboxCanvas" class="absolute top-0 left-0"></canvas>
                    </div>
                </div>

            </div>

            <!-- RESULT LIST -->
            <div class="mt-8 space-y-3">
            @if(isset($result['detections']))
            @foreach($result['detections'] as $det)

            <div class="border rounded-lg p-3 flex justify-between">
            <span>🚗 {{ $det['brand'] }}</span>
            <span class="font-semibold text-green-600">
            {{ $det['confidence'] }}%
            </span>
            </div>

            @endforeach
            @endif
            </div>

            <div class="text-center mt-6">
            <a href="/" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg">
            ⬅ Upload Lagi
            </a>
            </div>

            </div>

        </body>
    </html>


<script>
const detections = @json($result['detections']);

const img = document.getElementById("detectedImage");
const canvas = document.getElementById("bboxCanvas");
const ctx = canvas.getContext("2d");

img.onload = function () {

    canvas.width = img.clientWidth;
    canvas.height = img.clientHeight;

    const scaleX = img.clientWidth / img.naturalWidth;
    const scaleY = img.clientHeight / img.naturalHeight;

    detections.forEach(det => {

        const [x1, y1, x2, y2] = det.bbox;

        const boxX = x1 * scaleX;
        const boxY = y1 * scaleY;
        const boxW = (x2 - x1) * scaleX;
        const boxH = (y2 - y1) * scaleY;

        ctx.strokeStyle = "#22c55e";
        ctx.lineWidth = 3;
        ctx.strokeRect(boxX, boxY, boxW, boxH);

        ctx.fillStyle = "#22c55e";
        ctx.font = "14px Arial";
        const label = `${det.brand} (${det.confidence}%)`;

        // ukuran teks
        ctx.font = "14px Arial";
        const textWidth = ctx.measureText(label).width;
        const textHeight = 16;

        // tentukan posisi Y (jangan keluar canvas)
        let textY = boxY - 8;
        if (textY < textHeight) {
            textY = boxY + textHeight + 4; // pindah ke bawah box
        }

        // background label
        ctx.fillStyle = "#22c55e";
        ctx.fillRect(boxX, textY - textHeight, textWidth + 6, textHeight + 4);

        // teks
        ctx.fillStyle = "#ffffff";
        ctx.fillText(label, boxX + 3, textY);
            });
        };
</script>