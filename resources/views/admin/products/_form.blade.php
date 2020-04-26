<div>
    <form role="form" action="{{ $product->exists
        ? route('admin.products.update', ['product' => $product->getKey()])
        : route('admin.products.store') }}"
        method="POST"
    >
        @method($product->exists ? 'PUT' : 'POST')
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-2" for="name">{{ @trans('messages.name') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Produto Exemplo" value="{{ $product->name ?? old('name') }}" autofocus>
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2" for="description">{{ @trans('messages.description') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" placeholder="Código de barras" value="{{ $product->description ?? old('description') }}">
                    @if ($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2" for="barcode">{{ @trans('messages.barcode') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('barcode') ? 'is-invalid' : '' }}" id="barcode" name="barcode" placeholder="Descrição" value="{{ $product->barcode ?? old('barcode') }}">
                    @if ($errors->has('barcode'))
                        <div class="invalid-feedback">
                            {{ $errors->first('barcode') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2" for="purchase_price">{{ @trans('messages.purchase_price') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('purchase_price') ? 'is-invalid' : '' }}" id="purchase_price" name="purchase_price" placeholder="0.00" value="{{ $product->purchase_price ?? old('purchase_price') }}">
                    @if ($errors->has('purchase_price'))
                        <div class="invalid-feedback">
                            {{ $errors->first('purchase_price') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2" for="sale_price">{{ @trans('messages.sale_price') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('sale_price') ? 'is-invalid' : '' }}" id="sale_price" name="sale_price" placeholder="0.00" value="{{ $product->sale_price ?? old('sale_price') }}">
                    @if ($errors->has('sale_price'))
                        <div class="invalid-feedback">
                            {{ $errors->first('sale_price') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2" for="unit">{{ @trans('messages.unit') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('unit') ? 'is-invalid' : '' }}" id="unit" name="unit" placeholder="0.00" value="{{ $product->unit ?? old('unit') }}">
                    @if ($errors->has('unit'))
                        <div class="invalid-feedback">
                            {{ $errors->first('unit') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2" for="quantity_in_stock">{{ @trans('messages.quantity_in_stock') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="number" class="form-control {{ $errors->has('quantity_in_stock') ? 'is-invalid' : '' }}" id="quantity_in_stock" name="quantity_in_stock" placeholder="0.00" value="{{ $product->quantity_in_stock ?? old('quantity_in_stock') }}">
                    @if ($errors->has('quantity_in_stock'))
                        <div class="invalid-feedback">
                            {{ $errors->first('quantity_in_stock') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2" for="minimum_quantity_in_stock">{{ @trans('messages.minimum_quantity_in_stock') }}</label>
                <div class="input-group-sm col-sm-10">
                    <input type="number" class="form-control {{ $errors->has('minimum_quantity_in_stock') ? 'is-invalid' : '' }}" id="minimum_quantity_in_stock" name="minimum_quantity_in_stock" placeholder="0.00" value="{{ $product->minimum_quantity_in_stock ?? old('minimum_quantity_in_stock') }}">
                    @if ($errors->has('minimum_quantity_in_stock'))
                        <div class="invalid-feedback">
                            {{ $errors->first('minimum_quantity_in_stock') }}
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
