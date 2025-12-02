<div>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-2 mx-auto">
            <button
                wire:click="toggleForm"
                class="border">
                {{ 'Add Product' }}
            </button>

            @if ($is_active)
                <div class="container px-5 py-6 mx-auto bg-gray-50 rounded-lg shadow-md">
                    <div class="flex flex-col text-center w-full mb-6">
                        <h1 class="sm:text-2xl text-xl font-medium title-font mb-2 text-gray-900">Add New Product</h1>
                    </div>

                    <form wire:submit.prevent="save">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                                <input type="text"
                                       wire:model="name"
                                       id="name"
                                       class="w-full bg-white rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                                <input type="number"
                                       wire:model="price"
                                       id="price"
                                       step="0.01"
                                       class="w-full bg-white rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('price') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="count" class="block text-sm font-medium text-gray-700 mb-1">Count</label>
                                <input type="number"
                                       wire:model="count"
                                       id="count"
                                       min="0"
                                       class="w-full bg-white rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('count') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                <select wire:model="category_id" id="category_id" class="w-full bg-white rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <option value="">Select Category</option>
                                    @foreach($this->categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="country_id" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                <select wire:model="country_id" id="country_id" class="w-full bg-white rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <option value="">Select Country</option>
                                    @foreach($this->countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                                <input type="file"
                                       wire:model="image"
                                       id="image"
                                       class="w-full bg-white rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('image') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror

                                @if ($image)
                                    <div class="mt-3">
                                        <p class="text-sm text-gray-600">Image Preview:</p>
                                        <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-32 h-32 object-cover mt-2 rounded border border-gray-300">
                                    </div>
                                @endif
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox"
                                           wire:model="is_active"
                                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <span class="ml-2">Active</span>
                                </label>
                            </div>
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea wire:model="description"
                                          id="description"
                                          rows="4"
                                          class="w-full bg-white rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea>
                                @error('description') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="md:col-span-2 flex space-x-4 justify-end">
                                <button type="button"
                                        wire:click="toggleForm"
                                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded transition-colors duration-200">
                                    Cancel
                                </button>
                                <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded transition-colors duration-200">
                                    Save Product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </section>
</div>
