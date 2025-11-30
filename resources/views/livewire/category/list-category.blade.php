<div>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-2 mx-auto">
            <button wire:click="export">Export</button>
            <form wire:click="import">
                <input type="file" wire:model="file">
                <button type="submit">Импортировать</button>
            </form>
            <div class="flex flex-col text-center w-full">
                <h2 class="sm:text-2xl text-xl font-medium title-font mb-4 text-gray-900">List Category</h2>
                <div class="flex justify-between">
                    <select wire:model="limit" wire:change="changeLimit" class="border border-gray-300 py-1">
                        @foreach ($list_paginate as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach

                    </select>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Seach..."
                        class="border border-gray-300 p-1">
                </div>
                @if (count($categories) < 1)
                    Category not found
                @else
                    <table>
                        <thead>
                            <tr class="grid grid-cols-[1fr_10fr_1fr] justify-items-start p-2 ">
                                @foreach ($fields as $key => $field)
                                    <th wire:click='changeField("{{ $field }}")' class="cursor-pointer" wire:key='{{ $key }}'>
                                        <x-sort :field="$field" :orderByField="$orderByField" :direction="$orderByDirection" />
                                    </th>
                                @endforeach
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="grid grid-cols-[1fr_10fr_1fr] justify-items-start items-center p-2 odd:bg-white even:bg-gray-50"
                                    wire:key="{{ $category->id }}">
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <button wire:click="deleteCategory({{ $category->id }})"
                                            class="inline-flex items-center bg-red-100 border-0 py-1 px-3 focus:outline-none hover:bg-red-400 rounded text-base mt-4 md:mt-0 text-wite">Delete</button>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    {{ $categories->links() }}
                @endif

            </div>

        </div>
    </section>

</div>
