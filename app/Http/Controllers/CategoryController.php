<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Type;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){

        $brands = Brand::query()
            ->orderBy("created_at", "DESC")
            ->paginate(12)
        ;

        $colors = Color::query()
            ->orderBy("created_at", "DESC")
            ->paginate(12)
        ;

        $types = Type::query()
            ->orderBy("created_at", "DESC")
            ->paginate(12)
        ;

        return view("category.index", [
            "brands" => $brands,
            "colors" => $colors,
            "types" => $types,
        ]);
    }


    public function create(){
        return view("category.create");
    }


    public function store(CategoryRequest $request){
        $name = $request->validated("name");
        $category = $request->validated("category");
        if($category === "brand"){
            Brand::query()->create([
                "name" => $name,
            ]);
        }
        else if($category === "color"){
            Color::query()->create([
                "name" => $name,
            ]);
        }
        else if($category === "type"){
            Type::query()->create([
                "name" => $name,
            ]);
        }

        return redirect()->route("category.create")->with("success", "La catégorie à bien été ajouté!");
    }


    public function edit($category, $id){
        if($category === "brand"){
            $name = Brand::find($id)->name;
        }
        else if($category === "color"){
            $name = Color::find($id)->name;
        }
        else if($category === "type"){
            $name = Type::find($id)->name;
        }
        else{
            return redirect()->route('category.index')->with('error', 'Catégorie inexistante');
        }
        return view('category.edit', [
                                        'category' => $category,
                                        'id' => $id,
                                        'name' => $name
                                    ]);
    }

    public function update(Request $request, $category, $id){
        $name = $request->input('name');
        if($category === "brand"){
            $model = Brand::find($id);
            $model->update([
                "name" => $name,
            ]);
        }
        else if($category === "color"){
            $model = Color::find($id);
            $model->update([
                "name" => $name,
            ]);
        }
        else if($category === "type"){
            $model = Type::find($id);
            $model->update([
                "name" => $name,
            ]);
        }else{return redirect()->route('category.index')->with('error', 'Catégorie inexistante');}
        return redirect()->route('category.index')->with('success', 'Catégorie modifié');
    }


    public function destroy($category, $id){
        if($category === "brand"){
            $model = Brand::find($id);
            $model->delete();
        }
        else if($category === "color"){
            $model = Color::find($id);
            $model->delete();
        }
        else if($category === "type"){
            $model = Type::find($id);
            $model->delete();
        }else{return redirect()->route('category.index')->with('error', 'Catégorie inexistante');}
        return redirect()->route('category.index')->with('success', 'Catégorie supprimée');
    }
}
