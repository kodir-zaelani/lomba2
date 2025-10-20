<div>
    <div class="box box-outline-warning" >
       <div class="box-body">
            <form enctype="multipart/form-data" >
                <div class="form-group">
                    <h5>Name <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" wire:model="editingSocialmediaName" class="form-control @error('editingSocialmediaName') is-invalid @enderror" placeholder="Name" required autofocus>
                    </div>
                    @error('editingSocialmediaName')
                    <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                    @enderror
                </div>
                <div class="form-group">
                    <h5>Icon <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" wire:model="editingSocialmediaIcon" class="form-control @error('editingSocialmediaIcon') is-invalid @enderror" placeholder="Icon" required autofocus>
                        <small>
                            <a href="https://icons.getbootstrap.com/" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-bootstrap"></i> Select Icon Bootsrap
                            </a>
                        </small>
                    </div>
                    @error('editingSocialmediaIcon')
                    <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                    @enderror
                </div>
                <div class="form-group">
                    <h5>URL </h5>
                    <div class="controls">
                        <input type="url" wire:model="editingSocialmediaUrl" class="form-control @error('editingSocialmediaUrl') is-invalid @enderror" placeholder="URL" required autofocus>
                    </div>
                    @error('editingSocialmediaUrl')
                    <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                    @enderror
                </div>

                <div class="form-group">
                    <h5>Script Embed </h5>
                    <div class="controls">
                        <textarea name="" wire:model="editingSocialmediascriptembed" class="form-control @error('editingSocialmediascriptembed') is-invalid @enderror"  id="" cols="100%" rows="5"></textarea>
                    </div>
                    @error('editingSocialmediascriptembed')
                    <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                    @enderror
                </div>
                <button class="btn btn-sm btn-primary" wire:click.prevent='update'><i class="ti-save pe-2"></i> Update</button>
                <button class="btn btn-sm btn-warning ms-10" wire:click='cancelEdit'><i class="ti-back-left pe-2"></i> Cancel</button>
            </form>
        </div>
    </div>
</div>
