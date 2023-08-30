<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends HandleController
{
    public function prijava(Request $request)
    {
        $uspesnoLogovanje = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if($uspesnoLogovanje){
            $authUser = Auth::user();
            $odgovor['name'] =  $authUser->name;
            $odgovor['token'] =  $authUser->createToken('Token')->plainTextToken;

            return $this->uspesniOdgovor($odgovor, 'Uspesno ste se logovali.');
        }
        else{
            return $this->greskaOdgovor('Pogresni podaci.');
        }
    }

    public function registracija(Request $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $odgovor['name'] =  $user->name;

        return $this->uspesniOdgovor($odgovor, 'Korisnik registrovan.');
    }
}
