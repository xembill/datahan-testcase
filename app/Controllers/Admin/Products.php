<?php
/**
 * Datahan Test-Case 1
 * V1.0
 *
 *  Created by Seçkin Kılınç.
 */
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariantOption;
use App\Models\Variant;
use App\Models\VariantOption;

class Products extends BaseController
{
    // Ürünleri listeler
    public function index()
    {
        $productModel = new Product();
        $imageModel = new ProductImage();

        $products = $productModel->findAll();

        foreach ($products as &$product) {
            $mainImage = $imageModel->where([
                'product_id' => $product['id'],
                'is_main' => 1
            ])->first();

            $product['main_image'] = $mainImage['image_path'] ?? null;
        }

        return view('admin/products/index', ['products' => $products]);
    }

    // Yeni ürün formu
    public function new()
    {
        $variantModel = new Variant();
        $optionModel = new VariantOption();

        $variants = $variantModel->findAll();
        foreach ($variants as &$variant) {
            $variant['options'] = $optionModel->where('variant_id', $variant['id'])->findAll();
        }

        return view('admin/products/new', ['variants' => $variants]);
    }

    // Ürün son kullanıcı listeleme
    public function list()
    {
        $productModel = new Product();
        $imageModel = new ProductImage();

        $products = $productModel->findAll();

        foreach ($products as &$product) {
            $mainImage = $imageModel
                ->where('product_id', $product['id'])
                ->where('is_main', 1)
                ->first();

            $product['main_image'] = $mainImage['image_path'] ?? null;
        }

        return view('admin/products/list', ['products' => $products]);
    }

    // Ürün kaydı
    public function create()
    {
        helper(['form', 'filesystem']);

        $rules = [
            'name' => 'required',
            'price' => 'required|decimal',
            'main_image' => 'required|is_natural',
            'variants' => 'required'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('error', 'Lütfen tüm alanları doğru doldurunuz.');
            return redirect()->back()->withInput();
        }

        $productModel = new Product();
        $productImageModel = new ProductImage();
        $productVariantOptionModel = new ProductVariantOption();

        $productData = [
            'name'  => $this->request->getPost('name'),
            'price' => $this->request->getPost('price')
        ];

        $productId = $productModel->insert($productData);

        // Ana görsel sırası
        $mainImageIndex = (int) $this->request->getPost('main_image');

        // Görselleri al ve kaydet
        $files = $this->request->getFileMultiple('images');

        foreach ($files as $index => $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(WRITEPATH . 'uploads/products', $newName);

                $productImageModel->insert([
                    'product_id' => $productId,
                    'image_path' => 'uploads/products/' . $newName,
                    'is_main'    => ($index === $mainImageIndex) ? 1 : 0
                ]);
            }
        }

        // Varyant opsiyonlarını kaydet
        $optionIds = $this->request->getPost('variants');
        foreach ($optionIds as $optionId) {
            $productVariantOptionModel->insert([
                'product_id'         => $productId,
                'option_id'  => $optionId,
                'varyant_id'  => $optionId
            ]);
        }

        session()->setFlashdata('success', 'Ürün başarıyla eklendi.');
        return redirect()->to('/admin/products');
    }

    // Ürün detayı
    public function show($id)
    {
        $productModel = new Product();
        $imageModel = new ProductImage();
        $optionModel = new VariantOption();
        $variantModel = new Variant();
        $pivotModel = new ProductVariantOption();

        $product = $productModel->find($id);
        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Ürün bulunamadı.');
        }

        $images = $imageModel->where('product_id', $id)->findAll();

        // Varyant ilişkileri
        $pivotRows = $pivotModel->where('product_id', $id)->findAll();
        $optionIds = array_column($pivotRows, 'option_id');

        $options = [];
        foreach ($optionIds as $optId) {
            $opt = $optionModel->find($optId);
            if ($opt) {
                $variant = $variantModel->find($opt['variant_id']);
                $options[] = [
                    'variant' => $variant['name'],
                    'value'   => $opt['value']
                ];
            }
        }

        return view('admin/products/show', [
            'product' => $product,
            'images'  => $images,
            'options' => $options
        ]);
    }

    // Ürün silme
    public function delete($id)
    {
        $productModel = new Product();
        $imageModel = new ProductImage();
        $pivotModel = new ProductVariantOption();

        $images = $imageModel->where('product_id', $id)->findAll();
        foreach ($images as $img) {
            $path = WRITEPATH . $img['image_path'];
            if (is_file($path)) {
                @unlink($path);
            }
        }

        $imageModel->where('product_id', $id)->delete();
        $pivotModel->where('product_id', $id)->delete();
        $productModel->delete($id);

        session()->setFlashdata('success', 'Ürün silindi.');
        return redirect()->to('/admin/products');
    }
}
