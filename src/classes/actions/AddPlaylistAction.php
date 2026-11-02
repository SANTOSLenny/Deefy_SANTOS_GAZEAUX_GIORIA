<?php

namespace iutnc\deefy\actions;

use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\render\AudioListRenderer;

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
            $nom = filter_var(
                $_POST["nom"] ?? "",
                FILTER_SANITIZE_SPECIAL_CHARS
            );

            $playlist = new Playlist($nom);

            $_SESSION["playlist"] = $playlist;

            $renderer = new AudioListRenderer($playlist);

            $html = $renderer->render(1);

            $html .= '<a href="?action=add-track">Ajouter une piste</a>';

            return $html;
        }

    }
}