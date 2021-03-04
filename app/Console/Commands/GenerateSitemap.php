<?php

namespace App\Console\Commands;

use App\Models\Slug;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemapIndex = SitemapIndex::create();
        Slug::select('owner')->groupBy('owner')->get()->each(function(Slug $slug) use ($sitemapIndex){
            $sitemap =  Sitemap::create();
            Slug::where('owner','=',$slug->owner)->get()->each(function(Slug $slug) use ($sitemap){
                if($slug->owner=='page') $sitemap->add(Url::create('/'));
                elseif($slug->no_index==0) $sitemap->add('/'.$slug->slug);
            });
            $sitemap->writeToFile(public_path($slug->owner.'-sitemap.xml'));
            $sitemapIndex->add('/'.$slug->owner.'-sitemap.xml');
        });
        $sitemapIndex->writeToFile(public_path('sitemap_index.xml'));
    }
}
