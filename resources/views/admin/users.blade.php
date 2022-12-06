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
                <a href="{{route('admin.user.create')}}">
                    <button type="button" class="btn btn-outline-primary">Create User</button>
                </a>
             </div>
             <hr>
           </div>
            <form action="{{route('admin.user.destroy')}}" method="GET" id="form">
                <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th scope="col"><input type="checkbox" class="ckeck-all" onclick="checkAll()"></th>
                        <th scope="col">Name</th>
                        <th scope="col">email</th>
                        <th scope="col">Role</th>
                        <th scope="col">options</th>
                      </tr>
                    </thead>
                    <tbody id="render">
                      @foreach ($users as $user)
                        <tr>
                          <td><input type="checkbox" name="item[]" class="item" value="{{$user->id}}"></td>
                          <td>{{$user->name}}</td>
                          <td>{{$user->email}}</td>
                          <td>@if ($user->is_admin == 0) <i class="fa fa-user"></i> @else<i class="fa fa-lock"></i> @endif</td>
                          <td>
                            <a href="#"><i class="fa fa-trash delete"></i></a>
                            <a href="{{url('admin/user/edit/'.$user->id)}}"><i class="fa fa-edit"></i></a>
                            @if (!empty($user->deleted_at))<a href="#"><i class="fa fa-undo undo"></i></a>@endif
                          </td>
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
                    <button type="button" class="btn btn-outline-danger trash">Trash</button>
                    <button type="button" class="btn btn-outline-danger perDelete">Permenetly Delete</button>
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

$(document).on('click' , '.trash' , function (){
    $("#form").attr('action', '/admin/users/trash');
    $('#form').submit();
});

$(document).on('click' , '.undo' , function (){
    var checkedItem = $('input[class="item"]').filter(":checked").length;
    if(checkedItem > 0 ){
        $("#form").attr('action', 'users/undo');
        $('#form').submit();
    }
});


</script>

@endpush

