<div>
    <div class="box bs-3 border-success" >
        <div class="box-body">
            <form enctype="multipart/form-data" >
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
                    <h5>Icon <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" wire:model="icon" class="form-control @error('icon') is-invalid @enderror" placeholder="Icon" required autofocus>
                        <small>
                            <a href="https://icons.getbootstrap.com/" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-bootstrap"></i> Select Icon Bootsrap
                            </a>
                        </small>
                    </div>
                    @error('icon')
                    <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                    @enderror
                </div>
                <div class="form-group">
                    <h5>URL </h5>
                    <div class="controls">
                        <input type="text" wire:model="url" class="form-control @error('url') is-invalid @enderror" placeholder="URL" required autofocus>
                    </div>
                    @error('url')
                    <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                    @enderror
                </div>

                <div class="form-group">
                    <h5>Script Embed </h5>
                    <div class="controls">
                        <textarea name="" wire:model="scriptembed" class="form-control @error('scriptembed') is-invalid @enderror"  id="" cols="100%" rows="5"></textarea>
                    </div>
                    @error('scriptembed')
                    <div class="form-control-feedback"><small> <code>{{ $message }}</code> </small></div>
                    @enderror
                </div>
                <button class="btn btn-sm btn-primary" wire:click.prevent='store'><i class="ti-save pe-2"></i> Save</button>
            </form>
        </div>
    </div>
</div>
