<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerStoreRequest;
use App\Http\Requests\Admin\CustomerUpdateRequest;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::paginate(10);

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $customer = new Customer();

        return view('admin.customers.create', compact('customer'));
    }

    /**
     * @param \App\Http\Requests\Admin\CustomerStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request)
    {
        $customer = new Customer($request->validated());

        $customer->save();

        return redirect()
            ->route('admin.customers.index')
            ->with(['alert-success' => 'Cliente criado com sucesso!']);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Customer $customer)
    {
        return view('admin.customers.show', compact('customer'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * @param \App\Http\Requests\Admin\CustomerUpdateRequest $request
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $customer->update($request->validated());

        return redirect()
            ->route('admin.customers.index')
            ->with(['alert-success' => 'Cliente editado com sucesso!']);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Customer $customer)
    {
        $customer->delete();

        return response()->json($customer);
    }
}
