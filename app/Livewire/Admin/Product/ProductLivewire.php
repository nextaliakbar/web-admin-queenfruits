<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ProductLivewire extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search, $productImages, $name, $price,
    $totalSale, $stock, $productId;

    
    public $event, $success, $message;

    protected $queryString = ['event','success', 'message'];

    public function mount()
    {
        if($this->event == 'toastCreateProduct' && $this->success) {
            $this->dispatch($this->event, success: $this->success, message: $this->message);
        }

        if($this->event == 'toastUpdateProduct' && $this->success) {
            $this->dispatch($this->event, success: $this->success, message: $this->message);
        }
    }

    public function render()
    {
        $data = [
            'products' => Product::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')->paginate(10),
            'count' => Product::count()
        ];

        return view('livewire.admin.product.index', $data);
    }

    public function updateStatus($productId)
    {
        $product = Product::findOrFail($productId);
        $product->is_active = !$product->is_active;
        $update = $product->save();
        
        if($update) {
            $this->dispatch('toastUpdateStatus', success: true, message: 'Status produk berhasil di ubah');
        } else {
            $this->dispatch('toastUpdateStatus', success: false, message: 'Status produk gagal di ubah');
        }
    }

    public function updateRecommend($productId)
    {
        $product = Product::findOrFail($productId);
        $product->is_recommend = !$product->is_recommend;
        $update = $product->save();
        
        if($update) {
            $this->dispatch('toastUpdateRecommend', success: true, message: 'Rekomendasi produk berhasil di ubah');
        } else {
            $this->dispatch('toastUpdateRecommend', success: false, message: 'Rekomendasi produk gagal di ubah');
        }
    }

    public function confirm($productId)
    {
        $product = Product::findOrFail($productId);

        $this->productImages = $product->images;
        $this->name = $product->name;
        $this->price = $product->price;

        $this->totalSale = 10;

        if($product->stock_type == 'Tak Terbatas') {
            $this->stock = $product->stock_type;
        } else if($product->stock_type == 'Tetap') {
            $this->stock = $product->stock;
        }

        $this->productId = $product->id;
    }

    public function destroy()
    {
        $product = Product::findOrFail($this->productId);

        foreach($product->images as $productImage) {
            Storage::disk('public_uploads')->delete($productImage);
        }

        $delete = $product->delete();

        if($delete) {
            $this->dispatch('toastDeleteProduct', success: true, message: 'Data produk berhasil dihapus');
        } else {
            $this->dispatch('toastDeleteProduct', success: false, message: 'Data produk gagal dihapus');
        }
    }
}
