<?php
namespace App\Http\Controllers;use App\Models\Category;
class StoreController extends Controller { public function __invoke(){return view('store.index',['categories'=>Category::where('is_active',true)->with(['products'=>fn($q)=>$q->where('stock_status','in_stock')->latest()])->orderBy('name')->get(),'whatsAppNumber'=>preg_replace('/\D/','',config('deshibazaar.whatsapp_inquiry_number'))]);}}
