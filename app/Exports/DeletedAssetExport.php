<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DeletedAssetExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data){
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            'id',
            'nomor seri',
            'merek',
            'lokasi simpan',
            'divisi',
            'jenis aset'
        ];
    }
}
