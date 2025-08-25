<?php

namespace App\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProductLivewire extends Component
{
    use WithFileUploads;

    public $name, $description, $categoryId, $productType,
    $price, $discountType, $discount, $taxType, $tax, 
    $stockType, $stock, $availableTimeStart,
    $availableTimeEnd;

    public $isProductActive = true;

    public $isRecommend = true;

    public $productImages = [];
    
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'categoryId' => 'required',
            'productType' => 'required',
            'price' => 'required|numeric|gt:0',
            'productImages' => 'required',
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
            'productImages.required' => 'Masukkan setidaknya 1 foto produk',
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

    public function refresh()
    {
        $this->resetValidation();
        $this->reset([
            'name',
            'description',
            'categoryId',
            'productType',
            'price',
            'productImages',
            'availableTimeStart',
            'availableTimeEnd',
            'discount',
            'tax',
            'stock'
        ]);
    }

    public function render()
    {
        $data = [
            'categories' => Category::where('status', '!=', '0')->get()
        ];

        return view('livewire.admin.product.create', $data);
    }

    public function store()
    {

        $this->validate();

        $productImages = [];

        $folderPath = public_path('uploads/product-image');
        
        if(!File::isDirectory($folderPath)) {
            File::makeDirectory($folderPath, 755, true, true);
        }
        foreach($this->productImages as $key => $productImage) {

            $fileName = 'product-image-' . ($key + 1) . '_' . Carbon::now()->format('Y-m-d_His')
            . '.' . $productImage->getClientOriginalExtension();

            $productImage->storeAs('product-image', $fileName, 'public_uploads');

            $productImages[$key] = 'product-image/' . $fileName;
        }

        // Create product
        $createProduct = Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->categoryId,
            'product_type' => $this->productType,
            'price' => $this->price,
            'discount_type' => $this->discountType,
            'discount' => $this->discount,
            'tax_type' => $this->taxType,
            'tax' => $this->tax,
            'stock_type' => $this->stockType,
            'stock' => $this->stock,
            'is_active' => $this->isProductActive,
            'images' => $productImages,
            'available_time_start' => $this->availableTimeStart,
            'available_time_end' => $this->availableTimeEnd,
            'is_recommend' => $this->isRecommend
        ]);

        // Create product by branch
        $createProduct->branch_product()->create([
            'branch_id' => session()->get('branch_id') ?? 1,
            'price' => $this->price,
            'discount_type' => $this->discountType,
            'discount' => $this->discount,
            'stock_type' => $this->stockType,
            'stock' => $this->stock,
            'is_available' => true
        ]);

        if($createProduct && $createProduct) {
            $this->refresh();
            return $this->redirect(route('admin.product.index', [
                'event' => 'toastCreateProduct',
                'success' => true,
                'message' => 'Produk berhasil ditambah'
            ]), true);
        } else {
            $this->dispatch('toastCreateProduct', success: false, message: 'Produk gagal ditambah');
        }
    }
}
