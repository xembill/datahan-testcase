<?php
/**
 * Datahan Test-Case 1
 * V1.0
 *
 *  Created by Seçkin Kılınç.
 */
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\Variant;
use App\Models\User;

class Dashboard extends BaseController
{
    public function index()
    {
        $productModel = new Product();
        $variantModel = new Variant();
        $userModel = new User();

        $data = [
            'totalProducts' => $productModel->countAll(),
            'totalVariants' => $variantModel->countAll(),
            'totalUsers'    => $userModel->countAll(),
            'lastLogin'     => session('user.last_login') ?? 'Bilinmiyor',
        ];

        return view('admin/dashboard', $data);
    }
}