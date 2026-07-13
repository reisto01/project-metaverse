<?php

namespace Database\Seeders;

use App\Models\maps_metaverse;
use App\Models\prop_metaverse;
use Illuminate\Database\Seeder;

class DemoMarketplaceSeeder extends Seeder
{
    public function run(): void
    {
        $lands = [
            [
                'title' => 'Emerald Valley Parcel',
                'owner' => 'MetaLand Studio',
                'description' => 'A spacious green parcel prepared for social spaces, games, and branded experiences.',
                'url' => 'https://example.com/',
                'image' => '/img/kit/pro/land1.jpg',
                'price' => 1.25,
            ],
            [
                'title' => 'Neon District Plot',
                'owner' => 'Voxel Collective',
                'description' => 'A central city plot suited to galleries, events, and interactive storefronts.',
                'url' => 'https://example.com/',
                'image' => '/img/kit/pro/land2.png',
                'price' => 2.40,
            ],
            [
                'title' => 'Sandbox Frontier',
                'owner' => 'Digital Horizons',
                'description' => 'An open-world parcel with room for exploration and community-built adventures.',
                'url' => 'https://example.com/',
                'image' => '/img/Sandbox-Metaverse.jpg',
                'price' => 3.10,
            ],
        ];

        $properties = [
            [
                'title' => 'Aurora Virtual Villa',
                'owner' => 'Meta Homes',
                'description' => 'A modern virtual villa designed for private meetings and digital showcases.',
                'url' => 'https://example.com/',
                'image' => '/img/home-decor-1.jpg',
                'price' => 0.85,
            ],
            [
                'title' => 'Creator Loft',
                'owner' => 'Voxel Collective',
                'description' => 'A flexible creator loft for exhibitions, workshops, and community gatherings.',
                'url' => 'https://example.com/',
                'image' => '/img/home-decor-2.jpg',
                'price' => 1.15,
            ],
            [
                'title' => 'Skyline Event Space',
                'owner' => 'Digital Horizons',
                'description' => 'A high-rise event property with panoramic views and customizable interiors.',
                'url' => 'https://example.com/',
                'image' => '/img/home-decor-3.jpg',
                'price' => 1.75,
            ],
        ];

        foreach ($lands as $land) {
            maps_metaverse::updateOrCreate(
                ['title' => $land['title']],
                $land + ['is_deleted' => 1],
            );
        }

        foreach ($properties as $property) {
            prop_metaverse::updateOrCreate(
                ['title' => $property['title']],
                $property + ['is_deleted' => 1],
            );
        }
    }
}
