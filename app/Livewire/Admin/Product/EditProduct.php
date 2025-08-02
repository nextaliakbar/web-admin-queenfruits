<?php

namespace App\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
    use WithFileUploads;

    public $productId, $name, $description, $categoryId, $productType,
    $price, $discountType, $discount, $taxType, $tax, $stockType, $stock, 
    $existingProductImages, $isProductActive, $availableTimeStart,
    $availableTimeEnd, $isRecommend;

    public $productImages = [];

    public function mount($productId)
    {
        $this->getData($productId);
    }

    public function resetFields()
    {
        $this->getData($this->productId);  
    }

    private function getData($productId)
    {
        $product = Product::findOrFail($productId);

        $this->productId = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->categoryId = $product->category_id;
        $this->productType = $product->product_type;
        $this->price = $product->price;
        $this->discountType = $product->discount_type;

        if($this->discountType) $this->discount = $product->discount;

        $this->taxType = $product->tax_type;
        
        if($this->taxType) $this->tax = $product->tax;

        $this->stockType = $product->stock_type;
        
        if($this->stockType == 'Tetap') $this->stock = $product->stock;

        $this->existingProductImages = $product->images;
        $this->isProductActive = $product->is_active;
        $this->availableTimeStart = $product->available_time_start;
        $this->availableTimeEnd = $product->available_time_end;
        $this->isRecommend = $product->is_recommend;

        $this->productImages = [];
    }

    public function rules()
    {
        $rules = [
            'name' => 'required',
            'categoryId' => 'required',
            'productType' => 'required',
            'price' => 'required|numeric|gt:0',
            'availableTimeStart' => 'required',
            'availableTimeEnd' => 'required'
        ];

        if($this->discountType) {
            $rules['discount'] = 'required|numeric|gt:0';
        }

        if($this->taxType) {
            $rules['tax'] = 'required|numeric|gt:0';
        }

        if($this->stockType == 'Tetap') {
            $rules['stock'] = 'required|numeric|gt:0';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'categoryId.required' => 'Tentukan kategori produk',
            'productType.required' => 'Tentukan jenis produk',
            'price.required' => 'Harga tidak boleh kosong',
            'price.numeric' => 'Format harga hanya diisi angka',
            'price.gt' => 'Isi minimal harga sebanyak Rp 1',
            'availableTimeStart.required' => 'Tentukan waktu mulai tersedia produk',
            'availableTimeEnd.required' => 'Tentukan waktu akhir tersedia produk ',
            'discount.required' => 'Diskon tidak boleh kosong',
            'discount.numeric' => 'Format diskon hanya diisi angka',
            'discount.gt' => 'Isi minimal diskon sebanyak Rp 1 atau 1 %',
            'tax.required' => 'Pajak tidak boleh kosong',
            'tax.numeric' => 'Format pajak hanya diisi angka',
            'tax.gt' => 'Isi minimal pajak sebanyak Rp 1 atau 1 %',
            'stock.required' => 'Stok tidak boleh kosong',
            'stock.numeric' => 'Format stok hanya diisi angka',
            'stock.gt' => 'Isi minimal stok sebanyak 1'
        ];
    }

    public function render()
    {
        $data = [
            'categories' => Category::where('status', '!=', '0')->get(),
        ];

        return view('livewire.admin.product.edit-product', $data);
    }

    private function refresh()
    {
        $this->resetValidation();
        $this->reset([
            'name',
            'description',
            'categoryId',
            'productType',
            'price',
            'productImages',
            'existingProductImages',
            'availableTimeStart',
            'availableTimeEnd',
            'discount',
            'tax',
            'stock'
        ]);
    }

    public function update()
    {
        $this->validate();

        $product = Product::findOrFail($this->productId);

        $product->name = $this->name;
        $product->description = $this->description;
        $product->category_id = $this->categoryId;
        $product->product_type = $this->productType;
        $product->discount_type = $this->discountType;
        $product->discount = $this->discount;
        $product->tax_type = $this->taxType;
        $product->tax = $this->tax;
        $product->stock_type = $this->stockType;
        $product->stock = $this->stock;

        $productImages = $product->images;

        if($this->productImages) {
            foreach($this->productImages as $key => $productImage) {

                if(!$productImage) continue;
                
                if(isset($productImages[$key])) {
                    Storage::disk('public_uploads')->delete($productImages[$key]);
                }

                $fileName = 'product-image-' . ($key + 1) . '_' . Carbon::now()->format('Y-m-d_His')
                . '.' . $productImage->getClientOriginalExtension();

                $productImage->storeAs('product-image', $fileName, 'public_uploads');

                $productImages[$key] = 'product-image/' . $fileName;
            }
        }

        $product->images = $productImages;
        $product->is_active = $this->isProductActive;
        $product->available_time_start = $this->availableTimeStart;
        $product->available_time_end = $this->availableTimeEnd;
        $product->is_recommend = $this->isRecommend;

        $update = $product->update();

        if($update) {
            $this->refresh();
            return $this->redirect(route('admin.product.index', [
                'event' => 'toastUpdateProduct',
                'success' => true,
                'message' => 'Produk berhasil diperbarui'
            ]), true);
        } else {
            $this->dispatch('toastUpdateProduct', success: false, message: 'Produk gagal diperbarui');
        }
    }
}
