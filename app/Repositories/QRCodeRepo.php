<?php
namespace App\Repositories;
use App\DTOs\QRCodeDTO;
use App\Models\QRCode;
use App\Repositories\Contracts\QRCodeRepoInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class QRCodeRepo implements QRCodeRepoInterface
{
    public function __construct(private readonly QRCode $model)
    {
        
    }
    public function getAll(): Collection
    {
        return $this->model->latest()->get();
    }
    public function findById(int $id): ?QRCode
    {
        return $this->model->find($id);
    }
    public function paginate(int $perPage, ?string $search): LengthAwarePaginator
    {
        $query = $this->model->latest();
        if($search){
            $query->where(function($q) use ($search){
                $q->where('title','like',"%{$search}%")->orWhere('content','like',"%{$search}%");
            });
        }
        return $query->paginate($perPage);
    }
    public function create(QRCodeDTO $dto, string $qrPath): QRCode
    {
        return $this->model->create([
            'title' => $dto->title,
            'content' => $dto->content,
            'size' => $dto->size,
            'foreground_color' => $dto->foreground_color,
            'background_color' => $dto->background_color,
            'qr_path' => $qrPath,
        ]);
    }
    public function incrementDownloadCount(QRCode $qrCode): void
    {
        $qrcode->increment('download_count');

    }
    public function delete(QRCode $qrCode): void
    {
        $qrCode->delete();
    }
    public function totalCount(): int
    {
        return $this->model->count();
    }
    public function totalDownloads(): int
    {
        return (int)$this->model->sum('download_count');
    }
    public function recent(int $limit): Collection
    {
        return $this->model->latest()->take($limit)->get();
    }

}