<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $products = Product::query()
            ->with("user")
            ->where("status", "disponible")
            ->orderBy("created_at", "DESC")
            ->paginate(12)
        ;

        return view("dashboard", ["products" => $products]);
    }


    public function profile(User $user){
        $products = Product::query()
            ->with("transaction")
            ->where("user_id", $user->id)
            ->orderBy("created_at", "DESC")
            ->paginate(12)
        ;
        $sold = Product::where('status', 'vendu')->count();
        return view("user.profile", [
            "products" => $products,
            "user" => $user,
            "sold" => $sold,
    ]);
    }
}
