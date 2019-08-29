@extends('layouts.customApp')

@section('addedToCart')
    <h1>Items added to cart</h1><span class="badge">{{Session::has('cart')?Session::get('cart')->totalQty:''}}</span>
    <table class="table" id="newtr">
        <tr>
            <td>S. No.</td>
            <td>Image</td> 
            <td>Grocery Name</td>                       
            <td>Cost </td>
            <td>Quantity</td>
            <td>Total</td>
            <td>Action</td>
        </tr>
        
    </table>
    <div id='cart'></div>
    <div class="col-md-12">
            <h1>Related Items</h1>
        </div>
        @foreach($similarProducts as $key=>$value)
        <div class="img-thumbnail">
            <a  href="productDetails?id={{$value->id}}"><img src='images/{{$value->images}}' style="height:200px;width:200px" /></a>
        </div>&nbsp&nbsp
        @endforeach
    <script>
        window.onload = function Read() {
            var newtr = document.getElementById("newtr");
    
    names2=JSON.parse(localStorage.getItem("names"));
    if(names2!=null){
        
        for(var i=0;i<names2.length;i++){

            newtr.innerHTML+= `
           <tr>
            <td></td>
            <td><img src=" ${names2[i++]}" style=height:100px;width:100px /></td>
            <td> ${names2[i++]}</td>            
            <td> ${names2[i++]}</td>
            <td> ${names2[i++]}</td>
            <td> ${names2[i--]}</td>
            <td><button onclick="Update(${i++})">Edit</button></td>
            <td><button onclick="Delete(${i})">Delete</button></td>
            </tr>  
            `
        }
        newtr.innerHTML+= `
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Grand Total</td>
            <td id="grandTotal"></td>
            <td><a href="checkout"><button class="btn btn-primary">Checkout</button></a></td>
        </tr>
       
        `
    }
    var sum=0;
    for(var i = 4;i<=names2.length;i=i+5){
        
        sum+=names2[i];
    }
    document.getElementById('grandTotal').innerHTML=sum;
};

function Update(i3){
    let names4=JSON.parse(localStorage.getItem("names"));
    newtr.innerHTML='';

    for(var i=0;i<names4.length;i++){
        if(i==i3){
            newtr.innerHTML+=`
        <tr>
            <td>S. No.</td>
            <td>Image</td> 
            <td>Grocery Name</td>                       
            <td>Cost </td>
            <td>Quantity</td>
            <td>Total</td>
            <td>Action</td>
        </tr>
        <tr>
            <td></td>
            <td><img src=" ${names4[i-3]}" style=height:100px;width:100px /></td>
            <td> ${names4[i-2]}</td>            
            <td id="price"> ${names4[i-1]}</td>
            <td> ${names4[i]}</td>
            <td> ${names4[++i]}</td>            
        </tr> 
        <tr>
            <td><input id="quantity" onclick="calculate()" onkeyup="calculate()" type="number" placeholder="${names4[i3]}" /></td>
            <td id="total"></td>
            <td><button onclick="Update1(${--i})">Update</button></td>
        </tr>
    `
        }
     
    }
    
}
function calculate(){
    var price = document.getElementById('price').innerHTML;
    var quantity = document.getElementById('quantity').value;
    price=parseInt(price,10);
                
    var total = price*quantity;  

    document.getElementById('total').innerHTML ="Total Cost:"+price*quantity;
}

function Update1(i){
    var names5=JSON.parse(localStorage.getItem('names'));

    names5[i] = document.getElementById('quantity').value;
    var price = document.getElementById('price').innerHTML;
    price=parseInt(price,10);
    names5[i+1]=names5[i]*price;

    localStorage.setItem('names',JSON.stringify(names5));

    var newtr = document.getElementById("newtr");
    
    names2=JSON.parse(localStorage.getItem("names"));
    if(names2!=null){
        newtr.innerHTML=`<tr>
            <td>S. No.</td>
            <td>Image</td> 
            <td>Grocery Name</td>                       
            <td>Cost </td>
            <td>Quantity</td>
            <td>Total</td>
            <td>Action</td>
        </tr>`;
        for(var i=0;i<names2.length;i++){

            newtr.innerHTML+= `
        
           <tr>
            <td></td>
            <td><img src=" ${names2[i++]}" style=height:100px;width:100px /></td>
            <td> ${names2[i++]}</td>            
            <td> ${names2[i++]}</td>
            <td> ${names2[i++]}</td>
            <td> ${names2[i--]}</td>
            <td><button onclick="Update(${i++})">Edit</button></td>
            </tr>  
            `
        }
        newtr.innerHTML+= `
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Grand Total</td>
            <td id="grandTotal"></td>
        </tr>`
        
}
var sum=0;
    for(var i = 4;i<=names2.length;i=i+5){
        
        sum+=names2[i];
    }
    document.getElementById('grandTotal').innerHTML=sum;
}

function Delete(i2){
    let names6=JSON.parse(localStorage.getItem("names"));
    names6.splice(i2-4,1);
    names6.splice(i2-4,1);
    names6.splice(i2-4,1);
    names6.splice(i2-4,1);
    names6.splice(i2-4,1);
    // alert(name6);
    window.localStorage.setItem("names",JSON.stringify(names6));
    location.reload();
}

    </script>
@endsection