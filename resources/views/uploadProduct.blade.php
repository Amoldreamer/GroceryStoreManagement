@extends('layouts.app')

@section('uploadProduct')
  <style>
      input{
          padding:8px;
          width:300px;
          border-radius:4px;
      }
  </style>
    <form method="POST" action="uploadProductFinal" enctype="multipart/form-data">
        {{csrf_field()}}
        <table class="table table-borderless">            
                <tr>
                    <td><input type="text" name="gName" placeholder="Grocery Name" /></td>
                </tr>
            <tr>
                <td><input type="text" name="gType" placeholder="Grocery Item" /></td>
            </tr>
            <tr>
                <td><input type="text" name="category" placeholder="Category" /></td>
            </tr>
            <tr>
                <td><input type="text" name="quantity" placeholder="Quantity" /></td>
            </tr>
            <tr>
                <td><input type="text" name="price" placeholder="Price" /></td>
            </tr>
            <tr>
                <td><input type="file" name="photo" value="Upload Image" /></td>
            </tr>
            <tr>
                <td><input type="submit" value="submit" /></td>
            </tr>         
        </table>
    </form>
@endsection