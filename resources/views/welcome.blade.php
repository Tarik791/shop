<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">

    <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-col">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8 w-full">
                @foreach($products as $product)
                    <div class="bg-white shadow-lg rounded-xl p-4">
                        
                        @if($product->images->isNotEmpty())
                            <img src="{{ $product->images->first()->url }}" alt="Product Image" class="w-full h-48 object-cover rounded-md mb-4">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-md mb-4 text-gray-500">
                                No Image
                            </div>
                        @endif

                        <h2 class="text-lg font-semibold mb-2">{{ $product->title }}</h2>
                        <p class="text-sm text-gray-600 mb-1">Handle: {{ $product->handle }}</p>
                        <p class="text-md text-green-600 font-bold">€ {{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('products.show', $product->uuid) }}" class="mt-3 inline-block text-blue-600 hover:underline">View details</a>
                    </div>
                @endforeach
            </div>
            <div class="w-full flex justify-center">
                {{ $products->links('vendor.pagination.tailwind') }}
            </div>
        </main>
    </div>

</body>
</html>
