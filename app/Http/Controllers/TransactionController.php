<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achats = Transaction::with(['product', 'seller'])->where('buyer_id', Auth::id())->get();
        $ventes = Transaction::with(['product', 'buyer'])->where('seller_id', Auth::id())->get();
        $estVideAchats = $achats->isEmpty();
        $estVideVentes = $ventes->isEmpty();
        return view("user.transactions", compact('achats', 'ventes', 'estVideAchats', 'estVideVentes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Product $product)
    {
        if($product->status === "vendu"){
            return redirect()->route("dashboard")->with("error", "L'article à déja été vendu");
        }
        if(Auth::id() === $product->user_id){
            return redirect()->route("dashboard")->with("error", "Vous ne pouvez pas acheter cet article");
        }
        Transaction::query()->create([
            "buyer_id" => Auth::id(),
            "seller_id" => $product->user_id,
            "product_id" => $product->id,
            "amount" => $product->price,
         ]);

        $product->update([
            "status" => "vendu",
        ]);

        return redirect()->route("dashboard")->with("success", "L'article à bien été acheté! Achat enregisté dans 'Transactions' ");
    }
}
