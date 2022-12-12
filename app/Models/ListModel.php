<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListModel extends Model
{

    use HasFactory;
    protected $table = 'lists';
    protected $fillable = ['list_name', 'done'];

    static function doneLIst(int $idList)
    {
        return self::find($idList)->update(['done' => true]);
    }
    static function storeLIst(array $dataNewList)
    {
        return self::create($dataNewList);
    }
    static function deleteLIst(int $idList)
    {
        return self::find($idList)->delete();
    }
    static function updateList($idList, $listBaru)
    {
        return self::find($idList)->update(['list_name' => $listBaru]);
    }
}
