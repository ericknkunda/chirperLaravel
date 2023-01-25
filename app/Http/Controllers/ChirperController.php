<?php

namespace App\Http\Controllers;

use App\Models\chirper;
use Illuminate\Http\Request;

class ChirperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return a message
        //return 'Hello Laravel';
        return view('chirps.index',['chirps' =>chirper::with('user')->latest()->get()]);
    }
    
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validating
        $validated = $request->validate(['message' => 'required|string|max:255',]);
        $request->user()->chirps()->create($validated);
        return redirect(route('chirps.index'));
    }
 
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function show(chirper $chirp)
    {
        //
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function edit(chirper $chirp)
    {
        //updating
        $this->authorize('update', $chirp);
        return view('chirps.edit',['chirper' =>$chirp, ]);
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, chirper $chirp)
    {
        //updating a chirp
        $this->authorize('update', $chirp);
 
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $chirp->update($validated);
 
        return redirect(route('chirps.index'));
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function destroy(chirper $chirp)
    {
        //deleting a chirp
        $this->authorize('delete', $chirp); 
        $chirp->delete(); 
        return redirect(route('chirps.index'));
    }
}
