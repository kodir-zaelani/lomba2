<div>
    <div class="box box-outline-warning" >
        <div class="box-body">
            <form enctype="multipart/form-data">
                <div class="form-group">
                    <h5>Title <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" wire:model.lazy="editingTagTitle" class="form-control @error('editingTagTitle') is-invalid @enderror" placeholder="Tag Title" required autofocus>
                    </div>
                    @error('editingTagTitle')
                    <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                    @enderror
                </div>
                <button class="btn btn-sm btn-primary" wire:click.prevent='updatetag'><i class="ti-save pe-2"></i> Update</button>
                <button class="btn btn-sm btn-warning ms-10" wire:click='cancelEdit'><i class="ti-back-left pe-2"></i> Cancel</button>
            </form>
        </div>
    </div>
</div>
