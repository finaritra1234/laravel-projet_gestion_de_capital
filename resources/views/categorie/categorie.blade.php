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
                <input type="text" class="form-control" id="nom_categorie"  name="nom_categorie" style="width: 50%;" />
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
    
    </div>
    <div class="row">
    @foreach($cats as $cat)
    <div class="col-lg-4 col-md-12 col-6 mb-4">
   
        <div class="card">
        <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                    <img src="../assets/img/icons/unicons/cc-primary.png" alt="chart success" class="rounded">
                </div>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                
                    <a class="dropdown-item" href="{{ route('categorie.delete',['id'=>$cat->id])}}" onclick="return confirm('Voulez-vous supprimer?')">Supprimer</a>
                    </div>
                </div>
            </div>
            <span class="fw-semibold d-block mb-1">categorie</span>
            <h3 class="card-title mb-2">{{$cat->nom_categorie}}</h3>
            <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> -->
        </div>
        </div>
       
    </div>
    @endforeach
   
    </div>
</div>
<!-- / Content -->
@endsection