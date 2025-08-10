<?php

namespace App\Livewire\Admin\Branch;

use App\Models\Branch;
use App\Models\DeliveryChargeSetup;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateBranchLivewire extends Component
{
    use WithFileUploads;
    
    public $name, $telp, $email, $preparationTime,
    $password, $passwordConfirmation, $branchImage,
    $address, $lat, $lng, $coverage;
    
    public function render()
    {
        return view('livewire.admin.branch.create');
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
        return [
            'name' => 'required',
            'telp' => 'required',
            'email' => 'required|email|unique:branches,email',
            'preparationTime' => 'required',
            'password' => 'required|min:8',
            'passwordConfirmation' => 'required|same:password|min:8',
            'branchImage' => 'required|image|max:5048',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'coverage' => 'required|numeric'
        ];
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

    public function store()
    {
        $this->validate();

        $branches = [
            'name' => $this->name,
            'telp' => '+62' . $this->telp,
            'email' => $this->email,
            'preparation_time' => $this->preparationTime,
            'password' => Hash::make($this->password),
            'address' => $this->address,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'coverage' => $this->coverage,
            'status' => 1,
            'promotion_campaign' => 1
        ];

        $folderPath = public_path('uploads/branch-image');

        if(!File::isDirectory($folderPath)) {
            File::makeDirectory($folderPath, 0755, true, true);
        }

        $fileName = 'branch-image_' . Carbon::now()->format('Y-m-d_His') 
        . '.' . $this->branchImage->getClientOriginalExtension();

        $this->branchImage->storeAs('branch-image', $fileName, 'public_uploads');

        $branches['branch_image'] = 'branch-image/' . $fileName;

        $create = Branch::create($branches);

        if($create) {
            DeliveryChargeSetup::create([
                'branch_id' => $create->id,
                'delivery_charge_type' => 'Tetap',
                'fixed_delivery_charge' => 7000
            ]);
            $this->refresh();
            return $this->redirect(route('admin.branch.index', [
                'event' => 'toastCreateBranch',
                'success' => true,
                'message' => 'Cabang berhasil ditambah'
            ]), true);
        } else {
            $this->dispatch('toastCreateBranch', success: false, message: 'Cabang gagal ditambah');
        }
    }
}
