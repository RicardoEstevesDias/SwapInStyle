<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function create()
    {
        $brands = Brand::all();
        $colors = Color::all();
        $types = Type::all();
        return view('product.create', [
            'brands' => $brands,
            'colors' => $colors,
            'types' => $types,
        ]);
    }

    public function store(ProductRequest $request)
    {
        $title = $request->validated("title");
        $description = $request->validated("description");
        $price = $request->validated("price");
        $gender = $request->validated("gender");
        $size = $request->validated("size");
        $brand_id = $request->validated("brand_id");
        $color_id = $request->validated("color_id");
        $type_id = $request->validated("type_id");

        $image_path = $request->validated("image");
        $image = $image_path->store("products", "public");

        Product::query()->create([
            "user_id" => Auth::id(),
            "title" =>  $title,
            "description" => $description,
            "price" => $price,
            "gender" => $gender,
            "size" => $size,
            "brand_id" => $brand_id,
            "color_id" => $color_id,
            "type_id" => $type_id,
            "image" => $image
        ]);
        return redirect()->route("dashboard")->with("success", "L'article à bien étè ajouté!");
    }


    public function show(Product $product)
    {
        $product = $product->load('user', 'transaction', 'brand', 'color', 'type');
        return view("product.show", compact('product'));
    }


    public function edit(Product $product)
    {
        $this->authorize("update", $product);
        $brands = Brand::all();
        $colors = Color::all();
        $types = Type::all();
        return view("product.edit", [
            'product' => $product,
            'brands' => $brands,
            'colors' => $colors,
            'types' => $types,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize("update", $product);
        $title = $request->input("title");
        $description = $request->input("description");
        $price = $request->input("price");
        $gender = $request->input("gender");
        $size = $request->input("size");
        $type_id = $request->input("type_id");
        $brand_id = $request->input("brand_id");
        $color_id = $request->input("color_id");

        $image_path = $request->file("image");
        $image = null;
        if ($image_path) {
            // TODO gerer l'image
            Storage::disk("public")->delete($product->image);
            $image = $request->file("image")->store("products", "public");
        }

        $product->update([
            "title" => $title,
            "description" => $description,
            "price" => $price,
            "gender" => $gender,
            "size" => $size,
            "type_id" => $type_id,
            "brand_id" => $brand_id,
            "color_id" => $color_id,
        ]);

        if ($image !== null) {
            $product->update([
                "image" =>$image
            ]);
        }
        return redirect()->route("dashboard")->with("success", "L'article à bien étè modifié");
    }

    public function destroy(Product $product)
    {
        $this->authorize("delete", $product);
        Storage::disk("public")->delete($product->image);
        $product->delete();
        return redirect()->route("dashboard")->with("success", "L'article à été supprimé");
    }
}
