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



    // Relacion muchos a muchos
    public function warehouse() {

        return $this->belongsToMany(Warehouse::class);

    }

}

