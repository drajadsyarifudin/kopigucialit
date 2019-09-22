@extends('master_user')

@section('content')
  <div class="container">    
        @if (session('error'))
            @alert(['type' => 'danger'])
                {!! session('error') !!}
            @endalert
        @endif
     
     
   <div class="col-md-12">
   <h3>User</h3>
   <div class="table-responsive">
    <table class="table">
           <tbody>
           <input type="hidden" name="_method" value="PUT">
             <tr><td>User Id</td><td>:{{ Auth::guard('user')->user()->id }}</td></tr> 
             <tr><td>Email</td><td>: {{ Auth::guard('user')->user()->email }}</td></tr>  
             
             <tr><td>Name</td><td>: {{  Auth::guard('user')->user()->name }}</td></tr>
             <tr><td>Address</td><td>: {{ Auth::guard('user')->user()->address }}</td></tr>
             <tr><td>Phone</td><td>: {{  Auth::guard('user')->user()->phone }}</td></tr>            
            
             <tr><td></td><td>
                <a href="{{url('user/edit', Auth::guard('user')->user()->id )}}" class="btn btn-info btn-sm">
                    <i class="fa fa-edit"></i> Edit
                </a>
             </td></tr>         
           </tbody>
    </table>
   </div>
   </div>
  </div>
  @endsection