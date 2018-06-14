<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;
use DB, Session, Crypt, Hash;
use Illuminate\Support\Facades\Input;

use App\Http\Requests\FoodRequest;
class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //12-06
        /*
        $foods = DB::table('menuitem')
            ->join('menucategory', 'menucategory.menucategoryid', '=', 'menuitem.menucategoryid')
            ->select('menuitem.itemname', 'menucategory.name', 'menuitem.itemprice')
            ->get();
        
        return view('menu.food', ['foods'=>$foods]);
        */
        
         $foods = Food::all();
         return view('menu.food',compact('foods'));
         

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FoodRequest $request)
    {
        Food::create($request->all());
        return redirect('/food')->with('message','Item has been added succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
