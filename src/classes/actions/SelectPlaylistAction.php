<?php

namespace iutnc\deefy\actions;

use iutnc\deefy\repository\DeefyRepository;

class SelectPlaylistAction extends Action {

    public function execute(): string {

        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

        if (!$id || $id < 1) {
            return "<p>Identifiant de playlist invalide.</p>";
        }

        $repo = DeefyRepository::getInstance();
        $playlist = $repo->findPlaylistById($id);

        if ($playlist === null) {
            return "<p>Playlist introuvable.</p>";
        }

        $_SESSION["playlist"] = $playlist;

        return "<p>Playlist sélectionnée : "
            . htmlspecialchars($playlist->nom)
            . "</p><a href='?action=playlist'>Afficher la playlist</a>";
    }
}