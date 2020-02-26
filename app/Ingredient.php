<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\IngredientTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use SoftDeletes;

    public $transformer = IngredientTransformer::class;

    protected $dates = [ 'deleted_at' ];

    protected $fillable = [
        'name',
        'price'
    ];

    public function pizzaDetails()
    {
        return $this->hasMany(PizzaDetail::class);
    }

    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class, 'pizza_details', 'ingredient_id', 'pizza_id');
    }

    /**
     * Devuelve la cantidad de pizzas donde se ha utilizado este ingrediente
     *
     * @return int
     */
    public function getPizzaCountAttribute()
    {
        return $this->pizzas->count();
    }

    /**
     * Devuelve la lista de ingredientes más utilizados
     *
     * @param QueryBuilder $query
     * @return QueryBuilder
     */
    public function scopePopular($query)
    {
        return $query->whereHas('pizzas')->withCount('pizzas')->orderBy('pizzas_count', 'desc');
    }
}
