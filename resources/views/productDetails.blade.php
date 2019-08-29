@extends('layouts.customApp')

@section('productDetails')
@foreach($product as $key=>$value)
    <div class="col-md-6 img-thumbnail" style="margin-top:20px;">        
        <img id="image" src="images/{{$value->images}}" style="height:400px;width:400px;" />       
    </div>&nbsp
    <table class="table col-md-5  img-thumbnail" style="margin-top:20px;height:400px;width:400px;background-color:white;">
           <tr>
                <td><h2>Item Details</h2></td>
           </tr>
            <tr>
                <td>Grocery Name</td>
                <td id="groceryName">{{$value->groceryName}}</td>
            </tr>
            <tr>
                <td>Grocery Type</td>
                <td id="groceryType">{{$value->groceryItem}}</td>
            </tr>
            <tr>
                <td>Category</td>
                <td id="category">{{$value->category}}</td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td >{{$value->quantity}}</td>
            </tr>
            <tr>
                <td>Price</td>
                <td id="price">{{$value->price}}</td>
            </tr>
            <tr>
                <td>
                    {{-- <a href="{{ route('login') }}"><button class="btn btn-success" >Add to Cart</button></a> --}}
                    @if (!Auth::guest())
                        Buy&nbsp<input type="number" style="width:50px;" id="quantity" style="border-radius:4px;" onclick="calculate()" onkeyup="calculate()"/>
                </td>
                <td id="tc">Total Cost:0</td>
            </tr>
            <tr>
                <td>
                        <a href="addedToCart?id={{$value->id}}" ><button class="btn btn-success" onclick="Create()">Add to Cart</button></a>
                    @else
                        <a href="{{ route('login') . '?previous=' . Request::fullUrl() }}"><button class="btn btn-success" >Add to Cart</button></a>
                    @endif
                    
                </td>
               
            </tr>

        </table>
        @endforeach
        <div class="col-md-12">
            <h1>Related Items</h1>
        </div>
        @foreach($similarProducts as $key=>$value)
        <div class="img-thumbnail">
            <a href="productDetails?id={{$value->id}}"><img src='images/{{$value->images}}' style="height:200px;width:200px" /></a>
        </div>&nbsp&nbsp
        @endforeach
        <script>
            function calculate(){
                var price = document.getElementById('price').innerHTML;
                var quantity = document.getElementById('quantity').value;
                price=parseInt(price,10);
                
                var total = price*quantity;  

                    document.getElementById('tc').innerHTML ="Total Cost:"+price*quantity;
            }
            var name;
var names=[];
var names2;
var last;
var userTR=document.getElementById("nameTR");

// document.getElementById("form").addEventListener("submit",(e)=>{
//     e.preventDefault();
//     Create();
//     Read();
//     document.getElementById("form").reset();
// });

function Create(){
    
            let storage=JSON.parse(localStorage.getItem("names"));
            var image = document.getElementById('image').src;
            var price = document.getElementById('price').innerHTML;
            var groceryName = document.getElementById('groceryName').innerHTML;
            var category = document.getElementById('category').innerHTML;
            var quantity = document.getElementById('quantity').value;
            price=parseInt(price,10);
            
            var total = price*quantity;                     
        
        if(storage==null){
            names.push(image);
            names.push(groceryName);
            names.push(price);
            names.push(quantity);            
            names.push(total);
            localStorage.setItem("names",JSON.stringify(names));
            
        }else{
            names=JSON.parse(localStorage.getItem("names"));
            names.push(image);
            names.push(groceryName);
            names.push(price);
            names.push(quantity);            
            names.push(total);
            localStorage.setItem("names",JSON.stringify(names));
        }
        
    
}
        </script>
@endsection