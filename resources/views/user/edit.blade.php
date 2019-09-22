@extends('master_user')

@section('content')
  <div class="container">    
        @if (session('error'))
            @alert(['type' => 'danger'])
                {!! session('error') !!}
            @endalert
        @endif
        <div class="col-md-12">
            <h3>Users</h3>
            <form role="form" action="{{ url('user/update', $cust->id) }}" method="POST">
            {!! csrf_field() !!}
                <div class="form-group">
                    <label for="">Customer ID</label>
                    <input type="text" name="cust_id" required maxlength="20" readonly 
                        value="{{ $cust->id}}" 
                        class="form control {{ $errors->has('cust_id') ? 'is-invalid':'' }}">
                    <p class="text-danger">{{ $errors->first('cust_id') }}</p>    
                </div>       
               
                <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" required maxlength="50" 
                            value="{{ $cust->name}}" 
                            class="form control {{ $errors->has('name') ? 'is-invalid':'' }}">
                        <p class="text-danger">{{ $errors->first('name') }}</p>    
                </div> 
                
                <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" name="address" required maxlength="50" 
                            value="{{ $cust->address}}" 
                            class="form control {{ $errors->has('address') ? 'is-invalid':'' }}">
                        <p class="text-danger">{{ $errors->first('address') }}</p>    
                </div>     

                <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" name="phone" required maxlength="50" 
                            value="{{ $cust->phone}}" 
                            class="form control {{ $errors->has('phone') ? 'is-invalid':'' }}">
                        <p class="text-danger">{{ $errors->first('phone') }}</p>    
                </div>     
                
                <div class="form-group">
                        <button class="btn btn-info btn-sm">
                            <i class="fa fa-refresh"></i> Update
                        </button>
                    </div>
            </form>
        </div>
    </div>
@endsection    