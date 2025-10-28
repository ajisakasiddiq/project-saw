<?php

namespace App\Imports;

use App\Models\College;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MhsImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // dd($collection);
        $index = 1;

        foreach ($collection as $row) {
            if ($index > 1) {
                $data = new College();
                $data->nim = !empty($row[0]) ? $row[0] : '';
                $data->nama = !empty($row[1]) ? $row[1] : '';
                $data->id_jurusan = !empty($row[2]) ? $row[2] : '';
                $data->id_prodi = !empty($row[3]) ? $row[3] : '';
                $data->angkatan = !empty($row[4]) ? $row[4] : '';
                $data->semester = !empty($row[5]) ? $row[5] : '';
                $data->jalur_masuk = !empty($row[6]) ? $row[6] : '';
                $data->ukt_sekarang = !empty($row[7]) ? $row[7] : '';
                $data->ponsel = !empty($row[8]) ? $row[8] : '';
                $data->alamat = !empty($row[9]) ? $row[9] : '';
                $data->save();
            }

            $index++;
        }
    }
}
