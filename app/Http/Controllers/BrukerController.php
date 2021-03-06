<?php namespace Pur\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pur\Bruker;
use Pur\Http\Requests;

class BrukerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['except' => ['redigerInnlogget', 'oppdaterInnlogget']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function opplist(Bruker $bruker)
    {
        $brukere = $bruker->get();
        //dd($brukere);
        return view('brukere.opplist', compact('brukere'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function opprett()
    {
        // TODO: implementér
        return "<i>Opprett ny bruker</i>";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function lagre(Bruker $bruker)
    {
        // TODO: implementér
        return "<i>Lagre ny bruker</i>";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function rediger(Bruker $bruker)
    {
        return view('brukere.rediger', compact('bruker'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function redigerInnlogget()
    {
        $bruker = Auth::user();
        return view('brukere.rediger', compact('bruker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function oppdater(Bruker $bruker, Request $request)
    {
        $bruker->fill($request->all())->save();
        return view('brukere.rediger', compact('bruker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function oppdaterInnlogget(Request $request)
    {
        $bruker = Auth::user();
        $bruker->navn = $request->input('navn');
        $bruker->save();

        return view('brukere.rediger', compact('bruker'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function slett(Bruker $bruker)
    {
        // TODO: implementér
        return "<i>Slett bruker med id " . $bruker->id . "</i>";
    }

}
