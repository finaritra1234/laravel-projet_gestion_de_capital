<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
class AdminLoginController extends Controller
{
   public function __construct(){
        $this->middleware('guest:admin', ['except' => ['logout']]);
   }

   public function loginForm(){
       return view('auth.login');
   }

   public function login (Request $request) {
      //validation form data
      $this->validate($request,[
        'email' => 'required|email',
        'password' => 'required|min:6',
        ],[
            'email.required' =>'Entrer votre email',
            'email.email' =>'votre adresse email est incorrecte',
        
            'password.required' =>'Entrer votre mot de passe',
            'password.min' =>'Le mot de passe est trop courte',
        ]);

        //attemp
        if (Auth::guard('admin')->attempt([
            'email' => $request->email, 
            'password' => $request->password
        ], $request->remember)){
            return redirect()->intended(route('admin.dashboard'));
        } else {
            Session::flash('error','Votre email ou mot de passe est incorrecte');
            return redirect()->back();
        }
        return redirect()->back()->withInput($request->only('email', 'remember'));
   }

    public function logout(){
       
        Auth::guard('admin')->logout();
        return redirect('/');
    
    }

    public function registerForm() {
        return view ('auth.register');
    }

    public function register(Request $request){
        //validation form data
        $this->validate($request,[
        'name' => 'required',     
        'email' => 'required|email',
        'password' => 'required|min:6',
        ],[
            'name.required' =>'Entrer votre nom ',
            'email.required' =>'Entrer votre email',
            'email.email' =>'votre adresse email est incorrecte',
        
            'password.required' =>'Entrer votre mot de passe',
            'password.min' =>'Le mot de passe est trop courte',
        ]);

        //create admin
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        //to dashboard after creating a compte
        Auth::guard('admin')->login($admin);
        return redirect()->intended(route('admin.dashboard'));

    }

  
}
