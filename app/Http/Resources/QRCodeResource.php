<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QRCodeResource extends JsonResource
{
    public function toArray(Request $request): array{

   
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'size' => this->size,
            'foreground_color' => $this->foreground_color,
            'background_color' => $this->background_color,
            'download_count' => $this->download_count,
            'qr_url' => $this->qr_path ? asset('storage/' . $this->qr_path):null,
            'created_at' => $this->created_at->toDateTimeString()



        ];
    }
}
