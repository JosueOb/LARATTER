<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use App\SocialProfile;

class SocialAuthController extends Controller
{
    
    public function facebook(){
        return Socialite::driver('facebook')->redirect();
    }
    public function callback(){
        //se obtiene el usuario que entrega facebook
        $user = Socialite::driver('facebook')->user();
        // dd($user);

        //se verifica si el usuario tenga una red social con el id que nos dio facebook
        //se hace una consulta en donde el usuario tenga al menos una socialprofile que 
        //cumpla una condición
        //el primer parámetro que recibe whereHas es el nombre de la table y después una función anónima
        //que recibe un objeto query como parámetro y se usa los parametros de facebook
        $existing = User::whereHas('socialProfiles', function($query) use($user){
            //la consulta interna busca dentro del socialProfile que se encuentre, debe tener
            //su social_id igual al user_id, se verifica si en la BDD ya se a guaradado una social profile
            //con el id de facebook
            $query->where('social_id', $user->getId());
        })->first();

        if($existing !== null){
            auth()->login($existing);
            return \redirect('/');
        }

        //se utiliza la función seccion y flash de laravel
        //donde flash permite guardar temporalmente en sessión datos que queremos que luego del
        //siguiente pedido no se encuentren en sesión de tal forma no se llenará la seción de datos innecesarios
        //los parametros que recibe son la key que queremos usar de la session y el value
        session()->flash('facebookUser', $user);
        //se muestra un formulario
        return view('users.facebook',[
            'user'=>$user,
        ]);
    }
    public function register(Request $request){
        //se toman los datos de session para garantizar que son los mismos datos del usuario
        $data = session('facebookUser');
        $username = $request->input('username');
        // dd($data->getId());
        // lo que se crea a continuación es un usuario y un perfil de usuario que esta 
        //asociado con el usuario registrado
        $user = User::create([
            'name' => $data->getName(),
            'email' => $data->getEmail(),
            'avatar' => $data->getAvatar(),
            'username' => $username,
            'password' =>\str_random(16),//se le asigna un texto alazar,
        ]);
        // $user = new User();
        // $user->name = $data->getName();
        // $user->email = $data->getEmail();
        // $user ->avatar = $data->getAvatar();
        // $user->username = $username;
        // $user->password = \str_random(16);//se le asigna un texto alazar
        // $user->save();

        $profile = SocialProfile::create([
            'social_id' => $data->getId(),//que viene de facebook 
            'user_id' => $user->id,
        ]);
        
        // $profile = new SocialProfile();
        // $profile->social_id = $data->getId();//que viene de facebook
        // $profile->user_id = $user->id;
        // $profile->save();

        //se loggea al usuario, para ello se utiliza el método auth() y la función login()
        auth()->login($user);
        return redirect('/');
    }

}
