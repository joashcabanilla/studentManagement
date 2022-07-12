@extends('layouts.admin')

@section('content')
<div class="admin-content">
    @if(Session::has("error"))
    {{session("error")}}
    @endif
    <div class="admin-container">
        <form action="{{route("updateAdmin")}}" method="POST" enctype="multipart/form-data" id="adminForm">
            @method('PUT')
            @csrf   
            <div class="formContainer"> 
               <label for="name">{{ __('Name') }}</label>
                
               <div class="formInputContainer">
                    <input id="admin-name" type="text" class="form-control @error('name','adminUpdate') is-invalid @enderror" name="name" value="{{$admin->name}}" required autocomplete="name" autofocus>

                    @error('name','adminUpdate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="formContainer"> 
                <label for="email">{{ __('Email Address') }}</label>
                 
                <div class="formInputContainer">
                     <input id="admin-email" type="text" class="form-control @error('email','adminUpdate') is-invalid @enderror" name="email" value="{{$admin->email}}" required autocomplete="email" autofocus>
 
                     @error('email','adminUpdate')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                 </div>
             </div>

             <div class="formContainer"> 
                <label for="username">{{ __('Username') }}</label>
                 
                <div class="formInputContainer">
                     <input id="admin-username" type="text" class="form-control @error('username','adminUpdate') is-invalid @enderror" name="username" value="{{$admin->username}}" required autocomplete="username" autofocus>
 
                     @error('username','adminUpdate')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                 </div>
             </div>

             <div class="formContainer">
                <label for="password">{{ __('Password') }}</label>

                <div class="formInputContainer">
                    <input id="admin-password" type="password" class="form-control @error('password','adminUpdate') is-invalid @enderror" name="password" autocomplete="new-password">
                    
                    @error('password','adminUpdate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="formContainer">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>

                <div class="formInputContainer">
                    <input id="admin-password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                </div>
            </div>

            <div class="registerBtnContainer">
                <div class="registerBtnContainer1">
                    <button type="submit" class="btn btn-primary registerBtn" id="admin-saveBtn">
                        {{ __('Save') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@if(Session::has('success'))
<script>
    swal("Saved", "Admin Account Successfully Updated", "success");
</script>
@endif
@endsection