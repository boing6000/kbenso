<?php

namespace LaravelEnso\AddressesManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelEnso\AddressesManager\app\Forms\Builders\AddressForm;
use LaravelEnso\AddressesManager\App\Http\Requests\ValidateAddressRequest;
use LaravelEnso\AddressesManager\app\Http\Resources\Address as Resource;
use LaravelEnso\AddressesManager\app\Models\Address;

class AddressesController extends Controller
{
    public function index(Request $request)
    {
        return Resource::collection(
                Address::for($request->only([
                    'addressable_id', 'addressable_type',
                ]))->ordered()
                ->get()
            );
    }

    public function create(AddressForm $form)
    {
        return ['form' => $form->create()];
    }

    public function store(ValidateAddressRequest $request)
    {
        Address::store(
            $request->all(),
            $request->get('_params')
        );

        return [
            'message' => __('The address was successfully created'),
        ];
    }

    public function edit(Address $address, AddressForm $form)
    {
        return ['form' => $form->edit($address)];
    }

    public function update(ValidateAddressRequest $request, Address $address)
    {
        $address->update($request->all());

        return [
            'message' => __('The address have been successfully updated'),
        ];
    }

    public function setDefault(Address $address)
    {
        $address->setDefault();
    }

    public function destroy(Address $address)
    {
        $address->delete();

        return ['message' => __('The address was deleted')];
    }
}
