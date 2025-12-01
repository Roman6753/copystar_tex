<div>
    <form wire:submit='import'>
        <label for="category-import">Insert file</label>
        @error('file')
            <span class="text-red-400">{{ $message }}</span>
        @enderror
        <input type="file" id="category-import" hidden wire:model='file'>
        <button type="submit" class="border py-1 px-3 cursor-pointer hover:bg-gray-800 hover:text-gray-50">Import</button>
    </form>
</div>
