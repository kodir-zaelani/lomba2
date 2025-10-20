<div>
    <div class="box box-outline-warning">
        <div class="box-header">
          <h4 class="box-title"><strong>Edit</strong></h4>
        </div>
        <form enctype="multipart/form-data" >
        <div class="box-body">
            <div class="form-group">
                <h5>Name <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" required autofocus>
                </div>
                @error('name')
                <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                @enderror
            </div>

            <div class="form-group">
                <h5>Description <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input type="text" wire:model="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description" >
                </div>
                @error('description')
                <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                @enderror
            </div>
        </div>
        <div class="box-footer flexbox">
          <div class="text-end flex-grow">
            <button class="btn btn-sm btn-primary" wire:click.prevent="update"><i class="fa fa-save" aria-hidden="true"></i> Update</button>
            <button class="btn btn-sm btn-warning ms-10" wire:click='cancelEdit'><i class="ti-back-left pe-2"></i> Cancel</button>
          </div>
        </div>
       </form>
      </div>
</div>
