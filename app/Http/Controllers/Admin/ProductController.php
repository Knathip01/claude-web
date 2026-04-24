<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.form', ['product' => new Product(), 'isEdit' => false]);
    }

    public function store(Request $request)
    {
        $data = $this->validateProduct($request);
        $data['features'] = $this->parseFeatures($request->input('features_text'));

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'เพิ่มสินค้าเรียบร้อยแล้ว');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', ['product' => $product, 'isEdit' => true]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validateProduct($request);
        $data['features'] = $this->parseFeatures($request->input('features_text'));

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'อัปเดตสินค้าเรียบร้อยแล้ว');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'ลบสินค้าเรียบร้อยแล้ว');
    }

    private function validateProduct(Request $request): array
    {
        return $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'image_path'  => 'nullable|string|max:500',
        ]);
    }

    private function parseFeatures(?string $raw): ?array
    {
        if (!$raw || !trim($raw)) return null;

        $features = [];
        foreach (explode("\n", trim($raw)) as $line) {
            $line  = trim($line);
            $colon = strpos($line, ':');
            if ($colon !== false) {
                $key   = trim(substr($line, 0, $colon));
                $value = trim(substr($line, $colon + 1));
                if ($key !== '') {
                    $features[$key] = $value;
                }
            }
        }

        return count($features) ? $features : null;
    }
}
