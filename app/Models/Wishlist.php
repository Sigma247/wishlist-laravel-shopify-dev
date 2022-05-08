<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Wishlist extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'shop_id',
        'product_id',
        'product_price',
        'product_data',
        'customer_id',
    ];
    


    public static function getTodaysWishlist(){
        return self::whereDate('updated_at', Carbon::today())->count();
    }

    public static function getYesterdaysWishlist(){
        return self::whereDate('updated_at', Carbon::yesterday())->count();
    }

    public static function getTotalWishlist(){
        return self::all()->count();
    }

    public static function getWishlistSocialCount($shop_id, $product_id){

        return self::where('shop_id', $shop_id)
                    ->where('product_id', $product_id)
                    ->count();
    }

    public static function loadWishlist(Request $request){
        $products_ids = self::where('shop_id', $request['shop_id'])->get()->pluck('product_id');
        
        return $products_ids;
    }

    
}
