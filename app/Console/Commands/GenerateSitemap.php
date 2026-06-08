<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap';

    public function handle()
    {
        $sitemap = Sitemap::create();

        $sitemap->add(Url::create('/')
            ->setPriority(1.0)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));

        $sitemap->add(Url::create('/portafolio')
            ->setPriority(0.8)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));

        Project::active()->each(function (Project $project) use ($sitemap) {
            $sitemap->add(Url::create("/portafolio/{$project->slug}")
                ->setPriority(0.6)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setLastModificationDate($project->updated_at));
        });

        $sitemap->writeToDisk('public', 'sitemap.xml');

        $this->info('Sitemap generated successfully.');
    }
}
