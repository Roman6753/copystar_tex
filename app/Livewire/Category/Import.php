<?php

namespace App\Livewire\Category;

use App\Imports\CategoryImport;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Import extends Component
{
    use WithFileUploads;

    #[Validate()]
    public $file;

    public function rules()
    {
        return [
            'file' => 'required|file|mimes:xlsx,xls,csv|max:1024'
        ];
    }

    public function import()
    {
        $this->validate();
        Excel::import(new CategoryImport, $this->file);
        $this->dispatch('category-import');
    }



    public function render()
    {
        return view('livewire.category.import');
    }
}
