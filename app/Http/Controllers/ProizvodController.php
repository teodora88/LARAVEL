<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProizvodResurs;
use App\Models\Proizvod;
use Illuminate\Http\Request;

class ProizvodController extends HandleController
{
    public function index()
    {
        $proizvodi = Proizvod::all();
        return $this->uspesno(ProizvodResurs::collection($proizvodi), 'Uspesno.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $proizvod = Proizvod::create($input);

        return $this->uspesno(new ProizvodResurs($proizvod), 'Uspesno.');
    }


    public function show($ID)
    {
        $proizvod = Proizvod::find($ID);
        if (is_null($proizvod)) {
            return $this->greska('Greska.');
        }
        return $this->uspesno(new ProizvodResurs($proizvod), 'Uspesno.');
    }


    public function update(Request $request, $ID)
    {
        $proizvod = Proizvod::find($ID);
        if (is_null($proizvod)) {
            return $this->greska('Greska.');
        }

        $input = $request->all();

        $proizvod->naziv = $input['naziv'];
        $proizvod->brendID = $input['brendID'];
        $proizvod->tipID = $input['tipID'];
        $proizvod->cena = $input['cena'];
        $proizvod->save();

        return $this->uspesno(new ProizvodResurs($proizvod), 'Uspesno.');
    }

    public function destroy($ID)
    {
        $proizvod = Proizvod::find($ID);
        if (is_null($proizvod)) {
            return $this->greska('Greska.');
        }

        $proizvod->delete();
        return $this->uspesno([], 'Uspesno.');
    }
}
