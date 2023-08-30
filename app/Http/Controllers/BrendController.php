<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrendResurs;
use App\Models\Brend;
use Illuminate\Http\Request;

class BrendController extends HandleController
{
    public function index()
    {
        $brendovi = Brend::all();
        return $this->uspesno(BrendResurs::collection($brendovi), 'Uspesno.');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $brend = Brend::create($input);

        return $this->uspesno(new BrendResurs($brend), 'Uspesno.');
    }


    public function show($ID)
    {
        $brend = Brend::find($ID);
        if (is_null($brend)) {
            return $this->greska('Greska.');
        }
        return $this->uspesno(new BrendResurs($brend), 'Uspesno.');
    }


    public function update(Request $request, $ID)
    {
        $brend = Brend::find($ID);
        if (is_null($brend)) {
            return $this->greska('Greska.');
        }

        $input = $request->all();

        $brend->brend = $input['brend'];
        $brend->save();

        return $this->uspesno(new BrendResurs($brend), 'Uspesno.');
    }

    public function destroy($ID)
    {
        $brend = Brend::find($ID);
        if (is_null($brend)) {
            return $this->greska('Greska.');
        }

        $brend->delete();
        return $this->uspesno([], 'Uspesno.');
    }
}
