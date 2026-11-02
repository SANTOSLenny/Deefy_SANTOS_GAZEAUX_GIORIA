<?php

namespace iutnc\deefy\actions;

class DisplayPlaylistAction extends Action {

    public function execute(): string {

        if (isset($_SESSION["playlist"])) {
            $playlist = $_SESSION["playlist"];

            $html = "<h1>" . $playlist->nom . "</h1>";

            foreach ($playlist->liste as $piste) {
                $html .= "<p>" . $piste->titre . "</p>";
            }

            return $html;
        }

        return "<p>Aucune playlist en session</p>";
    }
}