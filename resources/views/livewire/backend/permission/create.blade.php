<div>
    <div class="box box-outline-success">
        <div class="box-header">
          <h4 class="box-title"><strong>Create </strong></h4>
        </div>

        <form enctype="multipart/form-data" >
        <div class="box-body">

            <div class="form-group">
                <h5>Name <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" >
                </div>
                <div class="form-control-feedback"><small class="text-primary"> {{ $name }}</small></div>
                @error('name')
                <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                @enderror
            </div>

            <div class="form-group">
                <h5>Description <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input type="text" wire:model="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description" >
                </div>
                <div class="form-control-feedback"><small class="text-primary"> {{ $description }}</small></div>
                @error('description')
                <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                @enderror
            </div>

        </div>

        <div class="box-footer flexbox">
          <div class="text-end flex-grow">
            <button class="btn btn-sm btn-primary" wire:click.prevent="store"><i class="fa fa-save me-2" aria-hidden="true"></i> Save</button>
          </div>
        </div>
       </form>
      </div>
</div>
