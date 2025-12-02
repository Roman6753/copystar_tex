<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ListProduct extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $category_id = '';
    public $country_id = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $fields = ['ID', 'Name', 'Price', 'Count', 'Category', 'Country', 'Actions'];

    protected $queryString = [
        'search' => ['except' => ''],
        'category_id' => ['except' => ''],
        'country_id' => ['except' => ''],
    ];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function resetFilters()
    {
        $this->reset(['search', 'category_id', 'country_id']);
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        session()->flash('success', 'Product deleted successfully');
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::query()
            ->with(['category', 'country'])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->category_id, function ($query) {
                $query->where('category_id', $this->category_id);
            })
            ->when($this->country_id, function ($query) {
                $query->where('country_id', $this->country_id);
            })
            ->when(auth()->user() && auth()->user()->moonshine_user_role_id !== 1, function ($query) {
                $query->where('is_active', true);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.product.list-product', [
            'products' => $products,
            'categories' => Category::orderBy('name')->get(),
            'countries' => Country::orderBy('name')->get()
        ]);
    }
}
