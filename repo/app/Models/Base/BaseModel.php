<?php
namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * Generate nomor otomatis berdasarkan prefix dan kolom nomor
     * 
     * @param string $prefix Misalnya: 'PSN', 'INV', 'ORD'
     * @param string $column Kolom yang digunakan sebagai penomoran, default: 'no'
     * @param int $length Panjang angka, default: 5
     * @return string Nomor yang sudah diformat
     */
    public static function generateNo(): string
    {
        $prefix = static::getNoPrefix();
        $column = static::getNoColumn();
        $length = static::getNoLength();

        $last = static::orderBy($column, 'desc')->first();

        if ($last && preg_match("/$prefix-(\d+)/", $last->$column, $matches)) {
            $lastNumber = (int) $matches[1];
        } else {
            $lastNumber = 0;
        }

        $newNumber = $lastNumber + 1;
        return $prefix . '-' . str_pad($newNumber, $length, '0', STR_PAD_LEFT);
    }

    /**
     * Method ini bisa di-override oleh model anak
     */
    protected static function getNoPrefix(): string
    {
        return 'NO';
    }

    protected static function getNoColumn(): string
    {
        return 'no';
    }

    protected static function getNoLength(): int
    {
        return 5;
    }
}
