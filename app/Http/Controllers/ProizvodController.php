<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProizvodResurs;
use App\Models\Proizvod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProizvodController extends HandleController
{
    public function index()
    {
        $proizvodi = Proizvod::all();
        return $this->uspesno(ProizvodResurs::collection($proizvodi), 'Vraceni su svi proizvodi iz baze.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'naziv' => 'required',
            'brendID' => 'required',
            'tipID' => 'required',
            'cena' => 'required'
        ]);
        if($validator->fails()){
            return $this->greska($validator->errors());
        }

        $proizvod = Proizvod::create($input);

        return $this->uspesno(new ProizvodResurs($proizvod), 'Novi proizvod je dodat u bazu.');
    }


    public function show($ID)
    {
        $proizvod = Proizvod::find($ID);
        if (is_null($proizvod)) {
            return $this->greska('Proizvod sa zadatim ID-em ne postoji u bazi.');
        }
        return $this->uspesno(new ProizvodResurs($proizvod), 'Vracen je proizvod sa zadatim ID-em.');
    }


    public function update(Request $request, $ID)
    {
        $proizvod = Proizvod::find($ID);
        if (is_null($proizvod)) {
            return $this->greska('Proizvod sa zadatim ID-em ne postoji u bazi.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'naziv' => 'required',
            'brendID' => 'required',
            'tipID' => 'required',
            'cena' => 'required'
        ]);

        if($validator->fails()){
            return $this->greska($validator->errors());
        }

        $proizvod->naziv = $input['naziv'];
        $proizvod->brendID = $input['brendID'];
        $proizvod->tipID = $input['tipID'];
        $proizvod->cena = $input['cena'];
        $proizvod->save();

        return $this->uspesno(new ProizvodResurs($proizvod), 'Proizvod sa zadatim ID-em je azuriran.');
    }

    public function destroy($ID)
    {
        $proizvod = Proizvod::find($ID);
        if (is_null($proizvod)) {
            return $this->greska('Proizvod sa zadatim ID-em ne postoji u bazi.');
        }

        $proizvod->delete();
        return $this->uspesno([], 'Proizvod sa zadatim ID-em je obrisan iz baze');
    }
}