<?php

namespace App\Helpers;

use App\Models\Setting;

class SEO
{
    public static function renderMetaTags(?string $title = null, ?string $description = null, ?string $image = null, ?string $url = null): string
    {
        $siteName = Setting::getValue('site_name', 'R2PROJECT');
        $title = $title ? "$title | $siteName" : Setting::getValue('meta_title', $siteName);
        $description = $description ?? Setting::getValue('meta_description', 'Automatización de procesos digitales');
        $url = $url ?? request()->url();

        $tags = '';

        $tags .= '<title>' . e($title) . '</title>';
        $tags .= "\n";
        $tags .= '<meta name="description" content="' . e($description) . '">';
        $tags .= "\n";

        $tags .= '<meta property="og:title" content="' . e($title) . '">';
        $tags .= "\n";
        $tags .= '<meta property="og:description" content="' . e($description) . '">';
        $tags .= "\n";
        $tags .= '<meta property="og:url" content="' . e($url) . '">';
        $tags .= "\n";
        $tags .= '<meta property="og:type" content="website">';
        $tags .= "\n";
        $tags .= '<meta property="og:site_name" content="' . e($siteName) . '">';
        $tags .= "\n";

        if ($image) {
            $tags .= '<meta property="og:image" content="' . e($image) . '">';
            $tags .= "\n";
        }

        $tags .= '<meta name="twitter:card" content="summary_large_image">';
        $tags .= "\n";
        $tags .= '<meta name="twitter:title" content="' . e($title) . '">';
        $tags .= "\n";
        $tags .= '<meta name="twitter:description" content="' . e($description) . '">';
        $tags .= "\n";

        if ($image) {
            $tags .= '<meta name="twitter:image" content="' . e($image) . '">';
            $tags .= "\n";
        }

        $tags .= '<link rel="canonical" href="' . e($url) . '">';
        $tags .= "\n";

        return $tags;
    }

    public static function renderJsonLd(array $extra = []): string
    {
        $siteName = Setting::getValue('site_name', 'R2PROJECT');
        $description = Setting::getValue('meta_description', 'Automatización de procesos digitales');
        $url = config('app.url');

        $schema = array_merge([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $siteName,
            'description' => $description,
            'url' => $url,
        ], $extra);

        if ($email = Setting::getValue('email')) {
            $schema['contactPoint'] = [
                '@type' => 'ContactPoint',
                'email' => $email,
                'contactType' => 'sales',
            ];
        }

        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
    }
}
