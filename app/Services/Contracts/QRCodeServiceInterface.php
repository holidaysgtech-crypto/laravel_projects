<?php
namespace App\Services\Contracts;

use App\DTOs\QRCodeDTO;
use App\DTOs\QRCodePreviewDTO;
use App\Models\QRCode;
use Illuminate\Pagination\LengthAwarePaginator;

interface QRCodeServiceInterface
{   
    // Get Dashboard stats 
    public function getDashboardStats(): array;

    //Generate preview- return 
    public function generatePreview(QRCodePreviewDTO $dto): string;

    //store qrcode to db
    public function store(QRCodeDTO $dto):QRCode;

    //get paginated history with optional search
    public function getHistory(int $perPage, ?string $search): LengthAwarePaginator;

    //Download QR
    public function download(QRCode $qrCode): string;

    //delete qr code from db
    public function delete(QRCode $qrCode): void;

}
