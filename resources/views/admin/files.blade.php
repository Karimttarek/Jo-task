@extends('layouts.app')
@section('content')

    @if (session('status'))
        <div class="alert alert-success col-md-6 m-auto p-5" style="background: #dff0d8">
            <p>{{ session('status') }}</p>
        </div>
    @endif
    <div class="justify-content-center p-t-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Upload Files for specific user</div>
                    <div class="form-group col-12" style="background: #dff0d8">
                        Files format must be Within the zip files(zip,rar). Any extension other than that will not be considered with the files.
                      </p>
                  	</div>
                <div class="card-body">
                    <form method="POST" action="{{route('uploadFiles')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-2">
                            <label for="user_id" class="col-form-label text-md-right">User</label>
                            <select id="user_id" class="form-select" name="user_id"  required autofocus >
                                <option value="" disabled>Choose User</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            <label for="user" class="col-form-label text-md-right">File</label>
                            <p></p>
                            <input type="file" name="file" class="@error('filename') is-invalid @enderror" id="file" multiple>
                          	@error('filename')
                            <div>
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<!-- Filepond -->
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script>
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[id="file"]');
    // Create a FilePond instance
    const pond = FilePond.create(inputElement);
    FilePond.setOptions({
        server:{
            url: '/admin/files/store',
            headers:{
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });

$(document).ready(function() {
    $('#user_id').change( function(){
        var id = $(this).val();
        $.ajax({
            url:"{{route('admin.get.id')}}",
            type:'GET',
            data:{
                '_token': "{{csrf_token()}}",
                'id':id
            }
        });
    });
});
</script>
@endsection
