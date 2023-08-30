<?php

namespace App\Http\Controllers;

use App\Http\Resources\TipResurs;
use App\Models\Tip;
use Illuminate\Http\Request;

class TipController extends HandleController
{
    public function index()
    {
        $tipovi = Tip::all();
        return $this->uspesno(TipResurs::collection($tipovi), 'Uspesno.');
    }


    public function store(Request $request)
    {
        $input = $request->all();

        $tip = Tip::create($input);

        return $this->uspesno(new TipResurs($tip), 'Uspesno.');
    }


    public function show($ID)
    {
        $tip = Tip::find($ID);
        if (is_null($tip)) {
            return $this->greska('Greska.');
        }
        return $this->uspesno(new TipResurs($tip), 'Uspesno.');
    }


    public function update(Request $request, $ID)
    {
        $tip = Tip::find($ID);
        if (is_null($tip)) {
            return $this->greska('Greska.');
        }

        $input = $request->all();

        $tip->tip = $input['tip'];
        $tip->save();

        return $this->uspesno(new TipResurs($tip), 'Uspesno.');
    }

    public function destroy($ID)
    {
        $tip = Tip::find($ID);
        if (is_null($tip)) {
            return $this->greska('Greska.');
        }

        $tip->delete();
        return $this->uspesno([], 'Uspesno.');
    }
}
