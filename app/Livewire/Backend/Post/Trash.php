<?php

namespace App\Livewire\Backend\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Trash extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $currentPage   = 1;
    public $paginate      = 10;
    public $search        = '';
    public $checked       = [];
    public $selectPage    = false;
    public $selectAll     = false;
    public $sortDirection = 'asc';
    public $sortColumn    = 'created_at';
    public $statusUpdate  = false;
    public $headersTable;
    public $action;
    public $selectedItem;
    public $uploadPath= 'uploads/images/posts';

    public $author_id;
    public $title;
    public $slug;

    protected $queryString = [
        // Keeping A Clean Query String https://laravel-livewire.com/docs/2.x/query-string#clean-query-string
        'search'      => ['except' => ''],
        'currentPage' => ['except' => 1]
    ];

    private function headerConfig()
    {
        return [
            'image'           => 'Image',
            'title'           => 'Title',
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

    public function getPostallQueryProperty()
    {
        $this->author_id = Auth::id();

        return Post::onlyTrashed()->with('author')->orderBy($this->sortColumn, $this->sortDirection)
        ->search(trim($this->search)); //search menggunakan scopeSearch di model
    }

    public function getPostallProperty()
    {
        return $this->postallQuery->paginate($this->paginate);
    }

    public function updatedSelectPost($value)
    {
        if ($value) {
            $this->checked = $this->postall->pluck('id')->map(fn ($item) => (string) $item)->toArray();
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
        $this->checked = $this->postallQuery->pluck('id')->map(fn ($item) => (string) $item)->toArray();
    }

    public function isChecked($id)
    {
        return in_array($id, $this->checked);
    }


    public function selectItem($itemId, $action)
    {
        $this->statusUpdate = false;

        $this->selectedItem = $itemId;
        if ($action == 'forcedelete') {
            // This will show the modal in the frontend
            $this->dispatch('openDeleteModaltrash');
        } elseif ($action == 'restore')  {
            // This will show the modal in the frontend
            $this->dispatch('openRestoreModal');
        }
    }

    // Delete Single Record
    public function force_delete()
    {
        $post = Post::onlyTrashed()->find($this->selectedItem);

        if ($post->image) {
            $this->removeImage($post->image);
        }

        $post->forceDelete();

        // Sweet alert
        $this->dispatch('swal:modal', [
            'title' => 'Deleted Success!',
            'timer' => 4000,
            'icon'  => 'success',
            'text'  => 'Post was force deleted',
            // 'toast'=>true, // Jika mau menggunakan toas
            // 'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton' => true,
            'showCancelButton'  => false,
        ]);

        $this->dispatch('refreshParent');
        // This will hide the modal in the frontend
        $this->dispatch('closeDeleteModaltrash');

        return redirect()->route('backend.posts.index')->with('danger', 'Data was force delete');

    }

    public function restore()
    {
        $post = Post::withTrashed()->findOrFail($this->selectedItem);

        $post->restore();
        // Sweet alert
        $this->dispatch('swal:modalrestore', [
            'title' => 'Restore Success!',
            'timer' => 4000,
            'icon'  => 'success',
            'text'  => 'Post was restore',
            // 'toast'=>true, // Jika mau menggunakan toas
            // 'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton' => true,
            'showCancelButton'  => false,
        ]);

        // This will hide the modal in the frontend
        $this->dispatch('closeDeleteModaltrash');
        return redirect()->route('backend.posts.index')->with('success', 'Data was restore');

    }

    private function removeImage($image)
    {
        if ( ! empty($image) )
        {
            $imagePath     = $this->uploadPath . '/' . $image;
            $ext           = substr(strrchr($image, '.'), 1);
            $thumbnail     = str_replace(".{$ext}", "_thumb.{$ext}", $image);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;

            $watermark     = str_replace(".{$ext}", "_watermark.{$ext}", $image);
            $watermarkPath = $this->uploadPath . '/' . $watermark;

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
            if (file_exists($watermarkPath)) unlink($watermarkPath);

        }
    }


    public function render()
    {
        return view('livewire.backend.post.trash',[
            'datapostall' => $this->postall,
        ]);
    }
}
