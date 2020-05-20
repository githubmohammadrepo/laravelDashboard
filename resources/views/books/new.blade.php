@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="app" v-cloak>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">New Book</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('tag.index') }}">Tags</a></li>
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


    <div class="container">
        <div class="card">
            <form class="card-body">
                <div class="form-group">
                    <label for="title">Book Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="title ...">
                </div>

                <div class="form-group">
                    <label for="content">Book Content</label>
                    <textarea name="content" class="form-control" name="content" id="content" rows="3"></textarea>
                </div>


                <div class="form-group">
                    <label for="category">Categry select</label>
                    <select class="form-control" name="category" id="category">
                        @foreach($categories as $category)
                            <option>select category</option>
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tags">Tags select</label>
                    <select multiple class="form-control" name="tags" id="tags">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label for="author">Author select</label>
                    <select class="form-control" id="author" name="author" multiple>
                        @foreach($categories as $category)
                            <option>select category</option>
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Book Price</label>
                    <input type="number" name="price" class="form-control" id="price" placeholder="...$">
                </div>

                <div class="form-group">
                    <label for="image">Choose Image</label>

                    <div class="custom-file">

                        <input type="file" class="custom-file-input" id="image" required>
                        <label class="custom-file-label" for="image">Choose Image...</label>
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="file">Choose File</label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file" required>
                        <label class="custom-file-label" for="file">Choose file...</label>
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>
                </div>


                <div class="form-group">

                    <div class="row justify-content-center">
                        <input type="submit" value="Save Book" class="btn btn-primary px-5">
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- close content Wrapper --}}
    @endsection
