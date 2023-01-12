<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->

    <base href="/public">

    @include('admin.css')
  </head>

  <style type="text/css">
  
  label{

    display: inline-block;
    width: 200px;
  }
</style>
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- partial:partials/_sidebar.html -->
     @include('admin.sidebar')
      <!-- partial -->
      
      @include('admin.navbar')

         <!-- partial -->
      <div class="container-fluid page-body-wrapper" align="center" style="padding:100px;">



        
   <div class="container" align="center" style="padding-top:100px;">

            @if(session()->has('success'))    
     <div class="alert alert-success">


    <button type="button" class="close" data-dismiss = "alert">
      x 
    </button>
            {{session()->get('success')}}


     </div>

        @endif


          <form action="{{url('editdoctor',$doctors->id)}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div style="padding:15px;">
        <label>Doctor Name</label>
        <input type="text" style="color:black;" name="name" value = "{{$doctors->name}}" placeholder="Write the name">
      </div>

      <div style="padding:15px;">
        <label>Phone</label>
        <input type="number" style="color:black;" name="number" value="{{$doctors->phone}}" placeholder="Write the number">
      </div>


      <div style="padding:15px;">
        <label>Speciality</label>
        <select name="speciality" style="color: black; width:200px">
          <option>--Select--</option>
          <option value="skin"@if($doctors->speciality == "skin") {{'selected'}} @endif>Skin</option>
          <option value="heart" @if($doctors->speciality == "heart") {{'selected'}} @endif>Heart</option>
          <option value="eye" @if($doctors->speciality == "eye") {{'selected'}} @endif>Eye</option>
          <option value="nose"@if($doctors->speciality == "nose") {{'selected'}} @endif>Nose</option>
        </select>
      </div>



      <div style="padding:15px;">
        <label>Room No</label>
        <input type="text" style="color:black;" name="room" value = "{{$doctors->room}}"placeholder="Write the room number">
      </div>


      <div style="padding:15px;">
        <label>Old Image</label>
       <img height="150" width="150" src="images/{{$doctors->image}}">
      </div>
      <div style="padding:15px;">

        <label>Change Image</label>
        
        <input type="file" name="image">
      </div>

       <div style="padding:15px;">
        
        <input type="submit" class="btn btn-success">
      </div>


    </form>
</div>      
                </div>
       

           <!-- container-scroller -->
    <!-- plugins:js -->
   @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>


