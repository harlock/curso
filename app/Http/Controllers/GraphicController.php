<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Film;
use App\Models\Rental;
use App\Models\User;
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
    public function showGraphic2(){
        /*
         Select  count(r.copy_film_id) quantiy,u.name user
            from rentals r,copy_films fc,users u
            where
             r.copy_film_id=fc.id and
            u.id = r.user_id
            group by u.name
            order by quantiy desc
            limit 5;
        */
        $data=Rental::join('copy_films', 'rentals.copy_film_id','copy_films.id')
            ->join('users','rentals.user_id','users.id' )
            ->select("users.name")
            ->selectRaw("count(rentals.copy_film_id) as quantity")
            ->groupBy("users.name")
            ->orderBy("quantity","desc")
            ->limit(5)
            ->get();

        return  view("graphics.graphic_top_5",compact("data"));
    }
    public function showGraphicComments(){


        /*
        select count(c.id) quantity,f.title from comments c, films f
        where c.film_id=f.id group by f.title;
        */
        $data=Comment::join('films', 'comments.film_id','films.id')
            ->select("films.title")
            ->selectRaw("count(comments.id) as quantity")
            ->groupBy("films.title")
            ->get();
        $data= json_encode($data);
        $data=str_replace('"title":','',$data);
        $data=str_replace('"quantity":','',$data);
        $data=str_replace('{','[',$data);
        $data=str_replace('}',']',$data);
        //return $data;
        return view("graphics.graphic_comments",compact('data'));
    }
    public function showGraphicFinal()
    {
        $data=array();
        $films=Film::orderBy("id","asc")->get();
        $users=User::all();
        $users->map(function ($user)use(&$data,$films){

            $array=array();
            $films->map(function($film) use ($user,&$array){
                $aux=Rental::join('copy_films', 'rentals.copy_film_id','copy_films.id')
                    ->join('films','copy_films.film_id','films.id' )
                    ->where("rentals.user_id",$user->id)
                   ->where("films.id",$film->id)->count();
               array_push($array,$aux);
            });
            array_push($data,array(
                'name'=>$user->name,
                'data'=>$array
            ));
        });
    $data=json_encode($data);
        return view("graphics.graphic_final",compact('data',"films"));
    }
}
