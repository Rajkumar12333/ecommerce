<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer login</title>
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
        
                <form action="{{url('customer-update')}}" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    @csrf
                    <label for="">Username</label>
                    <input type="hidden" name="id" value="{{$customer->id}}">
                    <input type="text" name="name" value="{{$customer->name}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="text" name="password" value="{{$customer->password}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Mobile No</label>
                    <input type="text" name="phone_no" value="{{$customer->phone_no}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">image</label>
                    <input type="text" name="image" value="{{$customer->image}}" class="form-control">
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