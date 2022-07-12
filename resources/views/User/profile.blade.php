@extends('layouts.user')

@section('content')
<div class="profile-container">
    <div class="student-profile">
        <div class="profile-pic">
            <img src="/studentProfile/{{$profile}}" id="studentProfilePicture">
        </div>
        <div class="student-info">
            <form action="{{url("user/update/". $data[0]->username . "/" . $data[0]->email)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="formContainer"> 
                    <label for="images">{{ __('Upload Picture') }}</label>
                     
                    <div class="formInputContainer">
                        <input id="images" type="file" class="form-control @error('images','updateStudentProfile') is-invalid @enderror" name="images[]" value="{{ old('images') }}" accept="image/*">

                         @error('images', 'updateStudentProfile')
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                         @enderror
                     </div>
                 </div>

                <div class="formContainer"> 
                    <label for="studentnumber" >{{ __('Student Number') }}</label>
                    
                    <div class="formInputContainer">
                        <input id="edit-studentnumber" type="text" class="form-control" name="studentnumber" value="{{$data[0]->studentNumber}}" readonly>
                    </div>
                </div>

                <div class="formContainer"> 
                   <label for="firstname">{{ __('First Name') }}</label>
                    
                   <div class="formInputContainer">
                        <input id="edit-firstname" type="text" class="form-control  @error('firstname', 'updateStudentProfile') is-invalid @enderror" name="firstname" value="{{$data[0]->firstname}}" required autocomplete="firstname" autofocus>
                        @error('firstname', 'updateStudentProfile')
                            <span class="invalid-feedback" role="alert">
                                <strong id="studentUpdate-error-firstname">{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="formContainer"> 
                    <label for="middlename">{{ __('Middle Name') }}</label>
                     
                    <div class="formInputContainer">
                         <input id="edit-middlename" type="text" class="form-control  @error('middlename', 'updateStudentProfile') is-invalid @enderror" name="middlename" value="{{$data[0]->middlename}}"autocomplete="middlename" autofocus>
                            @error('middlename', 'updateStudentProfile')
                                <span class="invalid-feedback" role="alert">
                                    <strong id="studentUpdate-error-middlename">{{$message}}</strong>
                                </span>
                            @enderror
                     </div>
                 </div>

                 <div class="formContainer"> 
                    <label for="lastname">{{ __('Last Name') }}</label>
                     
                    <div class="formInputContainer">
                         <input id="edit-lastname" type="text" class="form-control  @error('lastname', 'updateStudentProfile') is-invalid @enderror" name="lastname" required value="{{$data[0]->lastname}}" autocomplete="lastname" autofocus>
                            @error('lastname', 'updateStudentProfile')
                            <span class="invalid-feedback" role="alert">
                                 <strong id="studentUpdate-error-lastname">{{$message}}</strong>
                             </span>
                             @enderror
                     </div>
                 </div>

                 <div class="formContainer"> 
                    <label for="gender">{{ __('Gender') }}</label>
                     
                    <div class="formInputContainer">
                        <select name="gender" id="edit-gender" class="form-select  @error('gender', 'updateStudentProfile') is-invalid @enderror" required autofocus> 
                            <option hidden value="">Select Gender</option>
                            <option value="male" @if($data[0]->gender == "male") selected @endif>Male</option>
                            <option value="female" @if($data[0]->gender == "female") selected @endif >Female</option>
                        </select>

                            @error('gender', 'updateStudentProfile')
                             <span class="invalid-feedback" role="alert">
                                 <strong id="studentUpdate-error-gender">{{$message}}</strong>
                             </span>
                             @enderror
                     </div>
                 </div>

                 <div class="formContainer"> 
                    <label for="birthdate">{{ __('Birthdate') }}</label>
                     
                    <div class="formInputContainer">
                         <input id="edit-birthdate" type="date" class="form-control  @error('birthdate', 'updateStudentProfile') is-invalid @enderror" name="birthdate" required value="{{$data[0]->birthdate}}" autocomplete="birthdate" autofocus>
                            @error('birthdate', 'updateStudentProfile')
                            <span class="invalid-feedback" role="alert">
                                 <strong id="studentUpdate-error-birthdate">{{$message}}</strong>
                             </span>
                             @enderror
                     </div>
                 </div>

                 <div class="formContainer">
                    <label for="age">{{ __('Age') }}</label>
                   
                    <div class="formInputContainer">
                        <input id="edit-age" type="number" class="form-control  @error('age', 'updateStudentProfile') is-invalid @enderror" name="age" autocomplete="age" value="{{$data[0]->age}}" readonly>
                            @error('age', 'updateStudentProfile')
                            <span class="invalid-feedback" role="alert">
                                <strong id="studentUpdate-error-age">{{$message}}</strong>
                            </span>
                            @enderror
                    </div>
                </div>

                <div class="formContainer">
                    <label for="birthplace">{{ __('Birthplace') }}</label>
                    
                    <div class="formInputContainer">
                        <input id="edit-birthplace" type="text" class="form-control  @error('birthplace', 'updateStudentProfile') is-invalid @enderror" name="birthplace" required value="{{$data[0]->birthplace}}" autocomplete="birthplace" autofocus>
                            @error('birthplace', 'updateStudentProfile')
                            <span class="invalid-feedback" role="alert">
                                <strong id="studentUpdate-error-birthplace">{{$message}}</strong>
                            </span>
                            @enderror
                    </div>
                </div>

                <div class="formContainer">
                    <label for="phone">{{ __('Phone Number') }}</label>

                    <div class="formInputContainer">
                        <div class="phone-register">
                            <p>+63</p>
                            <div>
                                <input id="edit-phone_number" type="text" class="form-control  @error('phone_number', 'updateStudentProfile') is-invalid @enderror" name="phone_number" required value="{{$data[0]->phone_number}}" maxlength="10" autofocus>
                                @error('phone_number', 'updateStudentProfile')
                                <span class="invalid-feedback" role="alert">
                                    <strong id="studentUpdate-error-phone_number">{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="formContainer">
                    <label for="address">{{ __('Address') }}</label>

                    <div class="formInputContainer">
                            <textarea id="edit-address" class="form-control  @error('address', 'updateStudentProfile') is-invalid @enderror" name="address" required autocomplete="address" autofocus>{{$data[0]->address}}</textarea>
                            @error('address', 'updateStudentProfile')
                            <span class="invalid-feedback" role="alert">
                                <strong id="studentUpdate-error-address">{{$message}}</strong>
                            </span>
                            @enderror
                    </div>
                </div>

                <div class="formContainer">
                    <label for="email">{{ __('Email Address') }}</label>

                    <div class="formInputContainer">
                        <input id="edit-email" type="email" class="form-control  @error('email', 'updateStudentProfile') is-invalid @enderror" name="email" value="{{$data[0]->email}}" required autocomplete="email">
                            @error('email', 'updateStudentProfile')
                            <span class="invalid-feedback" role="alert">
                                <strong id="studentUpdate-error-email">{{$message}}</strong>
                            </span>
                            @enderror
                    </div>
                </div>

                <div class="formContainer">
                    <label for="username">{{ __('Username') }}</label>

                    <div class="formInputContainer">
                        <input id="edit-username" type="text" class="form-control  @error('username', 'updateStudentProfile') is-invalid @enderror" name="username" required value="{{$data[0]->username}}" autocomplete="username" minlength="6" autofocus>
                            @error('username', 'updateStudentProfile')
                            <span class="invalid-feedback" role="alert">
                                <strong id="studentUpdate-error-username">{{$message}}</strong>
                            </span>
                            @enderror
                    </div>
                </div>

                <div class="formContainer">
                    <label for="password">{{ __('Password') }}</label>

                    <div class="formInputContainer">
                        <input id="edit-password" type="password" class="form-control  @error('password', 'updateStudentProfile') is-invalid @enderror" name="password" autocomplete="new-password">
                        @error('password', 'updateStudentProfile')
                            <span class="invalid-feedback" role="alert">
                                <strong id="studentUpdate-error-password">{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="formContainer">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>

                    <div class="formInputContainer">
                        <input id="edit-password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                    </div>
                </div>

                <div class="registerBtnContainer">
                    <div class="registerBtnContainer1">
                        <button type="submit" class="btn btn-primary registerBtn" id="studentUpdateBtn">
                            {{ __('Update') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@if(Session::has('success'))
<script>
    swal("Saved", "Student Profile Successfully Updated", "success");
</script>
@endif
@endsection
