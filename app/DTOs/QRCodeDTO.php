<?php

namespace App\DTOs;
class QRCodeeDTO
{
    public function __construct(
        public readonly string $title,
        public readonly string $content,
        public readonly int $size,
        public readonly string $foreground_color,
        public readonly string $background_color,
    ){}
    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'],
            content: $data['content'],
            size: (int)$data['size'],
            foreground_color: $data['foreground_color'],
            background_color: $data['background_color'],
        );
    }
}
