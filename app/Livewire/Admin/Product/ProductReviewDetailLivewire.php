<?php

namespace App\Livewire\Admin\Product;

use App\Models\ProductReview;
use Livewire\Component;

class ProductReviewDetailLivewire extends Component
{
    public function mount($productId)
    {
        
    }

    public function render()
    {
        $data = [
            'count' => ProductReview::count()
        ];

        return view('livewire.admin.product.review-detail', $data);
    }
}
