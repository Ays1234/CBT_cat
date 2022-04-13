<?php

namespace App\Imports;

use App\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;

class MahasiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Mahasiswa([
            'nim'           => $row[0],
            'foto'          => $row[1],
            'nama'          => $row[2],
            'tanggal_lahir' => $row[3],
            'program_studi' => $row[4],
            'dokumen'       => $row[5],
        ]);
    }
}
