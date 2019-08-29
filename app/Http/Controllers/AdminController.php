<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Cart;
use App\Product;
use Auth;

class AdminController extends Controller
{
    public function uploadProduct(){
        return view('uploadProduct');
    }

    public function uploadProductFinal(Request $request){
        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $file->move('images/',$fileName);
        }
        DB::table('products')->insert(['groceryName'=>$request->gName,'groceryItem'=>$request->gType,
        'category'=>$request->category,'quantity'=>$request->quantity,'price'=>$request->price,'images'=>$fileName]);

        $products = DB::table('products')->get();

        return view('welcome',compact('products'));
    }

    public function productDetails(Request $request){
        $product = DB::table('products')->where(['id'=>$request->id])->get();
        foreach($product as $key=>$value){
            $similarProducts = DB::table('products')
            ->whereNotIn('id',[$request->id])
            ->where(['category'=>$value->category])->get();
        }
        
        return view('productDetails',compact('product','similarProducts'));
    }

    public function welcome()
    {
        $products = DB::table('products')->get();

        if(Auth::guest()){
            return view('welcome',compact('products'));
        }else{
            return redirect('customer');
        }
    }

    public function addedToCart(Request $request){
        $product = DB::table('products')->where(['id'=>$request->id])->get();

        
        
        $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
 
        if(!$pageWasRefreshed ) {
            $goods = Product::find($request->id);
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->add($goods, $request->id);
    
            foreach($cart as $key=>$value){
                $value->price;
            }
            // $request->session()->flush('cart');
            // $request->session()->put('cart',$cart);//here I think
            // dd($request->session()->get('cart'));
            // return redirect()->route('product.index');
        }else{
        // $request->session()->forget('cart');
        // $cart = Session::get('cart'); // Get the array
        
        foreach($cart as $key=>$value){
            $value->price;
        }
        // $l = $cart->count();
        // $goods = Product::find($request->id);
        // $cart->unset($cart[$l-1]); // Unset the index you want
        // $oldCart = Session::has('cart') ? Session::get('cart') : null;
        //     $cart = new Cart($oldCart);
        // $cart->remove($request->id);
        // Session::set('cart', $cart);
        // Session::forget('cart.' . 0);
        
        }
        foreach($product as $key=>$value){
            $similarProducts = DB::table('products')
            ->whereNotIn('id',[$request->id])
            ->where(['category'=>$value->category])->get();
        }
        if($request->session()->get('cart')==null){
            return redirect('customer');
        }else{
        return view('addedToCart',compact('product','similarProducts'));
        }
    }
}
