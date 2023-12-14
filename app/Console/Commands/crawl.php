<?php

namespace App\Console\Commands;

use App\Models\Author;
use Illuminate\Console\Command;
use Goutte as Goutte;

class crawl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // BEGIN: ed8c6549bwf9
        $crawler = Goutte::request('GET', 'https://en.wikipedia.org/wiki/List_of_manga_artists');
        // END: ed8c6549bwf9

        // BEGIN: be15d9bcejpp
        $title = $crawler->filter('a[title]')->each(function ($node) {
            return $node->text();
        });
        $title = array_unique($title);
        foreach($title as $key => $value){
            Author::create([
                'AuthorName' => $value
            ]);
        }
        // END: be15d9bcejpp
    }
}