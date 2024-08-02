<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class UserEdit extends Component
{
    use WithFileUploads;
    // Propertis users
    public $user_id;
    public $name;
    public $email;
    public $foto;
    public $foto_old;

    public function mount($user)
    {
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->foto_old = $user->foto;
    }
    public function render()
    {
        return view('livewire.user-edit');
    }

    public function update()
    {
        $this->validate([
            // required harus terisi
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$this->user_id,
            'foto' =>'nullable|image|max:1024'
        ]);

        // klalau error dan user brsal dari app/model
        // User::where('id', $this->user_id)->update([
        //     'name' => $this->name,
        //     'email' => $this->email,
        //     'foto' => $this->foto,

        $user = User::find($this->user_id);

        if ($this->foto) {
            $photoPath = $this->foto->store('foto', 'public');
            $user->foto = $photoPath;
        }

        // kita panggil properti kita name agar hilang
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'foto' => $user->foto,

        ]);

        $this->name = NULL;
        $this->email = NULL;
        $this->foto= NULL;


        // nanti akan memanggil ketika berhasil
        redirect()->route('users.home')->with('success','User Berhasil Diupdate');
    }
}