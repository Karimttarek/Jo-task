@extends('layouts.app')
@section('content')
<div class="row justify-content-center p-t-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">Create New Post</div>
            @foreach ($user as $u)
            <div class="card-body">
                <form method="POST" action="{{route('admin.user.update' , $u->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                          <label for="name">*Name</label>
                          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$u->name}}">
                             @error('name')
                            <div>
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror
                        </div>
                      </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                          <label for="email">Email</label>
                          <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$u->email}}">
                             @error('email')
                            <div>
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror
                        </div>
                      </div>
                      <hr>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="password">Password</label>
                          <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                             @error('password')
                            <div>
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                               @error('password_confirmation')
                              <div>
                                  <span class="text-danger">{{$message}}</span>
                              </div>
                              @enderror
                          </div>
                      </div>
                    <br>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="checkbox" name="admin" class="item" value="" @checked(old('0', $u->is_admin)) disabled>
                            <label for="admin">Is Admin</label>
                        </div>
                      </div>

                    <div class="form-group  mb-0">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-outline-success">
                                Create
                            </button>
                        </div>
                    </div>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
