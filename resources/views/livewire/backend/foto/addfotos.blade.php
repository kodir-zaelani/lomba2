<div>
   <p class="fw-semi-bold">Album : {{ $title }} | {{ $modelphoto->count() }} photo</p>
    <div class="text-center row">
        @forelse ($modelphoto as $item)
            <div class="col">
                <img src="{{ $item->imageThumbUrl ? $item->imageThumbUrl : '/assets/images/no_image.png' }}"
                    alt="...">
                <p>
                    <button wire:click="selectItem('{{ $item->id }}' , 'delete')"
                        class="mx-1 my-1 btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash "></i></button>
                </p>
            </div>
        @empty
            <div class="col">
                <h4>Belum ada data photo</h4>
            </div>
        @endforelse
    </div>
    <form enctype="multipart/form-data" wire:submit.prevent="photosStore">
        <div class="mb-3">
            <label for="images" class="form-label">Multiple Photos</label>
            <input wire:model="images" type="file" multiple class="form-control @error('image') is-invalid @enderror"
                id="images" required>
        </div>
        <button class="btn btn-sm btn-primary"><i class="bi bi-cloud-upload"></i> Multiple Upload</button>
    </form>
</div>
