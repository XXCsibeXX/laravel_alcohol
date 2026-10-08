@if (session('success'))
    <div class="alert alert-success" data-flash>
        <x-icon name="check" />
        <span>{{ session('success') }}</span>
        <button type="button" class="alert-close" data-dismiss aria-label="Bezárás"><x-icon name="x" /></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-error">
        <x-icon name="alert" />
        <div>
            <strong>Hoppá, javítsd az alábbiakat:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
