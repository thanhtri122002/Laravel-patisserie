<?php

namespace App\Services\admin;

use App\Http\Requests\admin\ProductImageRequest;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductImageService extends Service
{
    public function index()
    {
        return ProductImage::with('product')->get();
    }

    public function detail($id)
    {
        return ProductImage::with('product')->findOrFail($id);
    }

    public function store(ProductImageRequest $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'images.*' => 'required|image|max:2048',
        ]);

        $product = Product::findOrFail($request->product_id);
        $productFolder = Str::slug($product->name);
        $images = [];

        foreach ($request->file('images') as $file) {
            $safeName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                . '-' . Str::uuid()
                . '.' . $file->getClientOriginalExtension();
            // products/<product-name>/
            $path = $file->storeAs(
                'products/' . $productFolder,
                $safeName,
                'public'
            );

            $images[] = ProductImage::create([
                'product_id' => $request->product_id,
                'url' => $path,
                'name' => $safeName,
            ]);
        }

        return $images;
    }
    public function update($data, $id)
    {
        $image = $this->detail($id);
        $image->update($data);

        return $image;
    }
    public function delete($id)
    {

        $image = $this->detail($id);
        Storage::disk('public')->delete($image->url);
        $image->delete();

        return true;
    }
}
