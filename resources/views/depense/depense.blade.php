@extends('layouts.page_content')
@section('title')
  Page | Depense
@endsection
@section('content')
 <!-- Content -->

 <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">GERER VOTRE DEPENSES</h4>
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
   
   
    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
        <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Ajouter categorie des depenses</h5>
          
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('add.depense.submit') }}">
                @csrf

            <div class="row mb-3">
                <input type="text " name="compte_id" value="{{$compte_id}}" style="display:none;">
                <label class="col-sm-2 col-form-label" for="depense">Depense</label>
                <div class="col-sm-10">
                <select  class="form-control" id="categorie_id"  name="categorie_id" >
                    <option value="">Selectionner le depense</option>
                    @foreach($cats as $cat)
                    <option value="{{$cat->id}}">{{$cat->nom_categorie}}</option>
                    @endforeach
                </select>
                @if ($errors->has('categorie_id'))
                <span class="help-block">
                    <strong style="color:red">{{ $errors->first('categorie_id') }}</strong>
                </span>
                @endif

              
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="montant_depense">Montant</label>
                <div class="col-sm-10">
                <input type="number" class="form-control" id="montant_depense"  name="montant_depense" />
                @if ($errors->has('montant_depense'))
                <span class="help-block">
                    <strong style="color:red">{{ $errors->first('montant_depense') }}</strong>
                </span>
                @endif
                </div>
               
              
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="date_depense">Date</label>
                <div class="col-sm-10">
                <input type="date" value="{{$now}}" class="form-control" id="date_depense"  name="date_depense" />
                @if ($errors->has('date_depense'))
                <span class="help-block">
                    <strong style="color:red">{{ $errors->first('date_depense') }}</strong>
                </span>
                @endif
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
    <!-- Basic with Icons -->
    <div class="row">
        <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Liste des  depenses</h5>
                    
                </div>
        
                <div class="demo-inline-spacing mx-4" >
                    <a href="{{ route('depense')}}" class="btn btn-primary">Tout</a> 
                  
                   
                    <button class="btn btn-primary">Un mois</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uneDate">Une date</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#entreDate">Date entre</button>
                    
                </div>
                <!-- Modal -->
                <div class="modal fade" id="uneDate" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <form action="{{ route('depense.date')}}">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Choisir date</h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                        </div>
                        <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Date</label>
                            <input
                                type="date"
                                id="nameWithTitle"
                                class="form-control"
                                placeholder="Enter date"
                                name="date"
                            />
                            </div>
                        </div>
                    
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Fermer
                        </button>
                        <button type="submit" class="btn btn-primary">Valider</button>
                        </div>
                    </div>
                
                    </div>
                    </form>
                </div>
                <div class="modal fade" id="entreDate" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <form action="{{ route('depense.date_entre')}}">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Choisir date</h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                        </div>
                        <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Date1</label>
                            <input
                                type="date"
                                id="nameWithTitle"
                                class="form-control"
                            
                                name="date_one"
                            />
                            </div>
                            <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Date2</label>
                            <input
                                type="date"
                                id="nameWithTitle"
                                class="form-control"
                                placeholder="Enter date"
                                name="date_two"
                            />
                            </div>
                        </div>
                    
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Fermer
                        </button>
                        <button type="submit" class="btn btn-primary">Valider</button>
                        </div>
                    </div>
                
                    </div>
                    </form>
                </div>
                @php
                    function valeur($valeur){
                        $number = $valeur;
                        $n=  str_replace(',',' ', number_format($number,3));
                        $a = strstr($n, '.');
                        return $montant= str_replace($a,'',$n);
                    }
                   
                @endphp
                @php
                    $total = 0;
                @endphp
                <div class="card-body">
                    @if(count($deps) > 0)       
                    <div class="d-flex flex-wrap" id="icons-container">
                        @foreach($deps as $dep)

                        @php
                            $montant = valeur($dep->montant_depense)
                        @endphp
                        
                            <div class="card icon-card  text-center mb-4 mx-4">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{asset('/assets/img/icons/unicons/cc-primary.png')}}" alt="chart success" class="rounded">
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                            <a class="dropdown-item" href="{{ route('depense.annuler',['id'=>$dep->id])}}" onclick="return confirm('Voulez-vous anuuler?')"><i style="color:#696cff !important">Annuler</i></a>
                                            <a class="dropdown-item" href="{{ route('depense.delete',['id'=>$dep->id])}}" onclick="return confirm('Voulez-vous supprimer?')"><i style="color:#ff3e1d !important">Supprimer</i> </a>
                                            <a class="dropdown-item" href="{{ route('depense.edit',['id'=>$dep->id])}}" onclick="return confirm('Voulez-vous modifier?')"><i style="color:#03c3ec !important">Modifier</i></a>
                                           
                                            </div>
                                        </div>
                                    </div>
                                    <i class="bx bxl-bitcoin mb-2"></i>
                                    <p class="icon-name text-capitalize text-truncate mb-0">{{$dep->categorie->nom_categorie}}</p>
                                    <p class="icon-name text-capitalize text-truncate mb-0">{{$montant}} Ar</p>
                                    <p class="icon-name text-capitalize text-truncate mb-0">{{$dep->date_depense}}</p>
                                    
                                </div>
                            </div>
                            @php
                            $total += $dep->montant_depense;
                            @endphp
                        @endforeach
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                @php
                                    $total_montant = valeur($total)
                                @endphp
                              <h3 class="mb-0">Total: {{$total_montant}} AR</h3>
                            </div>
                            
                        </div>  
                        
                    </div>
                    <ul class="pagination">
                        {{-- Lien vers la page précédente --}}
                        @if ($deps->onFirstPage())
                            <li class="disabled"><span>&laquo;</span></li>
                        @else
                            <li class="page-item first"><a href="{{ $deps->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                        @endif

                        {{-- Liens vers les pages --}}
                        @foreach ($deps->getUrlRange(1, $deps->lastPage()) as $page => $url)
                            @if ($page == $deps->currentPage())
                                <li class="active"><span>{{ $page }}</span></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        {{-- Lien vers la page suivante --}}
                        @if ($deps->hasMorePages())
                            <li><a href="{{ $deps->nextPageUrl() }}" rel="next">&raquo;</a></li>
                        @else
                            <li class="disabled"><span>&raquo;</span></li>
                        @endif
                    </ul>
                
                        
                    @else
                        <div class="alert alert-danger alert-dismissible" role="alert">
                        Aucun depense trouvé!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
        <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Depense aujourdhui</h5>
                    
                </div>
                <div class="card-body">
                <ul class="p-0 m-0">
                    @php
                        $prixTotal = 0;
                    @endphp
                    @foreach($dep_now as $depense)
                        @php
                            $number = $depense->montant_depense;
                            $n=  str_replace(',',' ', number_format($number,3));
                            $a = strstr($n, '.');
                            $montant= str_replace($a,'',$n);
                        @endphp
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <img src="{{asset('assets/img/icons/unicons/cc-success.png')}}" alt="User" class="rounded">
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <small class="text-muted d-block mb-1">{{$depense->id}}</small>
                              <h6 class="mb-0">{{$depense->categorie->nom_categorie}}</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                              <h6 class="mb-0">{{$montant}}</h6>
                              <span class="text-muted">AR</span>
                            </div>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu" style="">
                                <a class="dropdown-item" href="{{ route('depense.annuler',['id'=>$dep->id])}}" onclick="return confirm('Voulez-vous anuuler?')"><i style="color:#696cff !important">Annuler</i></a>
                                            <a class="dropdown-item" href="{{ route('depense.delete',['id'=>$dep->id])}}" onclick="return confirm('Voulez-vous supprimer?')"><i style="color:#ff3e1d !important">Supprimer</i> </a>
                                            <a class="dropdown-item" href="{{ route('depense.edit',['id'=>$dep->id])}}" onclick="return confirm('Voulez-vous modifier?')"><i style="color:#03c3ec !important">Modifier</i></a>
                                </div>
                            </div>
                          </div>
                        </li>
                        @php
                            $prixTotal += $depense->montant_depense;
                        @endphp

                      
                    @endforeach   

                    @php
                        $number = $prixTotal;
                        $n=  str_replace(',',' ', number_format($number,3));
                        $a = strstr($n, '.');
                        $montantTotal= str_replace($a,'',$n);
                    @endphp
                       
                      </ul>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              
                              <h3 class="mb-0">Total</h3>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                              <h6 class="mb-0">{{$montantTotal}}</h6>
                              <span class="text-muted">AR</span>
                            </div>
                        </div>     
                </div>
            </div>
        </div>
    </div>
   
</div>
<!-- / Content -->
@endsection