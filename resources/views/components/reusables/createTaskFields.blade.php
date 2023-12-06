@if (session('status'))
    <span class="text-red-400">{{ session('status') }}</span>
@endif

<div class="my-3">
    <input class="w-full px-4 py-2 border-2 rounded border-primary bg-secondary" type="text" name="name" placeholder="Užduoties pavadinimas">
    @error('name')
        <span  class="text-red-400">{{ $message }}</span>
    @enderror
</div>

<div class="my-3">
    <input class="w-full px-4 py-2 border-2 rounded border-primary bg-secondary" type="text" name="time_estimation" placeholder="Užduoties atlikimo laikas (pvz. 8:35)">
    @error('time_estimation')
        <span  class="text-red-400">{{ $message }}</span>
    @enderror
</div>

<div class="my-3">
    <input class="w-full px-4 py-2 border-2 rounded border-primary bg-secondary" type="date" name="dead_line" placeholder="Užduoties terminas (pvz. 2023-12-21)">
    @error('dead_line')
        <span  class="text-red-400">{{ $message }}</span>
    @enderror
</div>

<div class="my-3 text-black">
    {{-- <input class="w-full px-4 py-2 border-2 rounded border-primary bg-secondary" type="textarea" name="description" placeholder="Užduoties aprašymas"> --}}
    <textarea class="w-full px-4 py-2 border-2 rounded border-primary bg-secondary" name="description" id="editor" cols="30" rows="10" placeholder="Užduoties aprašymas"></textarea>
    @error('description')
        <span  class="text-red-400">{{ $message }}</span>
    @enderror
</div>

<button class="primary-btn main-transition">Sukurti užduotį</button>

@section('scripts')

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

@endsection
