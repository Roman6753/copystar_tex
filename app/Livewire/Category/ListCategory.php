<?php

namespace App\Livewire\Category;


use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;


class ListCategory extends Component
{
    use WithPagination;


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

    #[On('category-created')]
    #[On('category-import')]
    public function render()
    {
        $categories = Category::
            whereLike('name','%' . strtolower($this->search) . '%')
            ->orderBy($this->orderByField, $this->orderByDirection)
            ->paginate($this->limit);

        return view('livewire.category.list-category', compact('categories'));
    }
}
