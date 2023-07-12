@extends('layouts.page_content')
@section('title')
  Page | Categorie
@endsection
@section('content')
 <!-- Content -->

 <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">CATEGORIE DES DEPENSES</h4>
    @if(Session::has('success'))
    <div class="alert alert-primary alert-dismissible" role="alert">
        {{Session::get('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
   
    @if ($errors->has('nom_categorie'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{$errors->first('nom_categorie')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
        <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Ajouter categorie des depenses</h5>
          
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('add.categorie.submit') }}">
                @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="solde">Nom categorie</label>
                <div class="col-sm-10">
                <input type="text" class="form-control danger" id="nom_categorie"  name="nom_categorie" />
                </div>
            </div>
           
            <div class="row justify-content-end">
                <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">AJOUTER</button>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
    <!-- Basic with Icons -->
    <div class="col-xxl">
        <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Liste des categories des depenses</h5>
            
        </div>
        <div class="card-body">
       
            <div class="d-flex flex-wrap" id="icons-container">
              @foreach($cats as $cat)
              <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
                <div class="card-body">
                <i class="bx bxl-bitcoin mb-2"></i>
                <p class="icon-name text-capitalize text-truncate mb-0">{{$cat->nom_categorie}}</p>
                </div>
              </div>
              @endforeach
               
            </div>
     
        </div>
        </div>
    </div>
    </div>
</div>
<!-- / Content -->
@endsection