<?php

namespace iutnc\deefy\dispatch;

use iutnc\deefy\actions\AddPlaylistAction;
use iutnc\deefy\actions\AddPodcastTrackAction;
use iutnc\deefy\actions\DefaultAction;
use iutnc\deefy\actions\DisplayPlaylistAction;
use iutnc\deefy\actions\AddUserAction;
use iutnc\deefy\actions\DisplayAllPlaylistsAction;

class Dispatcher{

    private string $action;

    public function __construct()
    {
        $this->action = $_GET["action"] ?? "default";
    }

    public function run(): void{

    switch($this->action){
        case "playlist":
            $action = new DisplayPlaylistAction();
            break;    
        
        case "add-playlist":
            $action = new AddPlaylistAction();
            break;
        
        case "add-track":
            $action = new AddPodcastTrackAction();
            break;
        
        case "add-user":
            $action = new AddUserAction();
            break;

        case "all-playlists":
                $action = new DisplayAllPlaylistsAction();
                break;
        
        case "default":
        default:
            $action = new DefaultAction();
            break;
    }

    $html = $action->execute();

    $this->renderPage($html);
    }

private function renderPage(string $html): void {

    $page = <<<HTML
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <title>Deefy</title>
    </head>

    <body>

        <h1>Deefy</h1>

        <nav>
            <a href="?action=default">Accueil</a>
            <a href="?action=add-user">Inscription</a>
            <a href="?action=add-playlist">Créer une playlist</a>
            <a href="?action=all-playlists">Mes playlists</a>
        </nav>

        <main>
            $html
        </main>

    </body>
    </html>
    HTML;

    echo $page;
}
}