<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use Livewire\Attributes\Session;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class UserTable extends Component
{
    use WithFileUploads;
    #[Url]
    // #[Session]
    // #[Session(key: 'search')] 
    public $search = '';

    protected $listeners = ["userStore" => "render", "userDelete" => "userDeleted"];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // Propertis users
    // #[Locked]
    public $user_id;
    public $name;
    public $email;
    public $foto;
    public $foto_old;

    public function placeholder()
    {
        return <<<'HTML'
        <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
            <!-- Loading spinner... -->
            <svg width="100" height="100" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><style>.spinner_EUy1{animation:spinner_grm3 1.2s infinite}.spinner_f6oS{animation-delay:.1s}.spinner_g3nX{animation-delay:.2s}.spinner_nvEs{animation-delay:.3s}.spinner_MaNM{animation-delay:.4s}.spinner_4nle{animation-delay:.5s}.spinner_ZETM{animation-delay:.6s}.spinner_HXuO{animation-delay:.7s}.spinner_YaQo{animation-delay:.8s}.spinner_GOx1{animation-delay:.9s}.spinner_4vv9{animation-delay:1s}.spinner_NTs9{animation-delay:1.1s}.spinner_auJJ{transform-origin:center;animation:spinner_T3O6 6s linear infinite}@keyframes spinner_grm3{0%,50%{animation-timing-function:cubic-bezier(.27,.42,.37,.99);r:1px}25%{animation-timing-function:cubic-bezier(.53,0,.61,.73);r:2px}}@keyframes spinner_T3O6{0%{transform:rotate(360deg)}100%{transform:rotate(0deg)}}</style><g class="spinner_auJJ"><circle class="spinner_EUy1" cx="12" cy="3" r="1"/><circle class="spinner_EUy1 spinner_f6oS" cx="16.50" cy="4.21" r="1"/><circle class="spinner_EUy1 spinner_NTs9" cx="7.50" cy="4.21" r="1"/><circle class="spinner_EUy1 spinner_g3nX" cx="19.79" cy="7.50" r="1"/><circle class="spinner_EUy1 spinner_4vv9" cx="4.21" cy="7.50" r="1"/><circle class="spinner_EUy1 spinner_nvEs" cx="21.00" cy="12.00" r="1"/><circle class="spinner_EUy1 spinner_GOx1" cx="3.00" cy="12.00" r="1"/><circle class="spinner_EUy1 spinner_MaNM" cx="19.79" cy="16.50" r="1"/><circle class="spinner_EUy1 spinner_YaQo" cx="4.21" cy="16.50" r="1"/><circle class="spinner_EUy1 spinner_4nle" cx="16.50" cy="19.79" r="1"/><circle class="spinner_EUy1 spinner_HXuO" cx="7.50" cy="19.79" r="1"/><circle class="spinner_EUy1 spinner_ZETM" cx="12" cy="21" r="1"/></g></svg>
        </div>
        HTML;
    }

    public function render()
    {
        sleep(1);
        $users = User::all();
        return view('livewire.user-table', [
            'users' => User::where('name', 'like', '%' . $this->search . '%')->paginate(4), // Paginasi, 4 item per halaman
        ]);
    }

    // panggil lifscyle livewire
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
        $this->user_id = $id;

        $user = User::find($id);
        $this->dispatch('userDeleteConfirmation', user: $user);
    }

    public function userDeleted()
    {
        user::find($this->user_id)->delete();
        session()->flash('success', 'User Berhasil Dihapus');
    }

    public function download($id)
    {
        $user = User::find($id);
        $filePath = storage_path('app/public/' . $user->foto);
        return response()->download($filePath, $user->name . '.jpg');
    }
}
