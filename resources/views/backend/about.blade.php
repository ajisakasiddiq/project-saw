@extends('backend.layouts.app')
@section('title', 'Tentang SAW | SPK-SAW')
{{-- @endsection --}}
@section('content')
<div class="container-fluid grid-margin stretch-card">
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
 <h1 class="h3 mb-0 text-gray-800">Tentang SAW</h1>
 </div>
 <div class="card">
 <div class="card-body">
 <h2 class="ui header">Simple Additive Weighting (SAW)</h2>

 <p><strong>Simple Additive Weighting (SAW)</strong>, sering juga disebut metode penjumlahan terbobot, adalah salah satu metode yang paling banyak digunakan dalam masalah **Multiple Attribute Decision Making (MADM)**. Konsep dasar SAW adalah mencari penjumlahan terbobot dari kinerja (rating) setiap alternatif pada semua atribut (kriteria).</p>
 
 <p>Metode SAW memerlukan proses normalisasi matriks keputusan ke suatu skala yang dapat diperbandingkan dengan semua rating alternatif yang ada. Hasil akhir dari metode SAW adalah nilai preferensi (V) untuk setiap alternatif. Nilai preferensi yang lebih besar menunjukkan bahwa alternatif tersebut lebih baik, dan alternatif dengan nilai tertinggi akan dipilih sebagai solusi terbaik.</p>

 <p>Langkah-langkah utama dalam metode SAW meliputi:</p>

 <ol class="ui list">
  <li>Menentukan kriteria-kriteria yang akan dijadikan acuan pengambilan keputusan.</li>
  <li>Membuat matriks keputusan berdasarkan kriteria dan alternatif.</li>
  <li>Melakukan normalisasi matriks keputusan sesuai dengan jenis kriteria (benefit atau cost).</li>
  <li>Menghitung nilai preferensi (V) dengan mengalikan matriks ternormalisasi dengan bobot kriteria yang telah ditentukan.</li>
  <li>Menentukan peringkat alternatif berdasarkan nilai V tertinggi.</li>
 </ol>

 <br>

 
</tbody>
</table>
 </div> 
</div>
 </div>
@endsection