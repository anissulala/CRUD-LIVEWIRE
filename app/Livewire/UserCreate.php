<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Session\Session;
use Livewire\WithFileUploads;

class UserCreate extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $password;
    public $foto;

    public function render()
    {
        
        return view('livewire.user-create');
    }

    public function store()
    {
        sleep(2);
        $this->validate([ 
            // required harus terisi
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'foto' => 'required|image|max:1024',
        ]);

        $photoPath = $this->foto->store('foto', 'public');

        // klalau error dan user brsal dari app/model
        User::create([  
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'foto' => $photoPath,
        ]);

        //name agar hilang
        $this->name = NULL;
        $this->email = NULL;
        $this->password = NULL;
        $this->foto = NULL;

        // nanti akan memanggil ketika berhasil
        Session()->flash('success','User Berhasil Dibuat');

        //event ketika sudah menyelesaikan semua,lalu membuat trigger 
        $this->dispatch('userStore');

         // nanti akan memanggil ketika berhasil
        //  redirect()->route('users.home')->with('success','User Berhasil Ditambahkan');
        
    }
}
 