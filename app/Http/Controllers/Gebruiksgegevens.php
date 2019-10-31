<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gebruiksgegeven;
use Illuminate\Support\Facades\Storage;

class Gebruikgegevens extends Controller
{
    function save(Request $req){
        $gebruiksgegevens = new Gebruiksgegeven;

        foreach ($data as $key => $value) {
            if($value == null){
                return redirect('dashboard/dashboard1')->with('exception', 'Niet alle velden zijn ingevuld!');
            }
        }

        try {
            $gebruiksgegevens->adress = $req->gebruiksAdress;
            $gebruiksgegevens->postcode = $req->gebruiksWoonplaats;
            $gebruiksgegevens->telefoonnummer = $req->gebruiksPostcode;
            $gebruiksgegevens->woonplaats = $req->gebruiksNummer;
            $gebruiksgegevens->save();
            return redirect('dashboard/dashboard1')->with('success', 'Gebruiksgevens zijn aangemaakt!');
        } catch(\Exception $e){
            return redirect('dashboard/dashboard1')->with('exception', 'Gebruiksgegevens zijn niet aangemaakt!');
        }
    }

    function read(){
        $gebruiksgegevens = Gebruikgegeven::all();
        return view('dashboard/dashboard1',['gebruiksgegevens'=>$gebruiksgegevens]);
    }

    function delete(Request $req){
        $gebruiksgegevens=Gebruikgegeven::find($req->gebruiksgegevensId);
        $gebruiksgegevens->delete();
        return redirect('dashboard/dashboard1')->with('success', 'Gebruikgegevens is succesvol verwijderd!');
    }
    function update(Request $req){
        foreach ($data as $key => $value) {
            if($value == null){
                return redirect('dashboard/dashboard1')->with('exception', 'Niet alle velden zijn ingevuld!');
            }
        }
        try {
            $gebruiksgegevens=Gebruikgegeven::find($req->gebruiksgegevensId);
            $gebruiksgegevens->adress = $req->gebruiksAdress;
            $gebruiksgegevens->woonplaats = $req->gebruiksWoonplaats;
            $gebruiksgegevens->postcode = $req->gebruiksPostcode;
            $gebruiksgegevens->telefoonnummer = $req->gebruiksNummer;

            $gebruiksgegevens->save();
            return redirect('dashboard/dashboard1')->with('success', 'Gebruiksgegevens is succesvol bijgewerkt!');
        } catch(\Exception $e){
            return redirect('dashboard/dashboard1')->with('exception', 'Gebruiksgegevens is unsuccesvol aangemaakt!');
        }

    }
    function find(Request $req){
        $gebruiksgegevens=Gebruikgegeven::find($req->gebruiksgegevensId);
        return view('dashboard/gebruiksgegevens',['gebruiksgegevens'=>$gebruiksgegevens]);
    }

}
