<?php
namespace App\Services;

use App\DTOs\QRCodeDTO;
use App\DTOs\QRCodePreviewDTO;
use App\Models\QRCode;
use App\Repositories\Contracts\QRCodeRepoInterface;
use App\Services\Contracts\QRCodeServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
        $dto->content,
        $dto->size,
        $dto->foregroundColor,
        $dto->backgroundColor
    );

    $filename = Str::slug($dto->title) . '-' . time() . '.png';
    $path = 'qrcodes/' .$filename;
    Storage::disk('public')->put($path, $png);
    return $this->qrCodeRepository->create($dto, $path);

}

public function getHistory(int $perPage, ?string $search): LengthAwarePaginator
{
    return $this->qrCodeRepository->paginate($perPage, $search);

}
public function download(QrCode $qrCode): string
{
    $this->qrCodeRepository->incrementDownload($qrCode);
    return storage_path('app/public/' . $qrCode->qr_path);
}
public function delete(QrCode $qrCode): void
{
    Storage::disk('public')->delete($qrCode->qr_path);
    $this->qrCodeRepository->delete($qrCode);
}
private function buildQRCode(
    string $content,
    int $size,
    string $fg,
    string $bg
): string {
    $fg = ltrim($fg, '#');
    $bg = ltrim($bg, '#');
    return QrCodeGenerator::format('png')
    ->size($size)
    ->color(
        hexdec(substr($fg, 0, 2)),
        hexdec(substr($fg, 2, 2)),
        hexdec(substr($fg, 4, 2))
    )
    ->backgroundColor(
        hexdec(substr($bg, 0, 2)),
        hexdec(substr($bg, 2, 2)),
        hexdec(substr($bg, 4, 2))
    )
    ->generate($content);
}
}
   
