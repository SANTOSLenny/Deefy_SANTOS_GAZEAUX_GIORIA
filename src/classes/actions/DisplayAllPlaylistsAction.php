<?php

namespace iutnc\deefy\actions;

use iutnc\deefy\repository\DeefyRepository;

class DisplayAllPlaylistsAction extends Action {

    public function execute(): string {

        $repo = DeefyRepository::getInstance();
        $playlists = $repo->findAllPlaylists();

        $html = "<h1>Mes playlists</h1>";

        foreach ($playlists as $playlist) {
            $nom = htmlspecialchars($playlist->nom);
            $id = $playlist->id;

            $html .= "<p><a href='?action=select-playlist&id=$id'>$nom</a></p>";
        }

        return $html;
    }
}