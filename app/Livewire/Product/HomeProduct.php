<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class HomeProduct extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $category_id = '';
    public $country_id = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';

    protected $queryString = [
        'search' => ['except' => '', 'as' => 'q'],
        'category_id' => ['except' => '', 'as' => 'cat'],
        'country_id' => ['except' => '', 'as' => 'cnt'],
        'sortField' => ['except' => 'id', 'as' => 'sort'],
        'sortDirection' => ['except' => 'desc', 'as' => 'dir'],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        $this->fill(request()->only([
            'search', 'category_id', 'country_id', 'sortField', 'sortDirection', 'page'
        ]));
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'category_id', 'country_id']);
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryId()
    {
        $this->resetPage();
    }

    public function updatingCountryId()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::with(['category', 'country']);

        if (auth()->check() && auth()->user()->moonshine_user_role_id !== 1) {
            $query->where('is_active', true);
        }

        $query->when($this->search, function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%')
              ->orWhere('description', 'like', '%' . $this->search . '%');
        });

        $query->when($this->category_id, function ($q) {
            $q->where('category_id', $this->category_id);
        });

        $query->when($this->country_id, function ($q) {
            $q->where('country_id', $this->country_id);
        });

        $query->orderBy($this->sortField, $this->sortDirection);

        $products = $query->paginate(12);

        return view('livewire.product.home-product', [
            'products' => $products,
            'categories' => Category::orderBy('name')->get(),
            'countries' => Country::orderBy('name')->get(),
        ]);
    }
}