@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="app" v-cloak>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-4">
                    <h1 class="m-0 text-dark">Author</h1>
                </div><!-- /.col -->

                <div class="col-8">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('author.index') }}">Author</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    {{-- display error --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-end mb-3">
        <div class="col-2">
            <nav class="nav  justify-content-center">
                <li class="nav-item  py-0">
                    <a class="nav-link btn py-1 px-3"
                        :class="{'bg-teal':!showAuthorStatus,'bg-danger':showAuthorStatus}"
                        @click.prevent="showFormNewAuthor" href="#" v-text="showAuthorText"></a>
                </li>

            </nav>
        </div>
    </div>
    <div class="container-fluid">
        <transition name="slide-fade">
            <div class="card" v-if="showAuthorStatus">
                <form  :action="authorAction"  method="POST" id="authorForm" enctype="multipart/form-data" class="card-body">
                    <span v-if="Object.keys(authorUpdateData).length>0">
                        @method("PUT")</span>
                    @csrf

                    <div class="row form-group">
                        <div class="col-6">
                            <label for="fullName">Full Name</label>
                            <input type="text" name="fullName" value="{{ old('fullName') }}"
                                class="form-control @error('fullName') is-invalid @enderror" v-model="authorUpdateData.fullName" id="fullName"
                                placeholder="full name ...">
                        </div>
                        <div class="col-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" id="email" v-model="authorUpdateData.email" placeholder="example@gamil.com">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-6">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                class="form-control @error('phone') is-invalid @enderror" id="phone"
                                placeholder="full name ..." v-model="authorUpdateData.phone">
                        </div>
                        <div class="col-6">
                            <label for="website">Website Link</label>
                            <input type="url" name="website" class="form-control @error('website') is-invalid @enderror"
                                value="{{ old('website') }}" id="website" placeholder="https://www." v-model="authorUpdateData.website">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-6">
                            <label for="publisher">Publisher Name</label>
                            <input type="text" name="publisher" value="{{ old('publisher') }}"
                                class="form-control @error('publisher') is-invalid @enderror" id="publisher"
                                placeholder="full name ..." v-model="authorUpdateData.publisher">
                        </div>
                        <div class="col-6">
                            <label for="age">Age</label>
                            <input type="number" name="age" value="{{ old('age') }}"
                                class="form-control @error('age') is-invalid @enderror" id="age" placeholder="" v-model="authorUpdateData.age">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="tel" name="city" value="{{ old('city') }}"
                            class="form-control @error('city') is-invalid @enderror" id="city"
                            placeholder="Authro`s city..." v-model="authorUpdateData.city">
                    </div>


                    <div class="form-group">
                        <label for="about">About Author</label>
                        <textarea name="about" class="form-control @error('about') is-invalid @enderror"
                            id="content" rows="3" v-text="authorUpdateData.about">value="{{ old('about') }}" </textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Upload Image</label>

                        <div class="custom-file">
                            <input type="file" name="image"
                                class="custom-file-input @error('image') is-invalid @enderror"
                                value="{{ old('image') }}" id="image" >
                            <label class="custom-file-label" for="image">Upload Image</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <input type="submit" value="Save Author" class="btn btn-primary px-5">
                        </div>
                    </div>

                </form>
            </div>
        </transition>



        {{-- content for show --}}
        <div class="row justify-content-between" v-if="!showAuthorStatus">

            @foreach ($authors as $author)

                <div class="card p-0 col-6 pr-1 mb-3 row justify-content-start" style="max-width: 540px;">
                    <div class="row no-gutters col-12">
                        <div class="col-md-4">
                            <img src="{{asset($author->image !=null ? 'authors/'.$author->image : 'uploaded/default-avatar.png')}}" class="card-img rounded " alt="...">
                        </div>

                        <div class="col-md-8 ">
                            <div class="card-body">
                                <div class="">
                                    <h5 class="card-title">{{$author->fullName}}</h5>
                                    <a href="{{$author->website}}" class="float-right">wesite</a>
                                </div>
                                <p class="card-text mb-1">email: &nbsp;{{$author->email}}</p>
                                <div class="d-flex">
                                    <p class="card-title mr-auto">age: &nbsp;{{$author->age}}</p>
                                    <p class="card-title ml-auto">city: &nbsp;{{$author->city}}</h5>
                                </div>

                                <div class="d-flex">
                                    <p class="card-title  mr-auto"><small>publisher: &nbsp;{{$author->publisher}}</small></p>
                                    <p class="card-title  ml-auto"><small>phone: &nbsp;{{$author->phone}}</small></h5>
                                </div>

                                <p class="card-text py-0 my-0">
                                    <a href="#" class="btn-link">
                                    </a>
                                </p>
                                <p class="card-text">created: &nbsp;<small class="text-muted">{{($author->created_at)->format('Y-M-D h:m:s')}}</small></p>
                            </div>
                        </div>

                        <div class="card-footer row justify-content-end  ml-auto py-0 my-0">
                            <form action="{{route('author.update',$author->id)}}" method="post" class=" ml-auto d-none updateAuthor" class="ml-auto bg-danger">
                                @csrf
                                @method('PUT')
                                <div class="d-flex">
                                    <input type="text" name="name" value="{{$author->fullName}}" class="form-control" >
                                    <button type="submit" class="btn btn-info text-light btn-sm">
                                        upate
                                    </button>
                                </div>
                            </form>

                            <button type="submit" class="btn ml-auto text-primary" @click.prevent="showUpdateAuthor({{$author->id}})">
                                <i class="far fa-edit pointer" title="edit author"></i>
                            </button>

                            <form action="{{route('author.destroy',$author->id)}}"  method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn text-danger">
                                    <i class="far fa-trash-alt   pointer" title="remove author"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>


              @endforeach


        </div>

        <hr>
        <div class="row justify-content-center mt-1">
            <div class="col-4 m-auto justify-content-center">
                <p class="text-center m-auto"> {{ $authors->onEachSide(1)->links() }}</p>
            </div>
        </div>
    </div>
    {{-- close content Wrapper --}}
    @endsection
