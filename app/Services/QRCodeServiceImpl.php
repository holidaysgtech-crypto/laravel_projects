<?php
namespace App\Services;

use App\DTOs\QRCodeDTO;
use App\DTOs\QRCodePreviewDTO;
use App\Models\QRCode;
use App\Repositories\Contracts\QRCodeRepositoryInterface;
use App\Services\Contracts\QRCodeServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminated\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QrCodeGenerator;


class QRCodeServiceImpl implements QRCodeServiceInterface
{
    public function __construct(
        private readonly QRCodeRepositoryInterface $qrCodeRepository
        ){}

        public function getDashboardStats(): array
    {
        return [
            'total_qr_codes'  => $this->qrCodeRepository->totalCount(),
            'total_downloads' => $this->qrCodeRepository->totalDownloads(),
            'recent_qr_codes' => $this->qrCodeRepository->recent(6),
        ];
    }
public function generatePreview(QRCodePreviewDTO $dto): string
{
    $png = $this->buildQRCode(
        $dto->content,
        $dto->size,
        $dto->foregroundColor,
        $dto->backgroundColor
        );
        return 'data:image/png;base64,' .base64_encode($png);
}
public function store(QRCodeDTO $dto): Qrcode
{
    $png = $this->buildQRCode(
        $dto = content,
        $dto->size,
        $dto->foregroundColor,
        $dto->backgroundColor
    );

    $filename = Str::slug($dto->title) . '-' . time() . '.png';
    $path = 'qrcodes/' .$filename;

}
}
   
