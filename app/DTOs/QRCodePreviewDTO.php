<?php
namespace App\DTOs;
class QRCodePreviewDTO
{
    public function __construct(
        public readonly string $content,
        public readonly int $size,
        public readonly string $foreground_color,
        public readonly string $background_color,

    ){}
    public static function fromArray(array $data): self
    {
        return new self(
            content: $data['content'],
            size: (int)$data['size'],
            foreground_color: $data['foreground_color'] ?? '#000000',
            background_color: $data['background_color'] ?? '#FFFFFF',
        );
    }
}