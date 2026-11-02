<?php

namespace iutnc\deefy\actions;

use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\repository\DeefyRepository;

class AddPlaylistAction extends Action {

    public function execute(): string {

        if($this->http_method === "GET"){

            return <<<HTML
            <h1>Créer une playlist</h1>
            <form method="post" action="?action=add-playlist">
                <label>Nom de la playlist :</label>
                <input type="text" name="nom">
                <button type="submit">Créer</button>
            </form>
        HTML;
        }

else {
    $nom = trim($_POST["nom"] ?? "");

    if ($nom === "") {
        return "<p>Le nom de la playlist ne peut pas être vide.</p>";
    }

    if (mb_strlen($nom) > 100) {
        return "<p>Le nom de la playlist est trop long.</p>";
    }

    $playlist = new Playlist($nom);

    $repo = DeefyRepository::getInstance();
    $playlist = $repo->saveEmptyPlaylist($playlist);

    $_SESSION["playlist"] = $playlist;

    $renderer = new AudioListRenderer($playlist);
    $html = $renderer->render(1);

    $html .= '<a href="?action=add-track">Ajouter une piste</a>';

    return $html;
}

    }
}