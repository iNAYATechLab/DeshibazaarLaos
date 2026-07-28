<?php
namespace App\Http\Controllers;
use App\Models\Category;use App\Models\Product;
class StoreController extends Controller {
 public function __invoke(){return view('store.index',['categories'=>Category::where('is_active',true)->with(['products'=>fn($q)=>$q->where('stock_status','in_stock')->latest()])->orderBy('name')->get(),'whatsAppNumber'=>preg_replace('/\D/','',config('deshibazaar.whatsapp_inquiry_number'))]);}
 public function category(Category $category){abort_unless($category->is_active,404);return view('store.category',['category'=>$category,'products'=>$category->products()->where('stock_status','in_stock')->latest()->get()]);}
 public function product(Product $product){abort_unless($product->stock_status==='in_stock',404);return view('store.product',compact('product'));}
}
