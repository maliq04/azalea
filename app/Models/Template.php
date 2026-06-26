<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = [
        'name',
        'category',
        'price',
        'badge',
        'html_path',
        'thumbnail_path',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price'     => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Price formatted as "Rp 149k" or "Free".
     */
    public function formattedPrice(): string
    {
        if ($this->price === 0) {
            return 'Free';
        }

        return 'Rp ' . number_format($this->price / 1000, 0, '.', '') . 'k';
    }

    /**
     * Public URL to the thumbnail (or null if not set).
     */
    public function thumbnailUrl(): ?string
    {
        if (!$this->thumbnail_path) {
            return null;
        }

        return asset('storage/' . $this->thumbnail_path);
    }
}
