<?php

namespace App\Http\Controllers;

use App\Http\Resources\TipResurs;
use App\Models\Tip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipController extends HandleController
{
    public function index()
    {
        $tipovi = Tip::all();
        return $this->uspesno(TipResurs::collection($tipovi), 'Vraceni su svi tipovi iz baze.');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'tip' => 'required',
        ]);
        if($validator->fails()){
            return $this->greska($validator->errors());
        }

        $tip = Tip::create($input);

        return $this->uspesno(new TipResurs($tip), 'Novi tip je dodat u bazu.');
    }


    public function show($ID)
    {
        $tip = Tip::find($ID);
        if (is_null($tip)) {
            return $this->greska('Tip sa zadatim ID-em ne postoji u bazi.');
        }
        return $this->uspesno(new TipResurs($tip), 'Vracen je tip sa zadatim ID-em.');
    }


    public function update(Request $request, $ID)
    {
        $tip = Tip::find($ID);
        if (is_null($tip)) {
            return $this->greska('Tip sa zadatim ID-em ne postoji u bazi.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'tip' => 'required',
        ]);

        if($validator->fails()){
            return $this->greska($validator->errors());
        }

        $tip->tip = $input['tip'];
        $tip->save();

        return $this->uspesno(new TipResurs($tip), 'Tip sa zadatim ID-em je azuriran.');
    }

    public function destroy($ID)
    {
        $tip = Tip::find($ID);
        if (is_null($tip)) {
            return $this->greska('Tip sa zadatim ID-em ne postoji u bazi.');
        }

        $tip->delete();
        return $this->uspesno([], 'Tip sa zadatim ID-em je obrisan iz baze.');
    }
}
