<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class UserTable extends Component
{
    use WithFileUploads;
    #[Url]
    public $search = '';

    protected $listeners = ["userStore" => "render"];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // Propertis users
    public $user_id;
    public $name;
    public $email;
    public $foto;
    public $foto_old;

    public function render()
    {
        $users = User::all();
        return view('livewire.user-table', [
            'users' => User::where('name', 'like', '%' . $this->search . '%')->paginate(4), // Paginasi, 4 item per halaman
        ]);
    }

    // panggil sesuai properti yang anda buat
    public function updatingSearch()
    {
        // untuk mengembalikan cari ke page awal
        $this->resetPage();
    }

    public function userEdit($user)
    {
        $this->user_id = $user['id'];
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->foto_old = $user['foto'];
    }

    public function userUpdate()
    {
        $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'foto' => 'nullable|image|max:2048',
        ]);

        $user = User::find($this->user_id);

        if ($this->foto) {
            $photoPath = $this->foto->store('foto', 'public');
            $user->foto = $photoPath;
        }

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'foto' => $user->foto,
        ]);

        $this->user_id = NULL;
        $this->name = NULL;
        $this->email = NULL;
        $this->foto = NULL;
        $this->foto_old = NULL;
        $this->dispatch('userStore');

        Session()->flash('success', 'User Berhasil Diubah');
    }


    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        session()->flash('success', 'User Berhasil Dihapus');
    }
}
