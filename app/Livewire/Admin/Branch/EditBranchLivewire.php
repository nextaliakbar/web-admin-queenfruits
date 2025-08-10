<?php

namespace App\Livewire\Admin\Branch;

use App\Models\Branch;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditBranchLivewire extends Component
{
    use WithFileUploads;
    
    public $name, $telp, $email, $preparationTime,
    $password, $passwordConfirmation, $branchImage,
    $existingBranchImage, $address, $lat, $lng,
    $coverage, $branchId;

    public function mount($branchId)
    {
        $this->getData($branchId);
    }


    public function resetFields()
    {
        $this->resetValidation();
        $this->getData($this->branchId);
    }
    private function getData($branchId)
    {
        $branch = Branch::findOrFail($branchId);

        $this->name = $branch->name;
        $this->telp = substr($branch->telp, 3);
        $this->email = $branch->email;
        $this->preparationTime = $branch->preparation_time;
        $this->existingBranchImage = $branch->branch_image;
        $this->address = $branch->address;
        $this->lat = $branch->lat;
        $this->lng = $branch->lng;
        $this->coverage = $branch->coverage;
        $this->branchId = $branch->id;
    }

    public function refresh()
    {
        $this->resetValidation();
        $this->reset([
            'name', 'telp', 'email', 'preparationTime',
            'password', 'passwordConfirmation', 'branchImage',
            'address', 'lat', 'lng', 'coverage'
        ]);
    }

    public function rules()
    {
        $rules = [
            'name' => 'required',
            'telp' => 'required',
            'email' => 'required|email|unique:branches,email,' . $this->branchId,
            'preparationTime' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'coverage' => 'required|numeric'
        ];

        if(filled($this->password)) {
            $rules['password'] = 'required|min:8';
            $rules['passwordConfirmation'] = 'required|same:password|min:8';
        }

        if(filled($this->branchImage)) $rules['branchImage'] = 'required|image|max:5048';

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama cabang tidak boleh kosong',
            'telp.required' => 'No.telp tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak cocok',
            'email.unique' => 'Email sudah tersedia',
            'preparationTime.required' => 'Waktu persiapan pesanan tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'passwordConfirmation.required' => 'Konfirmasi password tidak boleh kosong',
            'passwordConfirmation.same' => 'Konfirmasi password tidak cocok',
            'passwordConfirmation.min' => 'Konfirmasi password minimal 8 karakter',
            'branchImage.required' => 'Foto cabang tidak boleh kosong',
            'branchImage.image' => 'File foto cabang harus berupa gambar (.jpg, .jpeg, .png)',
            'address.required' => 'Alamat tidak boleh kosong',
            'lat.required' => 'Titik koordinasi latitude tidak boleh kosong',
            'lng.required' => 'Titik koordinasi longitude tidak boleh kosong',
            'coverage.required' => 'Cakupan radius tidak boleh kosong',
            'coverage.numeric' => 'Cakupan radius harus berisi angka'
        ];
    }

    public function render()
    {
        return view('livewire.admin.branch.edit');
    }

    public function update()
    {
        $this->validate();

        $branch = Branch::findOrFail($this->branchId);

        $branches = [
            'name' => $this->name,
            'telp' => '+62' . $this->telp,
            'email' => $this->email,
            'preparation_time' => $this->preparationTime,
            'address' => $this->address,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'coverage' => $this->coverage
        ];

        if(filled($this->password)) {
            $branches['password'] = Hash::make($this->password);
        }

        if($this->branchImage) {
            Storage::disk('public_uploads')->delete($branch->branch_image);

            $fileName = 'branch-image_' . Carbon::now()->format('Y-m-d_His')
            . '.' . $this->branchImage->getClientOriginalExtension();

            $this->branchImage->storeAs('branch_image', $fileName, 'public_uploads');

            $branches['branch_image'] = 'branch_image/' . $fileName;
        } else {
            $branches['branch_image'] = $this->existingBranchImage;
        }

        $update = $branch->update($branches);

        if($update) {
            $this->refresh();
            return $this->redirect(route('admin.branch.index', [
                'event' => 'toastUpdateBranch',
                'success' => true,
                'message' => 'Cabang berhasil diperbarui'
            ]), true);
        } else {
            $this->dispatch('toastUpdateBranch', success: false, message: 'Cabang gagal diperbarui');
        }
    }
}
