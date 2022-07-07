@extends('layouts.admin')

@section('content')
<div class="student-content">
    <div class="add-user-container">
        <div>
            <button type="button" class="btn btn-success addStudentBtn" data-bs-toggle="modal" data-bs-target="#studentModal">Add New Student</button>
        </div>
        <div class="student-importExport">
            <a href="student/import" class="btn btn-primary">Import Data</a>
            <a href="student/exportExcel" class="btn btn-primary">Export Excel</a>
            <a href="student/exportCSV" class="btn btn-primary">Export CSV</a>
            <a href="student/exportPDF" class="btn btn-primary">Export PDF</a>
        </div>
    </div>
    <div class="containerTable">
            <div class="table-container">
                <table class="table-striped table userTable">
                    <thead>
                        <tr>
                            <th>Student No</th>
                            <th>Name</th>
                            <th>Birthday</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($collection as $item)
                            @php
                                $lastname = strtoupper($item['lastname']);
                                $firstname = strtoupper($item['firstname']);
                                $middlename = substr(strtoupper($item['middlename']),0,1);
                                $birthdate = substr($item['birthdate'],5,2) . "/" . substr($item['birthdate'],8,2) . "/" . substr($item['birthdate'],0,4);
                            @endphp
                            <tr>
                                <td>{{$item['studentNumber']}}</td>
                                <td>{{$lastname}}, {{$firstname}} {{$middlename}}.</td>
                                <td>{{$birthdate}}</td>
                                <td>{{$item['age']}}</td>
                                <td>{{$item['gender']}}</td>
                                <td>{{$item['email']}}</td>
                                <td>{{$item['phone_number']}}</td>
                                <td class="action-td">
                                    <button class="btn btn-success" id="editbtn_{{$item['username']}}"><span id="editbtn_{{$item['username']}}" class="material-symbols-rounded">edit</span></button>
                                    <button class="btn btn-danger" id="deletebtn_{{$item['username']}}"><span id="deletebtn_{{$item['username']}}" class="material-symbols-rounded">delete</span></button>
                                </td>   
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>

      <!-- Create Student Modal -->
      <div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="studentModalLabel"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body studentForm">
                {{-- create student form --}}
                <form action="{{route('createStudent')}}" method="POST">
                    @csrf
                    <div class="formContainer"> 
                        <label for="studentnumber" >{{ __('Student Number') }}</label>
                        
                        <div class="formInputContainer">
                            <input id="studentnumber" type="text" class="form-control" name="studentnumber" value="{{$studentNumber}}" readonly>
                        </div>
                    </div>

                    <div class="formContainer"> 
                       <label for="firstname">{{ __('First Name') }}</label>
                        
                       <div class="formInputContainer">
                            <input id="firstname" type="text" class="form-control @error('firstname','studentCreate') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                            @error('firstname','studentCreate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="formContainer"> 
                        <label for="middlename">{{ __('Middle Name') }}</label>
                         
                        <div class="formInputContainer">
                             <input id="middlename" type="text" class="form-control @error('middlename','studentCreate') is-invalid @enderror" name="middlename" value="{{ old('middlename') }}" autocomplete="middlename" autofocus>
 
                             @error('middlename','studentCreate')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>
                     </div>

                     <div class="formContainer"> 
                        <label for="lastname">{{ __('Last Name') }}</label>
                         
                        <div class="formInputContainer">
                             <input id="lastname" type="text" class="form-control @error('lastname','studentCreate') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
 
                             @error('lastname','studentCreate')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>
                     </div>

                     <div class="formContainer"> 
                        <label for="gender">{{ __('Gender') }}</label>
                         
                        <div class="formInputContainer">
                            <select name="gender" id="gender" class="form-select @error('gender','studentCreate') is-invalid @enderror" required autofocus> 
                                <option hidden value="">Select Gender</option>
                                <option value="male" @if(old('gender') == "male"){{"selected"}} @endif>Male</option>
                                <option value="female" @if(old('gender') == "female"){{"selected"}} @endif>Female</option>
                            </select>
 
                             @error('gender','studentCreate')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>
                     </div>

                     <div class="formContainer"> 
                        <label for="birthdate">{{ __('Birthdate') }}</label>
                         
                        <div class="formInputContainer">
                             <input id="birthdate" type="date" class="form-control @error('birthdate','studentCreate') is-invalid @enderror" name="birthdate" value="{{ old('birthdate') }}" required autocomplete="birthdate" autofocus>
 
                             @error('birthdate','studentCreate')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>
                     </div>

                     <div class="formContainer">
                        <label for="age">{{ __('Age') }}</label>
                       
                        <div class="formInputContainer">
                            <input id="age" type="number" class="form-control @error('age','studentCreate') is-invalid @enderror" name="age" value="{{ old('age') }}" autocomplete="age" readonly>

                            @error('age','studentCreate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="formContainer">
                        <label for="birthplace">{{ __('Birthplace') }}</label>
                        
                        <div class="formInputContainer">
                            <input id="birthplace" type="text" class="form-control @error('birthplace','studentCreate') is-invalid @enderror" name="birthplace" value="{{ old('birthplace') }}" required autocomplete="birthplace" autofocus>

                            @error('birthplace','studentCreate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
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
                                    <input id="phone_number" type="text" class="form-control @error('phone_number','studentCreate') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" maxlength="10" autofocus>
                                    
                                    @error('phone_number','studentCreate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="formContainer">
                        <label for="address">{{ __('Address') }}</label>

                        <div class="formInputContainer">
                                <textarea id="address" class="form-control @error('address','studentCreate') is-invalid @enderror" name="address" required autocomplete="address" autofocus>{{ old('address') }}</textarea>

                            @error('address','studentCreate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="formContainer">
                        <label for="email">{{ __('Email Address') }}</label>

                        <div class="formInputContainer">
                            <input id="email" type="email" class="form-control @error('email','studentCreate') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email','studentCreate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="formContainer">
                        <label for="username">{{ __('Username') }}</label>

                        <div class="formInputContainer">
                            <input id="username" type="text" class="form-control @error('username','studentCreate') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" minlength="6" autofocus>

                            @error('username','studentCreate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="formContainer">
                        <label for="password">{{ __('Password') }}</label>

                        <div class="formInputContainer">
                            <input id="password" type="password" class="form-control @error('password','studentCreate') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password','studentCreate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="formContainer">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>

                        <div class="formInputContainer">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="registerBtnContainer">
                        <div class="registerBtnContainer1">
                            <button type="submit" class="btn btn-primary registerBtn">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>

      {{-- Edit Student Modal --}}
      <div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="studentEditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="studentEditModalLabel"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body studentForm">
                {{-- update student form --}}
                <form method="POST">
                    @method('PUT')
                    @csrf
                    <div class="formContainer"> 
                        <label for="studentnumber" >{{ __('Student Number') }}</label>
                        
                        <div class="formInputContainer">
                            <input id="edit-studentnumber" type="text" class="form-control" name="studentnumber" readonly>
                        </div>
                    </div>

                    <div class="formContainer"> 
                       <label for="firstname">{{ __('First Name') }}</label>
                        
                       <div class="formInputContainer">
                            <input id="edit-firstname" type="text" class="form-control" name="firstname" required autocomplete="firstname" autofocus>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="studentUpdate-error-firstname"></strong>
                                </span>
                        </div>
                    </div>

                    <div class="formContainer"> 
                        <label for="middlename">{{ __('Middle Name') }}</label>
                         
                        <div class="formInputContainer">
                             <input id="edit-middlename" type="text" class="form-control" name="middlename" autocomplete="middlename" autofocus>
                                 <span class="invalid-feedback" role="alert">
                                     <strong id="studentUpdate-error-middlename"></strong>
                                 </span>
                         </div>
                     </div>

                     <div class="formContainer"> 
                        <label for="lastname">{{ __('Last Name') }}</label>
                         
                        <div class="formInputContainer">
                             <input id="edit-lastname" type="text" class="form-control" name="lastname" required autocomplete="lastname" autofocus>
                                 <span class="invalid-feedback" role="alert">
                                     <strong id="studentUpdate-error-lastname"></strong>
                                 </span>
                         </div>
                     </div>

                     <div class="formContainer"> 
                        <label for="gender">{{ __('Gender') }}</label>
                         
                        <div class="formInputContainer">
                            <select name="gender" id="edit-gender" class="form-select" required autofocus> 
                                <option hidden value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                                 <span class="invalid-feedback" role="alert">
                                     <strong id="studentUpdate-error-gender"></strong>
                                 </span>
                         </div>
                     </div>

                     <div class="formContainer"> 
                        <label for="birthdate">{{ __('Birthdate') }}</label>
                         
                        <div class="formInputContainer">
                             <input id="edit-birthdate" type="date" class="form-control" name="birthdate" required autocomplete="birthdate" autofocus>
                                 <span class="invalid-feedback" role="alert">
                                     <strong id="studentUpdate-error-birthdate"></strong>
                                 </span>
                         </div>
                     </div>

                     <div class="formContainer">
                        <label for="age">{{ __('Age') }}</label>
                       
                        <div class="formInputContainer">
                            <input id="edit-age" type="number" class="form-control" name="age" autocomplete="age" readonly>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="studentUpdate-error-age"></strong>
                                </span>
                        </div>
                    </div>

                    <div class="formContainer">
                        <label for="birthplace">{{ __('Birthplace') }}</label>
                        
                        <div class="formInputContainer">
                            <input id="edit-birthplace" type="text" class="form-control" name="birthplace" required autocomplete="birthplace" autofocus>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="studentUpdate-error-birthplace"></strong>
                                </span>
                        </div>
                    </div>

                    <div class="formContainer">
                        <label for="phone">{{ __('Phone Number') }}</label>

                        <div class="formInputContainer">
                            <div class="phone-register">
                                <p>+63</p>
                                <div>
                                    <input id="edit-phone_number" type="text" class="form-control" name="phone_number" required autocomplete="phone_number" maxlength="10" autofocus>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="studentUpdate-error-phone_number"></strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="formContainer">
                        <label for="address">{{ __('Address') }}</label>

                        <div class="formInputContainer">
                                <textarea id="edit-address" class="form-control" name="address" required autocomplete="address" autofocus></textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="studentUpdate-error-address"></strong>
                                </span>
                        </div>
                    </div>

                    <div class="formContainer">
                        <label for="email">{{ __('Email Address') }}</label>

                        <div class="formInputContainer">
                            <input id="edit-email" type="email" class="form-control" name="email" required autocomplete="email">
                                <span class="invalid-feedback" role="alert">
                                    <strong id="studentUpdate-error-email"></strong>
                                </span>
                        </div>
                    </div>

                    <div class="formContainer">
                        <label for="username">{{ __('Username') }}</label>

                        <div class="formInputContainer">
                            <input id="edit-username" type="text" class="form-control" name="username" required autocomplete="username" minlength="6" autofocus>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="studentUpdate-error-username"></strong>
                                </span>
                        </div>
                    </div>

                    <div class="formContainer">
                        <label for="password">{{ __('Password') }}</label>

                        <div class="formInputContainer">
                            <input id="edit-password" type="password" class="form-control" name="password" autocomplete="new-password">
                                <span class="invalid-feedback" role="alert">
                                    <strong id="studentUpdate-error-password"></strong>
                                </span>
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
      </div>

      @if($errors->studentCreate->any())
        <script>
            $(".addStudentBtn").click();
            $("#studentModalLabel").text("Create Student Account");
        </script>
      @endif
      
      @if(Session::has('success'))
        <script>
            swal("Saved", "Student Account Successfully Saved", "success");
        </script>
      @endif
        <script src="/js/admin/table.js"></script>
</div>
@endsection 