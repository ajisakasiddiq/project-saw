@component('mail::message')

<p>Halo {{ $user->nama }}, Klik tombol di bawah ini untuk melakukan verifikasi akun.</p>

@component('mail::button', ['url' => url('verif/'. $user->hash)])
    Verifikasi Akun
@endcomponent

<p>Terima Kasih</p>
{{ config('app.name') }}
@endcomponent