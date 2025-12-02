<div>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-2 mx-auto">
            <div class="flex flex-col text-center w-full">
                <h2 class="sm:text-2xl text-xl font-medium title-font mb-4 text-gray-900">Products</h2>

                <div class="flex justify-between mb-4">
                    <input wire:model.live.debounce.300ms="search"
                           type="text"
                           placeholder="Search..."
                           class="border border-gray-300 p-2 rounded">
                </div>

                <div class="flex justify-between mb-4">
                    <div class="flex space-x-2">
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
                    </div>

                    <button wire:click="resetFilters" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Reset Filters
                    </button>
                </div>

                @if ($products->isEmpty())
                    <div class="py-4 text-center text-gray-500">
                        No products found
                    </div>
                @else
                    @php
                        $fields = ['ID', 'Name', 'Price', 'Count', 'Category', 'Country', 'Delete'];
                    @endphp

                    <table class="w-full">
                        <thead>
                            <tr class="grid grid-cols-[1fr_3fr_1fr_1fr_2fr_2fr_1fr] justify-items-start p-2 bg-gray-100">
                                @foreach ($fields as $key => $field)
                                    @if ($field !== 'Actions')
                                        <th wire:click='sortBy("{{ strtolower($field) }}")' class="cursor-pointer" wire:key='{{ $key }}'>
                                            <div class="flex items-center">
                                                {{ $field }}
                                                @if ($sortField === strtolower($field))
                                                    <span class="ml-1">
                                                        {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                                                    </span>
                                                @endif
                                            </div>
                                        </th>
                                    @else
                                        <th>{{ $field }}</th>
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="grid grid-cols-[1fr_3fr_1fr_1fr_2fr_2fr_1fr] justify-items-start items-center p-2 odd:bg-white even:bg-gray-50"
                                    wire:key="{{ $product->id }}">
                                    <td>{{ $product->id }}</td>
                                    <td class="truncate">{{ $product->name }}</td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->count }}</td>
                                    <td>{{ $product->category?->name ?? 'N/A' }}</td>
                                    <td>{{ $product->country?->name ?? 'N/A' }}</td>
                                    <td>
                                        <button
                                            wire:click="deleteProduct({{ $product->id }})"
                                             class="inline-flex items-center bg-red-100 border-0 py-1 px-3 focus:outline-none hover:bg-red-400 rounded text-base mt-4 md:mt-0 text-wite">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
