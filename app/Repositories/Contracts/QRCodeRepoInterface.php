<?php
namespace App\Repositories\Contracts;
use App\DTOs\QRCodeDTO;
use App\Models\QRCode;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
interface QRCodeRepoInterface
{
    // Get all QR codes 
    public function getAll():Collection;
    
    // Find a QR code by ID
    public function findById(int $id): ?QRCode;
    
    // Paginate QR codes
    public function paginate(int $perPage, ?string $search): LengthAwarePaginator;
    
    // Create a new QR code
    public function create(QRCodeDTO $dto, string $qrPath): QRCode;
    
    // Increment the download count for a QR code
    public function incrementDownloadCount(QRCode $qrCode): void;

    // Total count of QR codes
    public function totalCount(): int;

    // Delete a QR code
    public function delete(QRCode $qrCode): void;

    //Total downloads
    public function totalDownloads(): int;

    // recent Downloads
    public function recent(int $limit): Collection;


}
