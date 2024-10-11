<?php

namespace App\Http\Controllers;

use App\Models\Apikey;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ApikeyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Auth::user()->companies()->pluck('id');
        $keys = Apikey::whereIn('company_id',$companies )->get();

        return view('pages.dashboard.apikeys.index', compact('keys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.apikeys.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'company' => 'required'
        ]);

        $company = Company::where('uuid', $request->company)->first();
        if (! $company) {
            throw ValidationException::withMessages([
                'company' => 'Company does not exist',
            ]);
        }
        $token = $company->createToken($company->name)->plainTextToken;
        $company->apikey()->create([
            'name' => ucwords($request->name),
            'description' => $request->description,
            'key' => $token,
        ]);

        return redirect()->route('apikeys.index')->with('success', 'API Key created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
