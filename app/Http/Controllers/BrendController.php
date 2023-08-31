<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrendResurs;
use App\Models\Brend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrendController extends HandleController
{
    public function index()
    {
        $brendovi = Brend::all();
        return $this->uspesno(BrendResurs::collection($brendovi), 'Vraceni su svi brendovi iz baze.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'brend' => 'required',
        ]);
        if($validator->fails()){
            return $this->greska($validator->errors());
        }

        $brend = Brend::create($input);

        return $this->uspesno(new BrendResurs($brend), 'Novi brend je dodat u bazu.');
    }


    public function show($ID)
    {
        $brend = Brend::find($ID);
        if (is_null($brend)) {
            return $this->greska('Brend sa zadatim ID-em ne postoji u bazi.');
        }
        return $this->uspesno(new BrendResurs($brend), 'Vracen je brend sa zadatim ID-em.');
    }


    public function update(Request $request, $ID)
    {
        $brend = Brend::find($ID);
        if (is_null($brend)) {
            return $this->greska('Brend sa zadatim ID-em ne postoji u bazi.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'brend' => 'required',
        ]);

        if($validator->fails()){
            return $this->greska($validator->errors());
        }

        $brend->brend = $input['brend'];
        $brend->save();

        return $this->uspesno(new BrendResurs($brend), 'Brend sa zadatim ID-em je azuriran.');
    }

    public function destroy($ID)
    {
        $brend = Brend::find($ID);
        if (is_null($brend)) {
            return $this->greska('Brend sa zadatim ID-em ne postoji u bazi.');
        }

        $brend->delete();
        return $this->uspesno([], 'Brend sa zadatim ID-em je obrisan iz baze.');
    }
}
