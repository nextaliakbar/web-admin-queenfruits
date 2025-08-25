<?php

namespace App\Livewire\Admin\Pos;

use App\Models\Branch;
use App\Models\Category;
use App\Models\CustomerAddress;
use App\Models\DeliveryChargeSetup;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductByBranch;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CreatePosLivewire extends Component
{
    use WithPagination;

    public $searchProduct, $categoryId, $customer, 
    $branchId, $branchName, $name, $telp,
    $email, $contactPersonName, $contactPersonNumber,
    $address, $lat, $lng, $productId, $productName, 
    $productPrice, $productTax, $productDiscount, 
    $productDesc, $qty, $totalPrice;

    public $customerId = -1;

    public $productImages = [];

    public $carts = [];

    public $orderType = 'Ambil Ditoko';

    public $paymentMethod = 'Tunai';

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->carts = session()->get('carts', []);

        $this->branchId = session()->get('branchId', 1);
        $this->branchName = Branch::findOrFail($this->branchId)->name;
    }

    public function render()
    {
        $data = [
            'categories' => Category::whereStatus(1)->get(),
            'products' => Product::with('branch_product')
            ->whereHas('branch_product', function ($query) {
                $query->where('branch_id', '=',$this->branchId)
                      ->where('is_available', '=',true);
            })
            ->when($this->categoryId, function ($query) {
                $query->where('category_id', '=',$this->categoryId);
            })
            ->where('name', 'like', '%'.$this->searchProduct .'%')
            ->paginate(10), 
            'branches' => Branch::whereStatus(1)->get(),
            'users' => User::whereIsActive(true)->get()
        ];

        return view('livewire.admin.pos.create', $data);
    }

    #[On('customerSelected')]
    public function updateCustomer($customerId)
    {
        if($customerId == 0) {
            $this->customer = null;
            $this->customerId = 0;
            return;
        }

        $this->customer = User::with('customer_addresses')
        ->findOrFail($customerId);
        $this->customerId = $customerId;
    }

    #[On('branchSelected')]
    public function updateBranchId($branchId)
    {
        $this->branchId = $branchId;
        $this->branchName = Branch::findOrFail($branchId)->name;
    }

    // Create customer start
    public function refreshFieldsCustomer()
    {
        $this->resetValidation();
        $this->reset([
            'name', 'telp', 'email'
        ]);
    }

    public function storeCustomer()
    {
        $this->validate([
            'name' => 'required',
            'telp' => 'required|numeric',
            'email' => 'nullable|email|unique:users,email'
        ], [
            'name.required' => 'Nama pelanggan tidak boleh kosong',
            'telp.required' => 'Nomor telepon tidak boleh kosong',
            'telp.numeric' => 'Format nomor telepon hanya diisi angka',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar'
        ]);

        $user = new User();

        $user->name = $this->name;
        $user->phone = '+62' . $this->telp;
        $user->is_active = true;
        if(filled($this->email)) $user->email= $this->email;

        $create = $user->save();

        if($create) {
            $this->refreshFieldsCustomer();
            $this->dispatch('toastCreateCustomer', success: true, message: 'Pelanggan berhasil ditambah');
        } else {
            $this->dispatch('toastCreateCustomer', success: false, message: 'Pelanggan gagal ditambah');
        }
    }
    // Create customer end

    // Create customer address start
    public function refreshFieldsCustomerAddress()
    {
        $this->resetValidation();
        $this->reset([
            'contactPersonName', 'contactPersonNumber', 'address', 'lat', 'lng'
        ]);
    }

    public function createCustomerAddress()
    {
        if($this->customerId <= 0) {
            $this->dispatch('toastValidateFail', success: false, message: 'Pilih pelanggan terlebih dahulu');
            return;
        }

        $this->contactPersonName = $this->customer->name;
        $this->contactPersonNumber = str_replace('+62', '', $this->customer->phone);
        $this->dispatch('showNewCustomerAddressModal');
    }

    public function storeCustomerAddress()
    {
        $this->validate([
            'contactPersonName' => 'required',
            'contactPersonNumber' => 'required|numeric',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ], [
            'contactPersonName.required' => 'Nama kontak tidak boleh kosong',
            'contactPersonNumber.required' => 'Nomor telepon tidak boleh kosong',
            'contactPersonNumber.numeric' => 'Format nomor telepon hanya diisi angka',
            'address.required' => 'Alamat tidak boleh kosong',
            'lat.required' => 'Latitude tidak boleh kosong',
            'lng.required' => 'Longitude tidak boleh kosong'
        ]);

        $customerAddress = new CustomerAddress();
        $customerAddress->user_id = $this->customerId;
        $customerAddress->contact_person_name = $this->contactPersonName;
        $customerAddress->contact_person_number = '+62' . $this->contactPersonNumber;
        $customerAddress->address = $this->address;
        $customerAddress->latitude = $this->lat;
        $customerAddress->longitude = $this->lng;
        $customerAddress->is_choosen = true;

        $create = $customerAddress->save();

        $updateIsChoosen = CustomerAddress::where('id', '!=', $customerAddress->id)
        ->where('user_id', '=', $customerAddress->user_id)
        ->update(['is_choosen' => false]);

        if($create && $updateIsChoosen) {
            $this->refreshFieldsCustomerAddress();
            $this->dispatch('toastCreateCustomerAddress', success: true, message: 'Alamat berhasil ditambah');
        } else {
            $this->dispatch('toastCreateCustomerAddress', success: false, message: 'Alamat gagal ditambah');
        }
    }
    // Create customer address end

    // Setting delivery address start
    public function listDeliveryAddress()
    {
        if($this->customerId <= 0) {
            $this->dispatch('toastValidateFail', success: false, message: 'Pilih pelanggan terlebih dahulu');
            return;
        }
        $this->dispatch('showListDeliveryAddressModal');
    }

    public function setDeliveryAddress($customerAddressId)
    {
        $updateById = CustomerAddress::where('id', '=', $customerAddressId)
        ->update(['is_choosen' => true]);

        $update = CustomerAddress::where('id', '!=', $customerAddressId)
        ->where('user_id', '=', $this->customerId)
        ->update(['is_choosen' => false]);

        if($updateById && $update) {
            $this->dispatch('toastSetDeliveryAddress', success: true, message: 'Alamat pengiriman berhasil perbarui');
        } else {
            $this->dispatch('toastSetDeliveryAddress', success: true, message: 'Alamat pengiriman gagal perbarui');
        }
    }
    // Setting delivery address end

    public function quickView($productId)
    {
        $product = Product::findOr($productId);
        $productByBranch = ProductByBranch::where('product_id', '=', $productId)
        ->firstOrFail();
        $this->productName = $product->name;
        $this->productPrice = $product->price;
        $this->productTax = $product->tax_type ? ($product->tax_type == 'Pajak Langsung' ? $product->tax : (($product->price / 100) * $product->tax)) : 0;
        $this->productDiscount = $productByBranch->discount_type ? ($productByBranch->discount_type == 'Diskon Langsung' ? $productByBranch->discount 
        : (($productByBranch->price / 100) * $productByBranch->discount)) : 0; 
        $this->productDesc = $product->description;
        $this->productImages = $product->images;
        $this->qty = 1;
        $this->totalPrice = $this->productPrice;
        $this->productId = $product->id;
    }

    public function increase()
    {
        $this->qty++;
        $this->updateTotalPrice();
    }

    public function decrease()
    {
        if($this->qty <= 1) return;
        $this->qty--;
        $this->updateTotalPrice();
    }

    private function updateTotalPrice()
    {
        $this->totalPrice = $this->qty * $this->productPrice;
    }

    public function updatedQty($value)
    {
        if(!is_numeric($value)) return;
        $this->qty = $value;
        $this->updateTotalPrice();
    }

    public function addToCart()
    {
        $existingItemKey = null;

        foreach($this->carts as $key => $item) {
            if($item['id'] == $this->productId) {
                $existingItemKey = $key;
                break;
            }
        }

        if($existingItemKey !== null) {
            $this->carts[$existingItemKey]['qty'] += $this->qty;
            $this->carts[$existingItemKey]['tax'] += $this->productTax * $this->qty;
            $this->carts[$existingItemKey]['discount'] += $this->productDiscount * $this->qty;
            $this->carts[$existingItemKey]['totalPrice'] += $this->totalPrice;
        } else {
            $image = null;
    
            foreach($this->productImages as $img) {
                if($img) $image = $img; break;
            }
            
            $this->totalPrice = $this->qty * $this->productPrice;

            $carts = [
                'id' => $this->productId,
                'name' => $this->productName,
                'description' => $this->productDesc,
                'image' => $image,
                'qty' => $this->qty,
                'price' => $this->productPrice,
                'tax' => $this->productTax * $this->qty,
                'discount' => $this->productDiscount * $this->qty,
                'totalPrice' => $this->totalPrice
            ];
    
            $this->carts[] = $carts;
        }

        session()->put('carts', $this->carts);

        $this->dispatch('closeQuickViewModal');
    }

    public function removeFromCart($index)
    {
        unset($this->carts[$index]);

        session()->put('carts', $this->carts);
    }

    #[Computed]
    public function items()
    {
        $tax = 0;
        $discount = 0;
        $price = 0;

        foreach ($this->carts as $cart) {
            $tax += $cart['tax'];
            $discount += $cart['discount'];
            $price += $cart['price'] * $cart['qty'];
        }

        $subtotal = $price + $tax - $discount;

        $deliveryChargeSetup = DeliveryChargeSetup::where('branch_id', '=', $this->branchId)
        ->firstOrFail();

        $deliveryFee = $this->orderType == 'Pengiriman' 
        ? ($deliveryChargeSetup->delivery_charge_type == 'Biaya Per Km' ? 10000 : $deliveryChargeSetup->fixed_delivery_charge) : 0;
        $total = $subtotal + $deliveryFee;

        return [
            'tax' => $tax,
            'discount' => $discount,
            'subtotal' => $subtotal,
            'deliveryFee' => $deliveryFee,
            'total' => $total,
        ];
    }

    public function makeSale()
    {
        if($this->customerId < 0) {
            $this->dispatch('toastValidateFail', success: false, message: 'Pilih pelanggan terlebih dahulu');
            return;
        }
        
        if($this->orderType == 'Pengiriman') {
            $customerAddress = CustomerAddress::where('user_id', '=', $this->customerId)
            ->where('is_choosen', '=', true)
            ->first();

            if(empty($customerAddress)) {
                $this->dispatch('toastValidateFail', success: false, message: 'Alamat pengiriman belum diatur');
                return;
            }
        }

        if(empty($this->carts)) {
            $this->dispatch('toastValidateFail', success: false, message: 'Tidak ada item yang dipilih');
            return;
        }

        try {
            DB::transaction(function() {
                $customerAddress = CustomerAddress::where('user_id', '=', $this->customerId)
                ->where('is_choosen', '=', true)
                ->first();
                $order = new Order();
                $order->branch_id = $this->branchId;
                $order->user_id = $this->customerId;
                $order->delivery_address_id = $customerAddress->id ?? null;
                $order->order_type = $this->orderType == 'Pengiriman' ? 'Pengiriman' : 'POS';
                
                $totalDiscount = 0;
                $totalTaxAmount = 0;
                $orderAmount = 0;
                foreach($this->carts as $cart) {
                    $orderAmount += $cart['totalPrice'];
                    if(!empty($cart['discount'])) {
                        $totalDiscount += $cart['discount'];
                    }
                    
                    if(!empty($cart['tax'])) {
                        $totalTaxAmount += $cart['tax'];
                    }
                }

                $order->order_amount = $orderAmount;
                $order->payment_status = 'Terbayar';
                $order->order_status = $this->orderType == 'Pengiriman' ? 'Dikonfirmasi' : 'Terkirim';
                $order->total_discount = $totalDiscount > 0 ? $totalDiscount : null;
                $order->total_tax_amount = $totalTaxAmount  > 0 ? $totalTaxAmount : null;
                $order->payment_method = $this->paymentMethod;
                $order->cheked = 1;
                
                if($this->orderType == 'Pengiriman' && isset($customerAddress)) {
                    $order->delivery_date = Carbon::now()->toDateString();
                    $order->delivery_time = Carbon::now()->toTimeString();
                    $order->delivery_address = [
                        'contact_person_name' => $customerAddress->contact_person_name,
                        'contact_person_number' => $customerAddress->contact_person_number,
                        'address' => $customerAddress->address,
                        'latitude' => $customerAddress->latitude,
                        'longitude' => $customerAddress->longitude
                    ];
                    $deliveryChargeSetup = DeliveryChargeSetup::where('branch_id', '=', $this->branchId)
                    ->first();
                    $order->delivery_charge = $deliveryChargeSetup->delivery_charge_type == 'Tetap' 
                    ? $deliveryChargeSetup->fixed_delivery_charge : 12500;
                    $preparationTime = Branch::where('id', '=', $this->branchId)->value('preparation_time');
                    $order->preparation_time = $preparationTime;
                }
        
                $order->save();
        
                foreach($this->carts as $cart) {                    
                    $order->order_details()->create([
                        'product_id' => $cart['id'],
                        'product_details' => [
                            'name' => $cart['name'],
                            'descripton' => $cart['description'],
                            'image' => $cart['image'],
                        ],
                        'price' => $cart['price'],
                        'discount_type' => $cart['discount'] ? 'Diskon Dari Produk' : null,
                        'discount' =>  $cart['discount'] ?? null,
                        'quantity' => $cart['qty'],
                        'tax_amount' => $cart['tax'] ?? null
                    ]);
                }
            });
            $this->carts = [];
            session()->put('carts', $this->carts);
            $this->dispatch('toastCreateOrder', success: true, message: 'Berhasil Membuat Penjualan Baru');
        } catch(Exception $ex) {
            $this->dispatch('toastValidateFail', success: false, message: 'Terjadi kesalahan, penjualan gagal dibuat');
        }

    }
}
