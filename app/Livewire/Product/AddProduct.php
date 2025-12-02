<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Models\Category;
use App\Models\Country;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class AddProduct extends Component
{
    use WithFileUploads;

    public $name = '';
    public $price = '';
    public $description = '';
    public $category_id = '';
    public $country_id = '';
    public $image;
    public $count = 0;
    public $is_active = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'category_id' => 'required|exists:categories,id',
        'country_id' => 'required|exists:countries,id',
        'image' => 'nullable|image|max:2048',
        'count' => 'required|integer|min:0'
    ];

    public function toggleForm()
    {
        $this->is_active = !$this->is_active;

    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'price',
            'description',
            'category_id',
            'country_id',
            'image',
            'count',
            'is_active'
        ]);
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate();

        $productData = [
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'country_id' => $this->country_id,
            'count' => $this->count,
        ];

        if ($this->image) {
            $productData['image'] = $this->image->store('products', 'public');
        }

        Product::create($productData);

        session()->flash('success', 'Product created successfully');
        $this->resetForm();
        $this->showForm = false; // Скрыть форму после сохранения
    }

    public function getCategoriesProperty()
    {
        return Category::orderBy('name')->get();
    }

    public function getCountriesProperty()
    {
        return Country::orderBy('name')->get();
    }

    public function render()
    {
        return view('livewire.product.add-product');
    }
}
