<?php
/**
 * Datahan Test-Case 1
 * V1.0
 *
 *  Created by Seçkin Kılınç.
 */
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Variant;
use App\Models\VariantOption;

class Variants extends BaseController
{
    // List view: Tüm varyantları listeler
    public function index()
    {
        $variantModel = new Variant();
        $optionModel = new VariantOption();

        $variants = $variantModel->findAll();

        foreach ($variants as &$variant) {
            $options = $optionModel->where('variant_id', $variant['id'])->findAll();
            $variant['options'] = array_column($options, 'value'); // sadece değerleri al
        }

        $data['variants'] = $variants;
        return view('admin/variants/index', $data);
    }

    // Yeni varyant ekleme formunu gösterir
    public function new()
    {
        return view('admin/variants/new');
    }

    // Varyant ekleme işlemi
    public function create()
    {
        helper(['form']);

        $rules = [
            'name' => 'required',
            'options' => 'required'  // options, array formatında gönderilmeli
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('error', 'Lütfen formu kontrol ediniz.');
            return redirect()->back()->withInput();
        }

        $variantModel = new Variant();
        $dataVariant = [
            'name' => $this->request->getPost('name')
        ];

        $variantId = $variantModel->insert($dataVariant);

        $options = $this->request->getPost('options'); // Beklenen format: array
        $variantOptionModel = new VariantOption();

        if(is_array($options)){
            foreach($options as $option){
                $variantOptionModel->insert([
                    'variant_id' => $variantId,
                    'value'     => $option
                ]);
            }
        }

        session()->setFlashdata('success', 'Varyant başarıyla eklendi.');
        return redirect()->to('/admin/variants');
    }

    // Varyant görüntüleme
    public function show($id)
    {
        $variantModel = new Variant();
        $variantOptionModel = new VariantOption();

        $data['variant'] = $variantModel->find($id);
        $data['options'] = $variantOptionModel->where('variant_id', $id)->findAll();

        return view('admin/variants/edit', $data);
    }

    // Varyant düzenleme formu
    public function edit($id)
    {
        $variantModel = new Variant();
        $variantOptionModel = new VariantOption();

        $data['variant'] = $variantModel->find($id);
        $data['options'] = $variantOptionModel->where('variant_id', $id)->findAll();

        return view('admin/variants/edit', $data);
    }

    // Varyant güncelleme işlemi
    public function update($id)
    {
        helper(['form']);

        $rules = [
        'name' => 'required',
        'options' => 'required'
    ];

        if (!$this->validate($rules)) {
        session()->setFlashdata('error', 'Lütfen formu kontrol ediniz.');
        return redirect()->back()->withInput();
    }

        $variantModel = new Variant();
        $variantOptionModel = new VariantOption();

        $variantModel->update($id, [
        'name' => $this->request->getPost('name')
        ]);

        $variantOptionModel->where('variant_id', $id)->delete();

        $options = $this->request->getPost('options');
        if(is_array($options)){
        foreach($options as $option){
            $variantOptionModel->insert([
                'variant_id' => $id,
                    'value'     => $option
                ]);
            }
        }

        session()->setFlashdata('success', 'Varyant güncellendi.');
        return redirect()->to('/admin/variants');
    }

    // Varyant silme
    public function delete($id)
    {
        $variantModel = new Variant();
        $variantOptionModel = new VariantOption();

        $variantOptionModel->where('variant_id', $id)->delete();
        $variantModel->delete($id);

        session()->setFlashdata('success', 'Varyant silindi.');
        return redirect()->to('/admin/variants');
    }
}
