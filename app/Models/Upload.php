<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $table = 'uploads';

    protected $primaryKey = 'idupload';

    public $timestamps = true;

    protected $fillable = [
        'user_iduser',
        'nama_file',
        'nama_asli',
        'file_path',
        'total_data',
        'status',
        'generated_file'
    ];

    public function details()
    {
        return $this->hasMany(
            UploadDetail::class,
            'upload_idupload',
            'idupload'
        );
    }
}