<?php

namespace App\Livewire\Backend\Album;

use App\Models\Foto;
use App\Models\Album;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $currentPage   = 1;
    public $paginate      = 10;
    public $search        = '';
    public $checked       = [];
    public $selectPage    = false;
    public $selectAll     = false;
    public $sortDirection = 'desc';
    public $sortColumn    = 'created_at';
    public $statusUpdate  = false;
    public $headersTable;
    public $action;
    public $selectedItem;

    public $uploadPath = 'uploads/images/fotos';

    public $multiplephoto;
    public $title;
    public $image;
    public $foto;
    public $status;
    public $created_at;


    protected $listeners = [
        'albumStored',
        'albumUpdated',
        'photoCreated',
        'photoDeleted',
    ];

    protected $queryString = [
        // Keeping A Clean Query String https://laravel-livewire.com/docs/2.x/query-string#clean-query-string
        'search'      => ['except' => ''],
        'currentPage' => ['except' => 1]
    ];

    private function headerConfig()
    {
        return [
            'image'      => 'Image',
            'title'      => 'Title',
            // 'status'     => 'Status',
            // 'created_at' => 'Created',
        ];
    }

    public function sortBy($column)
    {
        $this->sortColumn = $column;

        $this->sortDirection = $this->reverseSort();
    }

    public function reverseSort()
    {
        return $this->sortDirection === 'asc'
        ? 'desc'
        : 'asc';
    }

    public function mount()
    {
        $this->fill(request()->only('search', 'currentPage'));
        $this->resetSearch();
        $this->headersTable = $this->headerConfig();
    }

    public function resetSearch()
    {
        $this->search = '';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getAlbumQueryProperty()
    {
        return Album::orderBy($this->sortColumn, $this->sortDirection)
        ->search(trim($this->search)); //search menggunakan scopeSearch di model
    }

    public function getAlbumProperty()
    {
        return $this->albumQuery->paginate($this->paginate);
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked = $this->album->pluck('id')->map(fn ($item) => (string) $item)->toArray();
        } else {
            $this->checked = [];
        }
    }

    public function updatedChecked()
    {
        $this->selectPage = false;
    }

    public function selectAll()
    {
        $this->selectAll = true;
        $this->checked = $this->albumQuery->pluck('id')->map(fn ($item) => (string) $item)->toArray();
    }

    public function isChecked($id)
    {
        return in_array($id, $this->checked);
    }

    public function albumStored($album)
    {
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Success!',
            'timer' => 5000,
            'icon' => 'success',
            'text' => 'Album ' . $album['title'] . ' was Stored',
            'toast' => true, // Jika mau menggunakan toas
            'position' => 'top-right', // Jika mau menggunakan toas
            'showConfirmButton' => true,
            'showCancelButton' => false,
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function albumUpdated($album)
    {
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Success!',
            'timer' => 5000,
            'icon' => 'success',
            'text' => 'Album ' . $album['title'] . ' was Updated',
            // 'toast'=>true, // Jika mau menggunakan toas
            // 'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton' => true,
            'showCancelButton' => false,
        ]);
        $this->statusUpdate = false;
    }

    public function photoCreated()
    {
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Success!',
            'timer' => 5000,
            'icon' => 'success',
            'text' => 'Item Photo  was Stored',
            'toast' => true, // Jika mau menggunakan toas
            'position' => 'top-right', // Jika mau menggunakan toas
            'showConfirmButton' => true,
            'showCancelButton' => false,
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatch('closemodalFormAddPhotos');
    }

    public function photoDeleted()
    {
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Deleted Success!',
            'timer' => 4000,
            'icon'  => 'success',
            'text'  => 'Foto was deleted',
            // 'toast'=>true, // Jika mau menggunakan toas
            // 'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton' => true,
            'showCancelButton'  => false,
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatch('closemodalFormAddPhotos');
    }
    public function selectItem($itemId, $action)
    {
        $this->statusUpdate = false;

        $this->selectedItem = $itemId;

        if ($action == 'delete') {
            // This will show the modal in the frontend
            $this->dispatch('openDeleteModal');
        } elseif ($action == 'addphotos') {
            $this->dispatch('getModelId', $this->selectedItem);
            // This will show the modal in the frontend
            $this->dispatch('openmodalFormAddPhotos');
        } elseif ($action == 'deletefoto') {
            $this->dispatch('getModelId', $this->selectedItem);
            // This will show the modal in the frontend
            $this->dispatch('openmodalFormdeleteFoto');
         } elseif ($action == 'draft') {
            $this->changeDraft();
        } elseif ($action == 'publish') {
            $this->changePublish();
        }
    }

    public function changeDraft()
    {
        $data = [];
        $data = array_merge($data, ['status' => 0]);
        $post = Album::find($this->selectedItem);

        $post->update($data);
        session()->flash('success', 'Album Change to Draft was successfully');
        return redirect()->to('backend/albums');
    }
    public function changePublish()
    {
        $data = [];
        $data = array_merge($data, ['status' => 1]);
        $post = Album::find($this->selectedItem);

        $post->update($data);
        session()->flash('success', 'Album Change to Publish was successfully');
        return redirect()->to('backend/albums');
    }

    public function deleteRecords()
    {
        Album::whereKey($this->checked)->delete();

        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false;
        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Deleted Success!',
            'timer' => 4000,
            'icon' => 'success',
            'text' => 'Selected Records were deleted Successfully',
            // 'toast'=>true, // Jika mau menggunakan toas
            // 'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton' => true,
            'showCancelButton' => false,
        ]);
        $this->dispatch('refreshParent');
        $this->dispatch('closeDeleteModalAll');
    }

    // Delete Single Record
    public function delete()
    {
        Album::destroy($this->selectedItem);

        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Deleted Success!',
            'timer' => 4000,
            'icon'  => 'success',
            'text'  => 'Album was deleted',
            // 'toast'=>true, // Jika mau menggunakan toas
            // 'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton' => true,
            'showCancelButton'  => false,
        ]);


        $this->dispatch('refreshParent');
        // This will hide the modal in the frontend
        $this->dispatch('closeDeleteModal');
    }
    public function deletefoto()
    {
        Foto::destroy($this->selectedItem);

        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Deleted Success!',
            'timer' => 4000,
            'icon'  => 'success',
            'text'  => 'Album was deleted',
            // 'toast'=>true, // Jika mau menggunakan toas
            // 'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton' => true,
            'showCancelButton'  => false,
        ]);


        $this->dispatch('refreshParent');
        // This will hide the modal in the frontend
        $this->dispatch('closemodalFormdeleteFoto');
        session()->flash('danger', 'Foto  delete was successfully');
        return redirect()->to('backend/albums');
    }

    // Add Fotos
    public function photosStore()
    {
        $validateData = [
            'foto' => 'required',
        ];
        // Validate image
        if (!empty($this->foto)) {
            // Append to the validation if image is not empty
            $validateData = array_merge($validateData, [
                'images.*' => 'image'
            ]);
        }

        $this->validate($validateData);


        if (!empty($this->images)) {
            foreach ($this->images as $image) {

                $imageHashName = $image->hashName();

                // Upload the main image
                $image->store('images/fotos/');

                // Create a thumbnail of the image using Intervention Image Library
                $manager = new ImageManager();
                $imagedata = $manager->make('uploads/images/fotos/' . $imageHashName)->resize(300, 200); // Jangan lupa sesauikan nama folder dengan public folder image
                $imagedata->save(public_path('uploads/images/fotos/images_thumb/' . $imageHashName)); // Jangan lupa buat folder sesuai dengan rencana penyimpanan

                $data = [
                    // 'title'     => 'Photo' . time() . '-' . $this->title,
                    // 'slug'      => Str::slug(time() . '-' . $this->title),
                    'album_id'           => $this->selectedItem,
                    'status'             => '1',
                    'author_id'          => Auth::id(),
                ]; // This is to save the filename of the image in the database
                $data = array_merge($data, [
                    'image' => $imageHashName
                ]);
                Foto::create($data);
            }
        }

        $this->cleanVars();
        // even listener -> dispatch
        $this->dispatch('photoCreated');
        // This is to reset our public variables
        return redirect()->to('backend/albums')->with('success', 'Add Fotos  was successfully');

    }


    private function cleanVars()
    {
        // Kosongkan field input
        $this->images = '';
    }

    public function render()
    {
        return view('livewire.backend.album.index', [
            'dataalbumall' => $this->album,
            'title_page' => 'Albums'
        ]);
    }
}