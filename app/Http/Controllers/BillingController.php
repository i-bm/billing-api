<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillingRequest;
use App\Http\Resources\BillingCollection;
use App\Http\Resources\BillingResource;
use App\Models\Billing;
use App\Models\Company;
use App\Models\Customer;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    use ApiResponses;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $billings = Billing::with('customer')->paginate();

        // info($billings);
        // return response()->json($billings->appends($request->all()));
        return new BillingCollection(Billing::with('customer')->paginate());
        // return $this->success("Retrieved billings", new BillingCollection(Billing::with('customer')->paginate()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BillingRequest $request)
    {

        $amount = $request->amount;
        $description = $request->description;
        // $company_id = $request->company_id;
        $phoneNumber = $request->customer['phone_number'];
        $email_address = isset($request->customer['email']);

        //API key is on the company. Below returns copmany object;
        $company = Auth::user();

        if (! $company) {
            return $this->error('Company not available.');
        }
        $email = $email_address ? $email_address : $phoneNumber . '@oxygenhealth.tech';


        $customer = Customer::where('email', $email)
            ->orWhere('phone_number', $phoneNumber)
            ->first();

        if (! $customer) {
            $customer = $company->customers()->create([
                'code' => 'CUS-' . random_int(1000000, 9999999),
                'phone_number' => $phoneNumber,
                'email' => $email,
                'is_active' => 1,
            ]);
        }

        $billing = $customer->billings()->create([
            'amount' => $amount,
            'description' => $description,
            'due_date' => $request->due_date,
        ]);

        return $this->success('Billing created successfully.', new BillingResource($billing), null);
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

    public function customerBillings(Request $request, $customerEmail)
    {
        // dd($customerEmail);
        $customer = Customer::where('email', $customerEmail)->first();

        $billings = $customer->billings();

        return new BillingCollection($billings->paginate()->appends($request->all()));

        // return $this->success('Billing retrieved successfully.', new BillingCollection($billings->paginate()));
    }
}
