<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class Warehouse extends Model

{

    use HasFactory;



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'name', 'location'
    ];

  // Relacion muchos a muchos
  public function products() {

    return $this->belongsToMany(Product::class);

}

}
