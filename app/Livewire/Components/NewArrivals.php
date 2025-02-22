<?php

namespace App\Livewire\Components;

use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class NewArrivals extends Component
{

    public Collection $categories;
    public Category $selectedCategory;

    public function mount():void
    {
        $firstsCategories = Category::where('slug', '!=', 'discounts')->take(4)->get();
        $discountCategory = Category::where('slug', 'discounts')->first();
        $this->categories = $firstsCategories->merge([$discountCategory]);
        $this->selectedCategory = $firstsCategories->first();
    }

    public function selectCategory(string $categorySlug)
    {
        $this->selectedCategory = $this->categories->firstWhere('slug', $categorySlug);
    }

    public function render():View
    {
        return view('livewire.components.new-arrivals');
    }
}
