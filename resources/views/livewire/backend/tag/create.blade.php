<div>
    <div class="box bs-3 border-success" >
        <div class="box-body">
            <form enctype="multipart/form-data" >
            <div class="form-group">
                <h5>Title <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input type="text" wire:model="title" class="form-control @error('title') is-invalid @enderror" placeholder="Tag Title" required autofocus>
                </div>
                @error('title')
                <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                @enderror
            </div>
            <button class="btn btn-sm btn-primary" wire:click.prevent='store'><i class="ti-save pe-2"></i> Save</button>
        </div>
       </form>
      </div>
</div>
