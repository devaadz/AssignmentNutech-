<?php
namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ProductsExport implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting
{
    protected $search;
    protected $categoryId;

    public function __construct($search = null, $categoryId = null)
    {
        $this->search = $search;
        $this->categoryId = $categoryId;
    }

    // Mengambil data produk untuk ekspor
    public function collection()
    {
        $query = Product::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->categoryId) {
            $query->where('category_id', $this->categoryId);
        }
        $data = $query->get(['name', 'category_id', 'purchase_price', 'sale_price', 'stock']);

            // Ganti category_id dengan nama kategori
            $data->transform(function ($product) {
                $product->category_id = $product->category->name ?? 'Unknown'; // Ganti category_id dengan nama kategori
                unset($product->category); // Hapus relasi category (jika tidak dibutuhkan)
                return $product;
            });

            return $data;

        }

    // Menambahkan Heading pada Excel
    public function headings(): array
    {
        return [
            'Product Name',
            'Category',
            'Harga barang',
            'Harga Jual',
            'Stok'
        ];
    }

    // Menambahkan Styling pada Excel (Misalnya, bold header dan garis)
    public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet)
    {
        // Mengatur header
        $sheet->getStyle('A1:C1')->getFont()->setBold(true); // Bold pada header
        $sheet->getStyle('A1:C1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Rata tengah

        // Menambahkan border pada seluruh tabel
        $sheet->getStyle('A1:C' . (count($this->collection()) + 1))
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        return [
            // Menentukan baris pertama (header)
            1    => ['font' => ['bold' => true]], // Bold pada baris pertama (header)
        ];
    }

    // Mengatur format kolom (misalnya, format harga dengan dua desimal)
    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER_00, // Format harga dengan dua desimal
        ];
    }
}
