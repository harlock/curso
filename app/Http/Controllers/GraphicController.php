<?php

namespace App\Http\Controllers;
use App\Models\Rental;
use Illuminate\Http\Request;

class GraphicController extends Controller
{

    public function showGraphic1(){

        /*
         Select f.id,count(r.film_copy_id) cantidad_renta,f.title titulo
            from rentals r,film_copies fc,films f
            where  r.film_copy_id=fc.id and
            fc.film_id=f.id group by(f.id)

         * */
        $data=Rental::join('copy_films','rentals.copy_film_id','copy_films.id')
            ->join('films','copy_films.film_id','films.id')
            ->select("films.id","films.title")
            ->selectRaw("count(rentals.copy_film_id) as quantity")
            ->groupBy("films.id","films.title")
            ->get();
        return view("graphics.grafica1",compact('data'));
    }
}
