<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\UserIsAdmin;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, "index"])->name("home");

//Route::get('/dashboard', [DashboardController::class, "index"])->middleware("auth")->name("dashboard");

Route::controller(DashboardController::class)->prefix("/dashboard")->group(function (){
    Route::get("/", "index")->name("dashboard")->middleware("auth");
    Route::get("/profile/{user}", "profile")->name("profile")->middleware("auth");
}) ;

Route::controller(AuthController::class)->prefix("/auth")->group(function (){
    Route::get("/register",  "register")->name("register")->middleware("guest");
    Route::post("/register",  "handleRegister")->middleware("guest");
    Route::get("/login",  "login")->name("login")->middleware("guest");
    Route::post("/login",  "handleLogin")->middleware("guest");
    Route::delete("/logout",  "logout")->name("logout")->middleware("auth");
    Route::get("/forgot-password", "resetPassword")->middleware("guest")->name("password.request");
    Route::post("/forgot-password", "forgotPassword")->middleware("guest");
    Route::get('/reset-password/{token}', "resetPasswordForm")->middleware('guest')->name('password.reset');
    Route::post('/reset-password', "handleResetPassword")->middleware('guest')->name('password.update');
}) ;

Route::controller(CategoryController::class)->prefix("/category")->middleware("auth", "admin")->group(function (){
    Route::get("/",  "index")->name("category.index");
    Route::get("/create",  "create")->name("category.create");
    Route::post("/create",  "store");
    Route::get("/{category}/edit/{id}","edit")->name("category.edit");
    Route::post("/{category}/update/{id}", "update")->name("category.update");
    Route::delete("/{category}/destroy/{id}", "destroy")->name("category.destroy");
}) ;

Route::controller(ProductController::class)->prefix("/product")->group(function(){
    Route::get("/create", "create")->name("product.create")->middleware("auth");
    Route::post("/create", "store")->middleware("auth");
    Route::get("/{product}", "show")->name("product.show")->middleware("auth");
    Route::get("/{product}/edit","edit")->name("product.edit")->middleware("auth");
    Route::post("/{product}/update", "update")->name("product.update")->middleware("auth");
    Route::delete("/{product}/destroy", "destroy")->name("product.destroy")->middleware("auth");
});

Route::controller(TransactionController::class)->prefix("/transaction")->group(function(){
    Route::get("/", "index")->name("transaction.index")->middleware("auth");
    Route::post("/store/{product}", "store")->name("transaction.store")->middleware("auth");
});

Route::controller(ConversationController::class)->prefix("/conversation")->group(function(){
    Route::get("/", "index")->name("conversation.index")->middleware("auth");
    Route::get("/find/{user}", "findConversation")->name("conversation.find")->middleware("auth");
    Route::get("/create/{user}", "createConversation")->name("conversation.create")->middleware("auth");
    Route::get("/chat/{conversation}", "chat")->name("conversation.show")->middleware("auth");
    Route::post("/chat/{conversation}/sendMessage", "sendMessage")->name("conversation.send")->middleware("auth");
});
