<div>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">

            <div class="flex flex-col md:flex-row gap-4 mb-8">
                <input
                    wire:model.live.debounce.300ms="search"
                    type="text"
                    placeholder="Search products..."
                    class="flex-1 border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                />

                <select wire:model.live="category_id" class="border border-gray-300 p-2 rounded">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <select wire:model.live="country_id" class="border border-gray-300 p-2 rounded">
                    <option value="">All Countries</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>

                <button
                    wire:click="resetFilters"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Reset
                </button>
            </div>
            @if ($products->isEmpty())
                <div class="w-full text-center py-6">
                    <p class="text-gray-500">No products found.</p>
                </div>
            @else
                <div class="flex flex-wrap -m-4">
                    @foreach ($products as $product)
                        <div class="lg:w-1/4 md:w-1/2 p-4 w-full border-b">
                            <div class="block relative h-48 rounded overflow-hidden">
                                @if ($product->images)
                                    <img alt="{{ $product->name }}"
                                         class="object-cover object-center w-full h-full block"
                                         src="{{ asset('storage/' . $product->images) }}">
                                @else
                                    <img alt="No image"
                                         class="object-cover object-center w-full h-full block"
                                         src="https://via.placeholder.com/420x260?text=No+Image">
                                @endif
                            </div>
                            <div class="mt-4">
                                <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">
                                    {{ $product->category?->name ?? 'Uncategorized' }}
                                    • {{ $product->country?->name ?? 'Unknown' }}
                                </h3>
                                <h2 class="text-gray-900 title-font text-lg font-medium">{{ $product->name }}</h2>
                                <p class="mt-1">${{ number_format($product->price, 2) }}</p>
                                <p class="text-sm text-gray-700">Count: {{ $product->count }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </section>
</div>
