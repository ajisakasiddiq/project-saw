@component('mail::message')

<p>Halo {{ $user->nama }}, Klik tombol di bawah ini untuk melakukan reset sandi.</p>

@component('mail::button', ['url' => url('ubah/'. $user->hash)])
    Reset Sandi
@endcomponent

<p>Terima Kasih</p>
{{ config('app.name') }}
    
@endcomponent