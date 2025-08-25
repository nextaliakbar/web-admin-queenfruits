<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CategoryLivewire extends Component
{
    use WithPagination;

    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $search, $name, $status, $priority, $categoryFile, $bannerFile,
    $existingCategoryFile, $existingBannerFile, $categoryId,
    $categoryName, $existCategoryFile;

    public $isEditMode = false;

    public function render()
    {
        $data = [
            'categories' => Category::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('priority')->paginate(10),
            'count' => Category::count()
        ];

        return view('livewire.admin.category.index', $data);;
    }

    protected function rules()
    {
        if($this->isEditMode) {
            $rules = [
                'name' => 'required|unique:categories,name,' . $this->categoryId,
                'categoryFile' => 'nullable|image|max:5048',
                'bannerFile' => 'nullable|image|max:5048'
            ];
        } else {
            $rules = [
                'name' => 'required|unique:categories,name',
                'categoryFile' => 'nullable|image|max:5048',
                'bannerFile' => 'nullable|image|max:5048'
            ];
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'name.required' => 'Nama kategori tidak boleh kosong',
            'name.unique' => 'Nama kategori sudah tersedia',
            'categoryFile.image' => 'File yang di unggah harus gambar',
            'categoryFile.max' => 'Ukuran maksimal gambar 5mb',
            'bannerFile.image' => 'File yang di unggah harus gambar',
            'bannerFile.max' => 'Ukuran maksimal gambar 5mb'
        ];
    }

    public function refresh()
    {
        $this->resetValidation();
        $this->reset([
            'categoryId',
            'name',
            'categoryFile',
            'bannerFile',
            'existingCategoryFile',
            'existingBannerFile'
        ]);
    }

    public function store()
    {
        $this->isEditMode = false;

        $this->validate();

        $categoryPath = null;
        if($this->categoryFile) {
            $folderPath = public_path('uploads/category-image');

            if(!File::isDirectory($folderPath)) {
                File::makeDirectory($folderPath, 0755, true, true);
            }

            $fileName = 'category-image_' . Carbon::now()->format('Y-m-d_His') 
            . '.' . $this->categoryFile->getClientOriginalExtension();


            $this->categoryFile->storeAs('category-image', $fileName, 'public_uploads');

            $categoryPath = 'category-image/' . $fileName;
        }

        $bannerPath = null;
        if($this->bannerFile) {
            $folderPath = public_path('uploads/category-banner-image');

            if(!File::isDirectory($folderPath)) {
                File::makeDirectory($folderPath, 0755, true, true);
            }

            $fileName = 'category-banner-image_' . Carbon::now()->format('Y-m-d_His') 
            . '.' . $this->bannerFile->getClientOriginalExtension();


            $this->bannerFile->storeAs('category-banner-image', $fileName, 'public_uploads');

            $bannerPath = 'category-banner-image/' . $fileName;
        }

        $create = Category::create([
            'name' => $this->name,
            'status' => 1,
            'priority' => 10,
            'image' => $categoryPath,
            'banner_image' => $bannerPath
        ]);

        if($create) {
            $this->dispatch('toastCreateCategory', success: true, message: "Kategori produk berhasil ditambah");
        } else {
            $this->dispatch('toastCreateCategory', success: false, message: "Kategori produk gagal ditambah");
        }

        $this->refresh();
    }

    public function updateStatus($categoryId)
    {
        $category = Category::findOrFail($categoryId);

        if($category) {
            $category->status = !$category->status;
            $update = $category->save();
            if($update) {
                $this->dispatch('toastUpdateStatus', success: true, message: 'Status kategori berhasil diubah');
            } else {
                $this->dispatch('toastUpdateStatus', success: false, message: 'Status kategori gagal diubah');
            }
        } else {
            $this->dispatch('toastUpdateStatus', success: false, message: 'Status kategori gagal diubah');
        }
    }

    public function updatePriority($categoryId, $priority)
    {
        $category = Category::findOrFail($categoryId);
        if($category) {
            $category->priority = $priority;
            $update = $category->save();
            if($update) {
                $this->dispatch('toastUpdatePriority', success: true, message: 'Prioritas kategori berhasil diubah');
            } else {
                $this->dispatch('toastUpdatePriority', success: false, message: 'Prioritas kategori gagal diubah');
            }
        } else {
            $this->dispatch('toastUpdatePriority', success: false, message: 'Prioritas kategori gagal diubah');
        }
    }

    public function edit($categoryId)
    {
        $this->isEditMode = true;
        $this->refresh();
        $category = Category::findOrFail($categoryId);

        $this->name = $category->name;
        $this->existingCategoryFile = $category->image;
        $this->existingBannerFile = $category->banner_image;
        $this->categoryId = $category->id;
    }

    public function update()
    {
        $this->isEditMode = true;

        $this->validate();

        $category = Category::findOrFail($this->categoryId);

        $categories = ['name' => $this->name];

        if($this->categoryFile) {
            Storage::disk('public_uploads')->delete($category->image);

            $fileName = 'category-image_' . Carbon::now()->format('Y-m-d_His') 
            . '.' . $this->categoryFile->getClientOriginalExtension();


            $this->categoryFile->storeAs('category-image', $fileName, 'public_uploads');

            $categoryPath = 'category-image/' . $fileName;

            $categories['image'] = $categoryPath;
        }

        if($this->bannerFile) {
            Storage::disk('public_uploads')->delete($category->banner_image);

            $fileName = 'category-banner-image_' . Carbon::now()->format('Y-m-d_His') 
            . '.' . $this->bannerFile->getClientOriginalExtension();


            $this->bannerFile->storeAs('category-banner-image', $fileName, 'public_uploads');

            $bannerPath = 'category-banner-image/' . $fileName;

            $categories['banner_image'] = $bannerPath;
        }

        $update = $category->update($categories);

        if($update) {
            $this->refresh();
            $this->dispatch('toastUpdateCategory', success: true, message: 'Kategori produk berhasil diperbarui');
        } else {
            $this->dispatch('toastUpdateCategory', success: false, message: 'Kategori produk gagal diperbarui');
        }
    }

    public function confirm($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $this->categoryName = $category->name;
        $this->existCategoryFile = $category->image;
        $this->categoryId = $category->id;
    }

    public function destroy()
    {
        $category = Category::findOrFail($this->categoryId);

        if($category->image) {
            Storage::disk('public_uploads')->delete($category->image);
        }

        if($category->banner_image) {
            Storage::disk('public_uploads')->delete($category->banner_image);
        }

        $delete = $category->delete();

        if($delete) {
            $this->dispatch('toastDestroyCategory', success: true, message: 'Kategori produk berhasil dihapus');
        } else {
            $this->dispatch('toastDestroyCategory', success: false, message: 'Kategori produk gagal dihapus');
        }
    }
}
