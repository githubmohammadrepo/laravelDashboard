@extends('layouts.app')


@section('content')

<div id="app" v-cloak>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">profile</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->


        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">

            <div class="row justify-cotnent-center">

                <div class="col-5 offset-1">

                <transition name="fade">


                    @if ($errors->any())
                    <div class="card">

                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                    @else
                    <div class="card" v-if="visibleUpdateUser">
                    @endif


                        <div class="card-header">
                            <p class="text-center py-0 my-0">{{ __('Update Information') }}</p>
                        </div>

                        <div class="card-body">
                            <form  action="{{ route('profile.update',Auth::id()) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div class="form-group row">
                                    <label for="fname" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="fname" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ==null ? Auth::user()->name : old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ==null ? Auth::user()->email : old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('User Type') }}</label>

                                    <div class="col-md-6">
                                        <select class="custom-select" name="roles[]" multiple>
                                            @foreach($roles as $key => $role)
                                                <option value="{{$role->id}}" {{\App\Http\Controllers\ProfileController::checkIsHasRole($role->name) ? 'selected' : ''}} >{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('roles')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                                    <div class="col-md-6">
                                        <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" value="{{ old('file') }}" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>

                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Update') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </transition>

                </div>




                {{-- show user informations --}}
            <div class="col-5 ">

                <div class="card m-auto" style="width: 18rem;">
                    <img src="{{asset('uploaded/'.(Auth::user()->image !=null ? Auth::user()->image : 'default-avatar.png'))}}" class="card-img-top rounded " alt="...">
                    <div class="card-body">
                        <h5 class="text-center">{{Auth::user()->name}}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Roles: </strong>&nbsp;
                            @foreach (Auth::user()->roles()->pluck('name') as $role)
                                <span>{{$role}}</span>
                            @endforeach
                        </li>
                        <li class="list-group-item"><strong>Email: </strong>&nbsp;{{Auth::user()->email}}</li>
                        <li class="list-group-item"><strong>Created At: </strong>&nbsp;{{date('Y-m-d h:m:s', strtotime(Auth::user()->created_at))}}</li>
                    </ul>
                    <div class="card-body text-center my-0 py-2">
                        <a href="#" @click.prevent = "toggleUpdateFormUser" class=" btn btn-info py-1 px-3 text-white">Edit</a>
                    </div>
                </div>

            </div>

            </div>

        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    </div>
@endsection
