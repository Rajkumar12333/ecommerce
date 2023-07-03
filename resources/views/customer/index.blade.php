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
            <div class="col-3">
                <form action="{{url('customer-save')}}" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    @csrf
                    <label for="">Username</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="text" name="password" value="{{old('password')}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Mobile No</label>
                    <input type="text" name="phone_no" value="{{old('phone_no')}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">image</label>
                    <input type="file" name="image"  class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary">
                </div>
                </form>
        </div>
        <div class="col-9">
        <table class="table table-success table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th>Image</th>
                <th scope="col">Phone No</th>
              
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)
                <tr>
                <th scope="row">{{$customer->id}}</th>

                <td>{{$customer->name}}</td>

                <td>
                @if($customer->image)
                <img src="{{asset($customer->image)}}" alt="" height="100" width="100">
                @endif
               </td>
                <td>{{$customer->phone_no}}</td>
             
                <td>
                    <a href="{{url('customer-edit')}}/{{$customer->id}}" class="btn btn-warning">Edit</a>
                    <a href="{{url('customer-delete')}}/{{$customer->id}}" class="btn btn-danger">Delete</a>
                </td>
              
                
                </tr>
                @endforeach
                
            </tbody>
        </table>
        {{$customers->links()}}
        </div>
    </div>
    </div>
</body>

</html>