<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Order;
use DB;
use Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {       
         return view('checkout');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->clicked){
            DB::table('baddress')->insert(["First_Name"=>$request->firstName,"Last_Name"=>$request->lastName,"Email"=>$request->email,
            "Address"=>$request->address,"Address2"=>$request->address2,"Country"=>$request->country,"State"=>$request->state,"Zip"=>$request->zip]);
        }else{
            DB::table('baddress')->insert(["First_Name"=>$request->firstName,"Last_Name"=>$request->lastName,"Email"=>$request->email,
            "Address"=>$request->address,"Address2"=>$request->address2,"Country"=>$request->country,"State"=>$request->state,"Zip"=>$request->zip]);
            DB::table('saddress')->insert(["First_Name"=>$request->firstName,"Last_Name"=>$request->lastName,"Email"=>$request->email,
            "Address"=>$request->address,"Address2"=>$request->address2,"Country"=>$request->country,"State"=>$request->state,"Zip"=>$request->zip]);
            }
        
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
