@extends('layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="app" v-cloak>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    {{-- display error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="row justify-content-end card-body">
        <transition name="slide-fade">
            <form v-if="!showCategory" action="{{route('category.store')}}" method="POST" class="col-8">
                @csrf
                <div class="row justify-content-center">
                <div class="col-md-10 col-sm-12 d-flex">
                    <input type="text" class="form-control" name="name" placeholder="Category Name ...">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="submit" value="save" class="btn btn-primary px-4">
                </div>
                </div>
            </form>
        </transition>
        <button class="btn col-2" :class="{'btn-success':showCategory,'btn-danger':!showCategory}" @click.prevent="showSubmitCategory"  v-text="categoryText"></button>


    </div>




    <ul class="list-group">
        @foreach ($categories as $category)

            <li class="list-group-item bg-indigo mb-1 d-flex  align-items-center">
                <span class="float-left badge badge-info text-white badge-pill">{{$category->id}}</span>
                <span class="ml-3 float-left">{{$category->name}}</span>

                <form action="{{route('category.update',$category->id)}}" method="post" class=" ml-auto d-none updateCategory" class="ml-auto bg-danger">
                    @csrf
                    @method('PUT')
                    <div class="d-flex">
                        <input type="text" name="name" value="{{$category->name}}" class="form-control" >
                        <button type="submit" class="btn btn-info text-light btn-sm">
                            upate
                        </button>
                    </div>
                </form>

                <button type="submit" class="btn ml-auto text-light" @click.prevent="showUpdateCategory($event)">
                    <i class="far fa-edit pointer" title="edit"></i>
                </button>

                <form action="{{route('category.destroy',$category->id)}}"  method="post">
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


      <hr>
      <div class="row justify-content-center mt-1">
          <div class="col-4 m-auto justify-content-center">
              <p class="text-center m-auto"> {{ $categories->onEachSide(1)->links() }}</p>
          </div>
      </div>
    </div>
    {{-- close content Wrapper --}}
@endsection
