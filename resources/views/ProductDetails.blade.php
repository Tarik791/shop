<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <div class="min-h-screen bg-white dark:bg-gray-900 text-black dark:text-white p-6">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold mb-4">{{ $product->title }}</h1>
            <p class="text-gray-700 dark:text-gray-300 mb-2">Handle: {{ $product->handle }}</p>
            <p class="text-xl font-semibold mb-6">Base Price: ${{ number_format($product->price, 2) }}</p>

            <h2 class="text-2xl font-bold mb-3">Varijante proizvoda</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($product->variants as $variant)
                    <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-4 shadow-sm">
                        <p class="text-lg font-semibold">Varijanta: {{ $variant->handle }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Cijena: ${{ number_format($variant->price, 2) }}</p>
                        @if($variant->image)
                            <img src="{{ $variant->image->url }}" alt="Image for {{ $variant->handle }}"
                                class="w-full h-48 object-cover rounded-md mt-4">
                        @endif
                    </div>
                @endforeach
            </div>
            <a href="{{ route('products.index') }}" class="inline-block mt-8 text-blue-600 hover:underline">
                ⬅ Nazad na proizvode
            </a>
        </div>
    </div>
</body>
</html>
