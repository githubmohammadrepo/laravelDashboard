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
                <h1 class="m-0 text-dark">Users</h1>
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





            @foreach ($users as $user)

                {{-- show user informations --}}
                <div class="col-sm-6 col-md-6 col-lg-4 ">

                    <div class="card m-auto " style="width: 18rem;">
                        <div class="card-body row">
                            <div class="col-4">
                                <img class="img-circle float-right" width="60px" height="60px" src="{{asset('uploaded/'.($user->image !=null ? $user->image : 'default-avatar.png'))}}" alt="...">
                                <h5 class="text-center" title="{{$user->name}}">&nbsp;{{substr($user->name,0,6)}}</h5>
                            </div>
                            <div class="col">
                                <span class="badge badge-info text-light float-right">{{$user->id}}</span>
                                <ul class="list-group list-group-flush mt-0">
                                    @foreach (\App\Http\Controllers\UserController::roleNmaes($user) as $role)
                                        <li class="list-group-item"><strong>Role {{array_search($role,\App\Http\Controllers\UserController::roleNmaes($user)->toArray())+1}}: </strong>&nbsp;
                                            <span>{{$role}}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <ul class="list-group list-group-flush border-top">
                                <li class="list-group-item"><strong>Email: </strong>&nbsp;{{$user->email}}</li>
                                <li class="list-group-item"><strong>Created At: </strong>&nbsp;{{date('Y-m-d h:m:s', strtotime(Auth::user()->created_at))}}</li>
                            </ul>
                            <div class="card-body text-center my-0 py-2">
                                <a href="#" @click.prevent = "toggleUpdateFormUser" class=" btn btn-info py-1 px-3 text-white">Edit</a>
                            </div>
                        </div>

                    </div>

                </div>
            @endforeach



        </div><!-- /.container-fluid -->

        <hr>
        <div class="row justify-content-center mt-1">
            <div class="col-4 m-auto justify-content-center">
                <p class="text-center m-auto"> {{ $users->onEachSide(1)->links() }}</p>
            </div>
        </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    </div>
@endsection
