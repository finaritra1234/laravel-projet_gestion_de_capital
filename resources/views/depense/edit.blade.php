<!DOCTYPE html>

<html
  lang="en"
  class="light-style"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Page | edit</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon/favicon.ico')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-misc.css')}}" />
    <!-- Helpers -->
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('assets/js/config.js')}}"></script>
  </head>

  <body>
    <!-- Content -->

    <!--Under edit -->
    <div class="container-xxl container-p-y">
        
       <div class="row">
       @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{Session::get('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
       <div class="col-xxl">
        <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Modefier le depense N° {{$dep->id}}</h5>
          
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('depense.edit.submit',[ 'id' =>$dep->id ])}}">
            @csrf
            <div class="row mb-3">
                <input type="text " name="compte_id" value="1" style="display:none;">
                <label class="col-sm-2 col-form-label" for="depense">Depense</label>
                <div class="col-sm-10">
                    <select class="form-control" id="categorie_id" name="categorie_id">
                        <option value="{{$dep->categorie_id}}">{{  $dep->categorie->nom_categorie }}</option>
                        @foreach($cats as $cat)
                        <option value="{{$cat->id}}">{{$cat->nom_categorie}}</option>
                        @endforeach
                                        
                    </select>
                 </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="montant_depense">Montant</label>
                <div class="col-sm-10">
                <input type="number" class="form-control" id="montant_depense" name="montant_depense" value="{{$dep->montant_depense}}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="date_depense">Date</label>
                <div class="col-sm-10">
                <input type="date"  class="form-control" id="date_depense" name="date_depense" value="{{$dep->date_depense}}">
                </div>
            </div>
           
            <div class="row justify-content-end">
                <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">MODIFIER</button>
                </div>
            </div>
            </form>
            <a type="button" class="btn btn-default" href="{{ route('depense')}}" style="position: relative;left: 87%;margin-top: -5%;">Retour</a>
        </div>
        </div>
    </div>
       </div>
    </div>
    <!-- /Under edit -->

    <!-- / Content -->

    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{asset('assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{asset('assets/js/main.js')}}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
