<div>
    <form role="form" action="{{ $customer->exists
        ? route('admin.customers.update', ['customer' => $customer->getKey()])
        : route('admin.customers.store') }}"
        method="POST"
    >
        @method($customer->exists ? 'PUT' : 'POST')
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-2" for="name">{{ @trans('messages.name') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="João Silva" value="{{ $customer->name ?? old('name') }}" autofocus>
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2" for="document_number">{{ @trans('messages.document_number') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('document_number') ? 'is-invalid' : '' }}" id="document_number" name="document_number" placeholder="123.456.789-10" value="{{ $customer->document_number ?? old('document_number') }}">
                    @if ($errors->has('document_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('document_number') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2" for="phone_number">{{ @trans('messages.phone_number') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" id="phone_number" name="phone_number" placeholder="(00) 0000-0000" value="{{ $customer->phone_number ?? old('phone_number') }}">
                    @if ($errors->has('phone_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone_number') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2" for="mobile_phone_number">{{ @trans('messages.mobile_phone_number') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('mobile_phone_number') ? 'is-invalid' : '' }}" id="mobile_phone_number" name="mobile_phone_number" placeholder="(00) 00000-0000" value="{{ $customer->mobile_phone_number ?? old('mobile_phone_number') }}">
                    @if ($errors->has('mobile_phone_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('mobile_phone_number') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2" for="email">{{ @trans('messages.email') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" placeholder="email@email.com" value="{{ $customer->email ?? old('email') }}">
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2" for="postal_code">{{ @trans('messages.postal_code') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('postal_code') ? 'is-invalid' : '' }}" id="postal_code" name="postal_code" placeholder="85015-310" value="{{ $customer->postal_code ?? old('postal_code') }}">
                    @if ($errors->has('postal_code'))
                        <div class="invalid-feedback">
                            {{ $errors->first('postal_code') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2" for="street_number">{{ @trans('messages.street_number') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('street_number') ? 'is-invalid' : '' }}" id="street_number" name="street_number" placeholder="1234" value="{{ $customer->street_number ?? old('street_number') }}">
                    @if ($errors->has('street_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('street_number') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2" for="street_name">{{ @trans('messages.street_name') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('street_name') ? 'is-invalid' : '' }}" id="street_name" name="street_name" placeholder="Rua Exemplo" value="{{ $customer->street_name ?? old('street_name') }}">
                    @if ($errors->has('street_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('street_name') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2" for="neighborhood">{{ @trans('messages.neighborhood') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('neighborhood') ? 'is-invalid' : '' }}" id="neighborhood" name="neighborhood" placeholder="Centro" value="{{ $customer->neighborhood ?? old('neighborhood') }}">
                    @if ($errors->has('neighborhood'))
                        <div class="invalid-feedback">
                            {{ $errors->first('neighborhood') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2" for="city">{{ @trans('messages.city') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" id="city" name="city" placeholder="Cidade" value="{{ $customer->city ?? old('city') }}">
                    @if ($errors->has('city'))
                        <div class="invalid-feedback">
                            {{ $errors->first('city') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2" for="state">{{ @trans('messages.state') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" id="state" name="state" placeholder="Paraná" value="{{ $customer->state ?? old('state') }}">
                    @if ($errors->has('state'))
                        <div class="invalid-feedback">
                            {{ $errors->first('state') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2" for="complement">{{ @trans('messages.complement') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('complement') ? 'is-invalid' : '' }}" id="complement" name="complement" placeholder="Complemento" value="{{ $customer->complement ?? old('complement') }}">
                    @if ($errors->has('complement'))
                        <div class="invalid-feedback">
                            {{ $errors->first('complement') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2" for="contact">{{ @trans('messages.contact') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}" id="contact" name="contact" placeholder="Contato" value="{{ $customer->contact ?? old('contact') }}">
                    @if ($errors->has('contact'))
                        <div class="invalid-feedback">
                            {{ $errors->first('contact') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">{{ @trans('messages.save') }}</button>
        </div>
    </form>
</div>
