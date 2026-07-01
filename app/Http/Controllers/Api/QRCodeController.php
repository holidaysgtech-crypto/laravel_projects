<?php

namespace App\Http\Controllers\Api;

use App\DTOs\QRCodeDTO;
use App\DTOs\QRCodePreviewDTO;
use App\Http\Resources\QRCodeResource;
use App\Http\Requests\PreviewQRCodeRequest;
use App\Http\Requests\StoreQRCodeRequest;
use App\Models\QRCode;
use App\Services\Contracts\QRCodeServiceInterface;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class QRCodeController extends Controller
{
    public function __construct(private readonly QRCodeServiceInterface  $qrCodeService){}

    public function dashboard(): JsonResponse
    {
        $stats = $this->qrCodeService->getDashboardStats();
        return response()->json([
            'success' => true,
            'data' => $stats,
        ]);
    }

    public function preview(PreviewQRCodeRequest $request): JsonResponse{
        $dto = QRCodePreviewDTO::fromArray($request->validated());
        $image = $this->qrCodeService->generatePreview($dto);
        return response()->json([
            'success' => true,
            'data' => ['image' => $image],
        ]);
    }
    public function store(StoreQRCodeRequest $request): JsonResponse
    {
        $dto = QRCodeDTO::fromArray($request->validated());
        $qr_code = $this->qrCodeService->store($dto);
        return response()->json([
            'success' => true,
            "message" => "QR Code saved Successfully",
            'data' => new QRCodeResource($qrCode),
        ], 201);
    }
    public function history(Request $request): JsonResponse
    {
        $qrCodes= $this->qrCodeService->getHistory(12, $request->search);
        return response()->json([
            'success' => true,
            'data' => QRCodeResource::collection($qrCodes),
            'meta' => [
                'current_page' => $qrCodes->currentPage(),
                'last_page' => $qrCodes->lastPage(),
                'per_page' => $qrCodes->perPage(),
                'total' => $qrCodes->total()
            ],
        ]);
    }
    public function download(QRCode $qrCode)
    {
        $filePath = $this->qrCodeService->download($qrCode);
        return response()->download($filePath);
    }
    public function destroy (QRCode $qrCode): JsonResponse
    {
        $this->qrCodeService->delete($qrCode);
        return response()-> json([
            'success' => true,
            'message' => "QR Code deleted  successfully",
        ]);
    }
}
