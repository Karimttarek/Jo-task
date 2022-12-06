@extends('layouts.app')

@section('content')
{{--<section class="p-5">--}}
       @if (session('status'))
            <div class="form-group col-12 p-1" style="background: #dff0d8">
                <p>{{ session('status') }}</p>
            </div>
        @endif

       <div class="content p-t-5">
           <div class="col-12">
            <div class="m-b-10">
                <a href="{{route('filesUpload')}}">
                    <button type="button" class="btn btn-outline-primary">Upload Files</button>
                </a>
             </div>
             <hr>
             <div class="m-b-12">
                <div class="col-md-4">
                    <label for="filters" class="col-form-label text-md-right">Filters</label>
                    <select id="filters" class="form-select" name="filters">
                        <option value="" disabled selected>Filters</option>
                        <option value="filename asc">Name-Ascending</option>
                        <option value="filename desc">Name-Descending</option>
                        <option value="created_at asc">Date-Newest</option>
                        <option value="created_at desc">Date-Latest</option>
                        <option value="size asc">Size-Higher</option>
                        <option value="size desc">Size-Lower</option>
                    </select>
                </div>
             </div>
           </div>
            <form action="{{route('filesDestroy')}}" method="GET" id="form">
                <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th scope="col"><input type="checkbox" class="ckeck-all" onclick="checkAll()"></th>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">(bytes)</th>
                        <th scope="col">(KB)</th>
                        <th scope="col">options</th>
                      </tr>
                    </thead>
                    <tbody id="render">
                      @foreach ($files as $file)
                        <tr>
                          <td><input type="checkbox" name="item[]" class="item" value="{{$file->id}}"></td>
                          <td>{{explode('\\' , $file->filename)[1]}}</td>
                          <td>{{$file->type}}</td>
                          <td>{{$file->size}}</td>
                          <td>{{$file->size / 1024}}</td>
                          <td><a href="#"><i class="fa fa-trash delete"></i></a></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
               </form>
            </div>
</section>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
               Are you sure to delete this items?
            </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger perDelete"> Delete</button>
                </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    /**
     *
     */
function checkAll() {
    $('input[class="item"]').each(function () {
        if ($('input[class="ckeck-all"]:checked').length == 0) {
            $(this).prop('checked', false);
        } else {
            $(this).prop('checked', true);
        }
    });
}
    /**
     *
     */
$(document).on('click' , '.delete' , function (){
    var checkedItem = $('input[class="item"]').filter(":checked").length;
    $(this).prop('checked' , true);
    if (checkedItem > 0){
        $('.modal-body').text('Are you sure you want to permanently delete this '+checkedItem +' records ?');
        $('.modal-footer').show();
    }else{
        $('.modal-body').text('No records found');
        $('.modal-footer').hide();
    }
    $('#exampleModal').modal('show');
});

/*
* Permenant delete
*/
$(document).on('click' , '.perDelete' , function (){
    $('#form').submit();
});

/*
* Filters
*/
$(document).ready(function() {
    $('#filters').change( function(){
        var attr = $(this).val();
        $.ajax({
            url:"{{route('fileFilters')}}",
            type:'GET',
            data:{
                '_token': "{{csrf_token()}}",
                'attr':attr
            },
            success:function(data){
                $('#render').html(data);
            },
            error:function(data){
                $('#render').html('Error while rendering!')
            }
        });
    });
});

</script>

@endpush

