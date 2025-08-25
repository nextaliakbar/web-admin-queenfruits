<?php

namespace App\Http\Controllers\Web\Admin\Pos;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;

class CreatePosController extends Controller
{
    
    public function searchCustomer(Request $request)
    {
        $searchTerm = $request->query('searchCustomer');

        $customers = User::where('name', 'like', '%'.$searchTerm.'%')
            ->where('is_active', true)
            ->limit(10)
            ->get(['id', 'name as text']);

        $customers[] = (object)['id' => 0, 'text' => 'Pelanggan Masuk'];

        return response()->json($customers);
    }

    public function searchBranch(Request $request)
    {
        $searchTerm = $request->query('searchBranch');

        $branches = Branch::where('name', 'like', '%'.$searchTerm.'%')
            ->limit(10)
            ->get(['id', 'name as text']);

        return response()->json($branches);
    }
}
