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
                <form action="{{ route('author.store') }}" method="POST" enctype="multipart/form-data"
                    class="card-body">
                    @csrf

                    <div class="row form-group">
                        <div class="col-6">
                            <label for="fullName">Full Name</label>
                            <input type="text" name="fullName" value="{{ old('fullName') }}"
                                class="form-control @error('fullName') is-invalid @enderror" id="fullName"
                                placeholder="full name ...">
                        </div>
                        <div class="col-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" id="email" placeholder="example@gamil.com">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-6">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                class="form-control @error('phone') is-invalid @enderror" id="phone"
                                placeholder="full name ...">
                        </div>
                        <div class="col-6">
                            <label for="website">Website Link</label>
                            <input type="url" name="website" class="form-control @error('website') is-invalid @enderror"
                                value="{{ old('website') }}" id="website" placeholder="https://www.">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-6">
                            <label for="publisher">Publisher Name</label>
                            <input type="text" name="publisher" value="{{ old('publisher') }}"
                                class="form-control @error('publisher') is-invalid @enderror" id="publisher"
                                placeholder="full name ...">
                        </div>
                        <div class="col-6">
                            <label for="age">Age</label>
                            <input type="number" name="age" value="{{ old('age') }}"
                                class="form-control @error('age') is-invalid @enderror" id="age" placeholder="">
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="tel" name="city" value="{{ old('city') }}"
                            class="form-control @error('city') is-invalid @enderror" id="city"
                            placeholder="Authro`s city...">
                    </div>


                    <div class="form-group">
                        <label for="about">About Author</label>
                        <textarea name="about" class="form-control @error('about') is-invalid @enderror" name="content"
                            id="content" rows="3">value="{{ old('content') }}"</textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Upload Image</label>

                        <div class="custom-file">
                            <input type="file" name="image"
                                class="custom-file-input @error('image') is-invalid @enderror"
                                value="{{ old('image') }}" id="image" required>
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
        <div class="card" v-if="!showAuthorStatus">

            <ul class="list-group">
                @foreach($authors as $author)

                    <li class="list-group-item bg-indigo mb-1 d-flex  align-items-center">
                        <span class="float-left badge badge-info text-white badge-pill">{{ $author->id }}</span>
                        <span class="ml-3 float-left">{{ $author->fullName }}</span>

                        <form action="{{ route('author.update',$author->id) }}"
                            method="post" class=" ml-auto d-none updateAuthor" class="ml-auto bg-danger">
                            @csrf
                            @method('PUT')
                            <div class="d-flex">
                                <input type="text" name="fullName" value="{{ $author->fullName }}" class="form-control">
                                <button type="submit" class="btn btn-info text-light btn-sm">
                                    upate
                                </button>
                            </div>
                        </form>

                        <button type="submit" class="btn ml-auto text-light"
                            @click.prevent="showUpdateAuthor($event)">
                            <i class="far fa-edit pointer" title="edit"></i>
                        </button>

                        <form action="{{ route('author.destroy',$author->id) }}"
                            method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn text-light">
                                <i class="far fa-trash-alt   pointer" title="remove"></i>
                            </button>
                        </form>

                        <span class="badge badge-primary badge-pill ">14</span>
                    </li>

                @endforeach


            </ul>



        </div>
    </div>
    {{-- close content Wrapper --}}
    @endsection
