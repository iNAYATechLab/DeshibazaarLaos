<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Product extends Model { protected $fillable=['title','category_id','price','unit','image','description','stock_status']; protected function casts():array{return ['price'=>'decimal:2'];} public function category():BelongsTo{return $this->belongsTo(Category::class);} }
