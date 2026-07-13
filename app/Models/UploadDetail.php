<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadDetail extends Model
{
    protected $table = 'upload_details';

    protected $primaryKey = 'iddetail';

    public $timestamps = true;

    protected $fillable = [

        'upload_idupload',
        'sheet_name',
        'row_index',
        'row_data'

    ];

    protected $casts = [

        'row_data' => 'array'

    ];

    public function upload()
    {
        return $this->belongsTo(
            Upload::class,
            'upload_idupload',
            'idupload'
        );
    }
}