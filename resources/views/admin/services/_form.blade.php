<div>
    <form role="form" action="{{ $service->exists
        ? route('admin.services.update', ['service' => $service->getKey()])
        : route('admin.services.store') }}"
        method="POST"
    >
        @method($service->exists ? 'PUT' : 'POST')
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">{{ @trans('messages.name') }}</label>
                <div class="input-group">
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Serviço exemplo" value="{{ $service->name ?? old('name') }}" autofocus>
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="description">{{ @trans('messages.description') }}</label>
                <div class="input-group">
                    <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" placeholder="Descrição exemplo" value="{{ $service->description ?? old('description') }}">
                    @if ($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="price">{{ @trans('messages.price') }}</label>
                <div class="input-group">
                    <input type="text" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" id="price" name="price" placeholder="0.00" value="{{ $service->price ?? old('price') }}">
                    @if ($errors->has('price'))
                        <div class="invalid-feedback">
                            {{ $errors->first('price') }}
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
