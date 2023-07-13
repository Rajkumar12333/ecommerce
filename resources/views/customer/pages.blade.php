<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

      
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <title>Product Page CMS </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!-- Styles -->
        <!-- @livewireStyles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
<script src="{{ mix('js/app.js') }}" defer></script>
        <!-- Scripts -->
        <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
        
    </head>
    <body class="font-sans antialiased">
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
            <div class="col-6">
                <form action="{{url('admin/pages-save')}}" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    @csrf
                    <label for="">Title</label>
                    <input type="text" name="title" value="{{old('title')}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Content</label>
                   
                    <textarea name="editor" id="editor" cols="30" rows="10"></textarea>
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
        <div class="col-6">
        <table class="table table-success table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th>Image</th>
                <!-- <th scope="col">Content</th> -->
              
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($pages as $page)
                <tr>
                <th scope="row">{{$page->id}}</th>

                <td>{{$page->title}}</td>

                <td>
                @if($page->image)
                <img src="{{asset($page->image)}}" alt="" height="100" width="100">
                @endif
               </td>
                <!-- <td>{{$page->editor}}</td> -->
             
                <td>
                    <a href="{{url('admin/pages-edit')}}/{{$page->id}}" class="btn btn-warning">Edit</a>
                    <a href="{{url('admin/pages-delete')}}/{{$page->id}}" class="btn btn-danger">Delete</a>
                    <a 
                        href="javascript:void(0)" 
                        id="show-user" 
                        data-url="{{ route('pages.show', $page->id) }}" 
                        class="btn btn-info"
                        >Show</a>
                </td>
              

                </tr>
                @endforeach
                
            </tbody>
        </table>
        {{$pages->links()}}
        <a class="btn btn-info" href="javascript: history.go(-1)">Go Back</a>
        </div>
       
    </div>
    </div>
    <div class="modal fade" id="userShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Show User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>ID:</strong> <span id="product-id"></span></p>
        <p><strong>Name:</strong> <span id="product-name"></span></p>
        <img id="p_img"src="" width="100px" height="100px" alt="">
        <p><strong>Content:</strong> <span id="product-price"></span></p>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>  
</body>
<script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'editor' );
</script>
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css
" rel="stylesheet">
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script>
        $(document).ready(function () {
       
       /* When click show user */
        $('body').on('click', '#show-user', function () {
          var userURL = $(this).data('url');
         
          $.get(userURL, function (data) { 
              $('#userShowModal').modal('show');
              $('#product-id').text(data.id);
              $('#p_img').attr("src",'http://127.0.0.1:8000/'+data.image)
              $('#product-name').text(data.title);
              $('#product-price').html(data.editor);
          })
       });
       
    });
  
</script>
</html>