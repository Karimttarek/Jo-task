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
                <div class="card-header">Upload Files</div>
                    <div class="form-group col-12" style="background: #dff0d8">
                        Files format must be Within the zip files(zip,rar). Any extension other than that will not be considered with the files.
                      </p>
                  	</div>
                <div class="card-body">
                    <form method="POST" action="{{route('uploadFiles')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="">
                            <label for="image" class="col-form-label text-md-right">Files</label>
                            
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
            url: '/files/uploadFiles',
            headers:{
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });
</script>    
@endsection