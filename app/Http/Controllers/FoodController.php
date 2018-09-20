<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;
use App\Category;
use Auth;
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
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
         //$foods = Food::all()->where('menucategoryid','=','1');
         $userId = Auth::id();
         //$foods = Food::all()->where('restaurantid','=',$userId);

         $foods= DB::table('menuitem')
         ->join('menucategory', 'menuitem.menucategoryid', '=', 'menucategory.menucategoryid')
         ->select('*')
         ->from('menuitem','menucategory')
         ->where('menucategory.restaurantid','=',$userId)
         ->get();

         $categories = Category::all()->where('restaurantid','=',$userId);
         return view('menu.food',compact('foods','categories'));

    }

    public function catchange($id)
    {
        $userId = Auth::id();
         $foods = Food::all()->where('menucategoryid','=',$id);
         $categories = Category::all()->where('restaurantid','=',$userId);
         return view('menu.food',compact('foods','categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::id();
        $categories = Category::all()->where('restaurantid','=',$userId);
        return view('menu.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FoodRequest $request)
    {
        $userId = Auth::id();
        Food::create($request->all());
        return redirect('/food')->with('message','Food has been succesfully added to the menu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        return view('menu.show',compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userId = Auth::id();
        $food = Food::findOrFail(Crypt::decrypt($id));
        $categories = Category::all()->where('restaurantid','=',$userId);
        return view('menu.edit',compact('food','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FoodRequest $request, $id)
    {

        $food = Food::findOrFail($id);

        $food->itemname = $request->get('itemname');
        $food->itemdescription = $request->get('itemdescription');
        $food->itemprice = $request->get('itemprice');
        $food->menucategoryid = $request->get('menucategoryid');
        $food->save();
        return redirect('/food')->with('message','Item has been updated successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $id)
    {
        $food = Food::findOrFail($id)->first();
        $food->delete();
        return redirect('/food')->with('message','Item has been deleted successfully');
    }

    public function modify()
    {
        return view('menu.edit');
    }
}
