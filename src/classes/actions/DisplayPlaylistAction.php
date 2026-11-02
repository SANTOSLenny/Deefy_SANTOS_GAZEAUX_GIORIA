<?php

namespace iutnc\deefy\actions;

use iutnc\deefy\render\AudioListRenderer;

class DisplayPlaylistAction extends Action {

    public function execute(): string {

        if (!isset($_SESSION["playlist"])) {
            return "<p>Aucune playlist en session</p>";
        }

        $playlist = $_SESSION["playlist"];

    $renderer = new AudioListRenderer($playlist);
        $html = $renderer->render();
        $html .= "<p><a href=\"?action=add-track\">+ Ajouter une piste à cette playlist</a></p>";

        return $html;
    }
}