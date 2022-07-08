@extends('layouts.admin')

@section('content')
<div class="announce-content">
    <div class="add-announce-container">
            <button type="button" class="btn btn-success addBtn"  data-bs-toggle="modal" data-bs-target="#announcementModal">Add Announcement</button>
    </div>
    <div class="containerTable">
        <div class="table-container">
            <table class="table-striped table" id="announcementTable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collection as $data)
                        <tr>
                            <td>{{$data['id']}}</td>
                            <td>{{$data['title']}}</td>
                            <td>{{$data['content']}}</td>
                            <td class="action-td">
                                <button class="btn btn-success" id="editbtn_{{$data['id']}}"><span id="editbtn_{{$data['id']}}" class="material-symbols-rounded">edit</span></button>
                                <button class="btn btn-danger" id="deletebtn_{{$data['id']}}"><span id="deletebtn_{{$data['id']}}" class="material-symbols-rounded">delete</span></button>
                            </td>   
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Create New Announcement</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body announcementForm">
                {{-- create announcement form --}}
                <form action="{{route('createAnnouncement')}}" method="POST" enctype="multipart/form-data">
                    @csrf   
                    <div class="formContainer"> 
                       <label for="title">{{ __('Title') }}</label>
                        
                       <div class="formInputContainer">
                            <input id="title" type="text" class="form-control @error('title','announcementCreate') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                            @error('title','announcementCreate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="formContainer">
                        <label for="content">{{ __('Content') }}</label>

                        <div class="formInputContainer">
                                <textarea id="content" class="form-control @error('content','announcementCreate') is-invalid @enderror" name="content" required autocomplete="content" autofocus>{{ old('content') }}</textarea>

                            @error('content','announcementCreate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="formContainer"> 
                        <label for="images">{{ __('Upload Images') }}</label>
                         
                        <div class="formInputContainer">
                             <input id="images" type="file" class="form-control @error('images','announcementCreate') is-invalid @enderror" name="images[]" value="{{ old('images') }}" multiple accept="image/*">
 
                             @error('images','announcementCreate')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>
                     </div>
                    
                    <div class="registerBtnContainer">
                        <div class="registerBtnContainer1">
                            <button type="submit" class="btn btn-primary registerBtn" id="saveBtn">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="announcementEditModal" tabindex="-1" aria-labelledby="announcementEditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Update Announcement</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body announcementForm">
                {{-- update announcement form --}}
                <form method="POST" enctype="multipart/form-data" id="announcementEditForm">
                    @csrf   
                    @method('PUT')
                    <div class="formContainer"> 
                       <label for="title">{{ __('Title') }}</label>
                        
                       <div class="formInputContainer">
                            <input id="editTitle" type="text" class="form-control" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                        </div>
                    </div>

                    <div class="formContainer">
                        <label for="content">{{ __('Content') }}</label>

                        <div class="formInputContainer">
                                <textarea id="editContent" class="form-control" name="content" required autocomplete="content" autofocus>{{ old('content') }}</textarea>
                        </div>
                    </div>

                    <div class="formContainer"> 
                        <label for="images" id="announcementUploadImage-label">{{ __('Update Images') }}</label>
                         
                        <div class="formInputContainer">
                             <input id="editImages" type="file" class="form-control" name="images[]" value="{{ old('images') }}" multiple accept="image/*">
                         </div>
                     </div>

                    <div class="updateAnnouncementImages-container">
                    </div>

                    <div class="registerBtnContainer">
                        <div class="registerBtnContainer1">
                            <button type="submit" class="btn btn-primary registerBtn" id="updateBtn">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </form>

            </div>
          </div>
        </div>
    </div>
</div>

@if($errors->announcementCreate->any())
<script>
    $(".addBtn").click();
</script>
@endif

@if($errors->announcementUpdate->any())
<script>
        swal("Update Error", "Announcement Update Error", "error");
</script>
@endif

@if(Session::has('success'))
<script>
    swal("Saved", "Announcement Successfully Saved", "success");
</script>
@endif

@if(Session::has('deleted'))
<script>
    swal("Saved", "Announcement Successfully deleted", "success");
</script>
@endif

<script src="/js/admin/announcement.js"></script> 
@endsection