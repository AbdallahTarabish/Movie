<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Movie extends Model
{
    protected $table = 'movies';
    protected $guarded = [];
    protected $appends = ['poster_path', 'image_path', 'is_favored'];

    // is_favored
    public function getIsFavoredAttribute($value){

        if(auth()->user()){
            if($this->users()->where('user_id',  auth()->user()->id)->count()){
                return true;
            }
        }

        return false;
    }



    // $movie->poster_path
    public function getPosterPathAttribute($value){
        return Storage::url('images/' . $this->poster);
    }

    // $movie->image_path
    public function getImagePathAttribute($value){
        return Storage::url('images/' . $this->image);
    }


    public function scopeRelatedMovies($query, $search){
        return $query->whereHas("categories", function($q) use($search){
            return $q->whereIn("category_id", $search);
        });
    }

    public function scopeSearchMovie($query, $search){

        return $query->when($search, function($q) use($search) {

             return $q->where("name", "LIKE", "%$search%")
                       ->orWhere("description", "LIKE", "%$search%")
                       ->orWhere("year", "LIKE", "%$search%")
                       ->orWhere("rating", "LIKE", "%$search%");
        });

    }

    public function scopeSearchCategory($query, $search)
    {
        return $query->when($search, function($q) use ($search){

            return $q->whereHas('categories', function($q) use ($search){
                return $q->whereIn('category_id', (array)$search)
                        ->orWhereIn('name', (array) $search);
            });

        });
    }



    public function scopeSearchFavored($query, $search){
        return $query->when($search, function($q){
            return $q->whereHas('users', function($q) {
                return $q->whereIn('user_id', (array) auth()->user()->id);
            });

        });
    }

//    public function getRouteKeyName()
//    {
//        return 'name'; // TODO: Change the autogenerated stub
//    }

    public function categories(){

        return $this->belongsToMany('App\category');
    }

    public function users(){

        return $this->belongsToMany('App\User', 'user_movie');
    }


}
