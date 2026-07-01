<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QRCode extends Model
{
    // Table name
    protected $table = 'qr_codes';

    protected $fillable = [
        'title',
        'content',
        'qr_path',
        'size',
        'foreground_color',
        'background_color',
        'download_count',
    ];
    protected $casts = [
        'size' => 'integer',
        'download_count' => 'integer',
    ];
}
