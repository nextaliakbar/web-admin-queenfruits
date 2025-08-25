<?php

namespace App\Livewire\Admin\Product;

use App\Models\ProductReview;
use Livewire\Component;
use Livewire\WithPagination;

class ProductReviewLivewire extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    public function render()
    {
        $data = [
            'productReviews' => ProductReview::with('product')
            ->whereHas('product', function($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->latest()->paginate(10),
            'count' => ProductReview::count()
        ];

        return view('livewire.admin.product.review', $data);
    }
}
