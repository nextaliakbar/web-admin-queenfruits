<?php

namespace App\Livewire\Admin\Banner;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class BannerPage extends Component
{
    use WithPagination;

    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $search, $title, $bannerType, $categoryId, $productId, 
    $existingBannerImage, $bannerImage, $bannerId;

    public $bannerTitle, $existBannerImage;

    public $isEditMode = false;

    public function render()
    {
        $data = [
            'banners' => Banner::where('title', 'like', '%' . $this->search . '%')
            ->orderByDesc('id')->paginate(10),
            'categories' => Category::whereStatus(true)->get(),
            'products' => Product::whereIsActive(true)->get()
        ];

        return view('livewire.admin.banner.banner-page', $data);
    }

    public function refresh()
    {
        $this->resetValidation();
        $this->reset([
            'title', 
            'bannerType', 
            'bannerImage',
            'existingBannerImage', 
            'isEditMode'
        ]);
    }

    public function rules()
    {
        $rules = [
            'title' => 'required',
            'bannerType' => 'required',
        ];

        if(!$this->isEditMode) {
            $rules['bannerImage'] = 'required|image|max:5048';

            if(isset($this->categoryId)) $rules['categoryId'] = 'required';

            if(isset($this->productId)) $rules['productId'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul banner tidak boleh kosong',
            'bannerType.required' => 'Tentukan jenis banner',
            'categoryId.required' => 'Tentukan kategori produk',
            'productId.required' => 'Tentukan produk',
            'bannerImage.required' => 'Gambar banner tidak boleh kosong',
            'bannerImage.image' => 'File yang di unggah harus gambar',
            'bannerImage.max' => 'Ukuran maksimal gambar 5mb'
        ];
    }

    public function store()
    {
        $this->isEditMode = false;

        $this->validate();

        $banners = [
            'title' => $this->title,
            'status' => 1
        ];

        if(isset($this->categoryId)) $banners['category_id'] = $this->categoryId;

        if(isset($this->productId)) $banners['product_id'] = $this->productId;

        $folderPath = public_path('uploads/banner-image');

        if(!File::isDirectory($folderPath)) {
            File::makeDirectory($folderPath, 0755, true, true);
        }

        $fileName = 'banner-image_' . Carbon::now()->format('Y-m-d_His')
        . '.' . $this->bannerImage->getClientOriginalExtension();

        $this->bannerImage->storeAs('banner-image', $fileName, 'public_uploads');
        
        $banners['image'] = 'banner-image/' . $fileName;

        $create = Banner::create($banners);

        if($create) {
            $this->refresh();
            $this->dispatch('toastCreateBanner', success: true, message: 'Banner berhasil dibuat');
        } else {
            $this->dispatch('toastCreateBanner', success: false, message: 'Banner gagal dibuat');
        }
    }

    public function updateStatus($bannerId)
    {
        $banner = Banner::findOrFail($bannerId);

        $banner->status = !$banner->status;

        $updateStatus = $banner->update();

        if($updateStatus) {
            $this->dispatch('toastUpdateStatus', success: true, message: 'Status Banner berhasil diubah');
        } else {
            $this->dispatch('toastUpdateStatus', success: true, message: 'Status Banner gagal diubah');
        }
    }

    public function edit($bannerId)
    {
        $this->isEditMode = true;
        $banner = Banner::findOrFail($bannerId);

        $this->title = $banner->title;
        $this->existingBannerImage = $banner->image;
        if($banner->category_id) {
            $this->bannerType = 'Banner Untuk Kategori Produk';
            $this->categoryId = $banner->category_id;
        }

        if($banner->product_id) {
            $this->bannerType = 'Banner Untuk Produk';
            $this->productId = $banner->product_id;
        }

        $this->bannerId = $banner->id;
    }

    public function update()
    {
        $this->isEditMode = true;

        $this->validate();

        $banner = Banner::findOrFail($this->bannerId);

        $banners = [
            'title' => $this->title,
            'status' => $banner->status
        ];

        if(isset($this->categoryId)) $banners['category_id'] = $this->categoryId;

        if(isset($this->productId)) $banners['product_id'] = $this->productId;

        if($this->bannerImage) {
            Storage::disk('public_uploads')->delete($banner->image);

            $fileName = 'banner-image_' . Carbon::now()->format('Y-m-d_His')
            . '.' . $this->bannerImage->getClientOriginalExtension();
    
            $this->bannerImage->storeAs('banner-image', $fileName, 'public_uploads');
            
            $banners['image'] = 'banner-image/' . $fileName;

        } elseif($this->existingBannerImage) {
            $banners['image'] = $this->existingBannerImage;
        }

        $update = $banner->update($banners);

        if($update) {
            $this->refresh();
            $this->dispatch('toastUpdateBanner', success: true, message: 'Banner berhasil diperbarui');
        } else {
            $this->dispatch('toastUpdateBanner', success: false, message: 'Banner gagal diperbarui');
        }
    }

    public function confirm($bannerId)
    {
        $banner = Banner::findOrFail($bannerId);

        $this->bannerTitle = $banner->title;
        $this->existBannerImage = $banner->image;
        $this->categoryId = $banner->category_id;
        $this->productId = $banner->product_id;
        $this->bannerId = $banner->id;
    }

    public function destroy()
    {
        $banner = Banner::findOrFail($this->bannerId);

        Storage::disk('public_uploads')->delete($banner->image);

        $delete = $banner->delete();

        if($delete) {
            $this->dispatch('toastDeleteBanner', success: true, message: 'Banner berhasil dihapus');
        } else {
            $this->dispatch('toastDeleteBanner', success: false, message: 'Banner gagal diperbarui');
        }
    }
}
