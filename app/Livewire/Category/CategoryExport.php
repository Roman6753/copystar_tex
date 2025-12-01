<?php

namespace App\Livewire\Category;

use App\Exports\CategoryExport as ExportsCategoryExport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class CategoryExport extends Component
{

    public function export()
    {
        return Excel::download(new ExportsCategoryExport, 'categories.xlsx');
    }

    public function render()
    {
        return view('livewire.category.category-export');
    }
}
