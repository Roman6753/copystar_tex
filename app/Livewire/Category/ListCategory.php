<?php

namespace App\Livewire\Category;

use App\Exports\CategoriesExpotr;
use App\Imports\CategoriesImportExpotr;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ListCategory extends Component
{
    use WithPagination;
    use WithFileUploads;


    public int $limit = 10;

    public array $list_paginate = [10,15,25,50];

    public string $search = '';

    public string $orderByField = 'ID';

    public string $orderByDirection = 'desc';

    public array $fields = ['ID','Name'];

    public $file;

    public function changeField($field)
    {
        if($this->orderByField == $field)
        {
            $this->orderByDirection = $this->orderByDirection == 'desc' ? 'asc' : 'desc';
        }

        $this->orderByField = $field;
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
    }

    public function changeLimit()
    {
        $this->resetPage();
    }

    #[On('category-created','category-import')]
    public function render()
    {
        $categories = Category::
            whereLike('name','%' . strtolower($this->search) . '%')
            ->orderBy($this->orderByField, $this->orderByDirection)
            ->paginate($this->limit);

        return view('livewire.category.list-category', compact('categories'));
    }

    public function export()
    {
        return Excel::download(new CategoriesExpotr, 'categories.xlsx');
    }

    public function import()
    {
        $validated = $this->validate();
        Excel::import(new CategoriesImportExpotr, $this->file);
        $this->dispatch('category-import');

    }

    public function rules()
    {
        return [
            'file' => 'required|file|mimes:xls,xlsx,csv',
        ];
    }
}
