<?php

namespace App\Livewire\Admin\Branch;

use App\Models\Branch;
use App\Models\DeliveryChargeSetup;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class BranchLivewire extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search, $name, $email, $telp, $address, $branchId;

    public $event, $success, $message;

    protected $queryString = ['event', 'success', 'message'];

    public function mount()
    {
        if($this->event == 'toastCreateBranch' && $this->success) {
            $this->dispatch($this->event, success: $this->success, message: $this->message);
        }

        if($this->event == 'toastUpdateBranch' && $this->success) {
            $this->dispatch($this->event, success: $this->success, message: $this->message);
        }
    }

    public function render()
    {
        $data = [
            'branches' => Branch::where('name', 'like', '%' . $this->search . '%')
            ->with('delivery_charge_setup')->orderByDesc('id')->paginate(10),
            'count' => Branch::count()
        ];

        return view('livewire.admin.branch.index', $data);
    }

    public function updateStatus($branchId)
    {
        $branch = Branch::findOrFail($branchId);
        $branch->status = !$branch->status;
        $update = $branch->save();
        
        if($update) {
            $this->dispatch('toastUpdateStatus', success: true, message: 'Status cabang berhasil di ubah');
        } else {
            $this->dispatch('toastUpdateStatus', success: false, message: 'Status cabang gagal di ubah');
        }
    }

    public function updatePromotionCampaign($branchId)
    {
        $branch = Branch::findOrFail($branchId);
        $branch->promotion_campaign = !$branch->promotion_campaign;
        $update = $branch->save();
        
        if($update) {
            $this->dispatch('toastUpdatePromotionCampaign', success: true, message: 'Promosi cabang berhasil di ubah');
        } else {
            $this->dispatch('toastUpdatePromotionCampaign', success: false, message: 'Promosi cabang gagal di ubah');
        }
    }

    public function confirm($branchId)
    {
        $branch = Branch::findOrFail($branchId);

        $this->name = $branch->name;
        $this->email = $branch->email;
        $this->telp = $branch->telp;
        $this->address = $branch->address;
        $this->branchId = $branch->id;
    }

    public function destroy()
    {
        $branch = Branch::findOrFail($this->branchId);

        Storage::disk('public_uploads')->delete($branch->branch_image);

        DeliveryChargeSetup::where('branch_id', '=', $branch->id)->delete();

        $delete = $branch->delete();

        if($delete) {
            $this->dispatch('toastDeleteBranch', success: true, message: 'Cabang berhasil dihapus');
        } else {
            $this->dispatch('toastDeleteBranch', success: false, message: 'Cabang gagal dihapus');
        }
    }
}
