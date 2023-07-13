<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('message'))

<div class="alert alert-{{Session::get('color')}} alert-dismissible fade show" role="alert">
{{Session::get('message')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
    <div class="container">
        <div class="row">
        
                <form action="{{url('user/products-update')}}" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    @csrf
                    <label for="">Product</label>
                    <input type="hidden" name="id" value="{{$products->id}}">
                    <input type="text" name="product" value="{{$products->product}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Price</label>
                    <input type="text" name="price" value="{{$products->price}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">image</label>
                    <input type="file" name="image"  class="form-control">
                    <img src="{{asset($products->image)}}" alt="" height="100" width="100">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary">
                </div>
                </form>
        </div>
       
    </div>
    </div>
</body>
</html>