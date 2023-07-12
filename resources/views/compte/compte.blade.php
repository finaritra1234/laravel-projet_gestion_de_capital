@extends('layouts.page_content')
@section('title')
  Page | Categorie
@endsection
@section('content')
 <!-- Content -->

 <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"> SOLDE DU COMPTE</h4>
    @if(Session::has('success'))
    <div class="alert alert-primary alert-dismissible" role="alert">
        {{Session::get('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{Session::get('error')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if ($errors->has('solde'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{$errors->first('solde')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
        <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Ajouter le montant du solde</h5>
          
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('add.compte.submit') }}">
                @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="solde">Montant</label>
                <div class="col-sm-10">
                <input type="number" class="form-control danger" id="solde"  name="solde" />
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
            <h5 class="mb-0">Liste</h5>
            <small class="text-muted float-end">Ariary</small>
        </div>
        <div class="card-body">
        @foreach ($soldes as $solde)
            <?php
                $s = $solde->solde ;
                $n=  str_replace(',',' ', number_format($s,3));
                $a = strstr($n, '.');
                $montant= str_replace($a,'',$n);
                
            ?>
            <h5 class="mb-0">solde</h5>
            <small class="text-muted float-end">{{  $montant }}USD</small>
        @endforeach    
        </div>
        </div>
    </div>
    </div>
</div>
<!-- / Content -->
@endsection