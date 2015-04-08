<?php namespace Pur\Http\Controllers;

use Pur\Bruker;
use Pur\Http\Requests;
use Pur\Http\Controllers\Controller;

use Request;

class BrukerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Bruker $bruker)
	{
		$brukere = $bruker->get();
        //dd($brukere);
        return view('brukere.index', compact('brukere'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('brukere.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Bruker $bruker)
	{
        $input = Request::all();

        return $input;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Bruker $bruker)
	{
        return view('brukere.show', compact('bruker'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(Bruker $bruker, Request $request)
    {
        $bruker->fill($request->all())->save();
        return view('brukere.show', compact('bruker'));
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
