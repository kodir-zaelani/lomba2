<div>
    <div class="box bs-3 border-success">
        <div class="box-header">
          <h4 class="box-name"><strong>Create</strong></h4>
        </div>
        <form enctype="multipart/form-data" >
        <div class="box-body">
            <div class="form-group">
                <h5>Menu Name  <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Menu name" required>
                </div>
                @error('name')
                <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                @enderror
            </div>
        </div>
        <div class="box-footer flexbox">
          <div class="flex-grow text-end">
            <button class="btn btn-sm btn-primary" wire:click.prevent="store"><i class="ti-save"></i> Save</button>
          </div>
        </div>
       </form>
      </div>
</div>
