<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //
    public function index(){
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)]);
    }

    public function show(Listing $listing){
        return view('listings.show', [
            'listings' => $listing
        ]);
    }

    public function create(){
        return view('listings.create');
    }

    //Store listing data
    public function store(Request $request){
        //dd($request->all());
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        //Session::flash('message', 'Listing Created Successfully');

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    //Show Edit Form
    public function edit(Listing $listing){
        return view('listings.edit', ['listings' => $listing]);
    }

    //Update Listing Data
    public function update(Request $request, Listing $listing){
        //dd($request->all());
        //Make sure logged in user is owner
        if($listing->user_id != auth()->id()){
            abort(403, 'Unathorized action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        //Session::flash('message', 'Listing Created Successfully');

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }


        //Delete listing
        public function destroy(Listing $listing){
            //Make sure logged in user is owner
            if($listing->user_id != auth()->id()){
                abort(403, 'Unathorized action');
            }

            $listing->delete();
            return redirect('/')->with('message', 'Listing deleted successfully! ');
        }

        //Manage Listings
        public function manage(){
            return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
        }
}
