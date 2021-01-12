<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class Product extends Model

{

    use HasFactory;



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'name', 'price', 'stock', 'shortDesc', 'description'

    ];

    public function Warehouse () {
        return $this->belongsTo(Warehouse::class);
    }
}
