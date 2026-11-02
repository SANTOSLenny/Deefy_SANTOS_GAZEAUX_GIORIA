<?php

namespace iutnc\deefy\render;

use iutnc\deefy\audio\lists\AudioList;

class AudioListRenderer extends  renderer{

    private AudioList $audiolist;

    public function __construct(AudioList $audiolist){
        $this->audiolist = $audiolist;
    }

    public function render(int $selector = 1) : string {
        $html = "<div class=\"audio-list\">";
        
        $html .= "<h2>" . $this->audiolist->nom . "</h2>";
        $html .= "<ul class=\"track-list\">";

        foreach ($this->audiolist->liste as $piste) {
            $html .= "<li>";
            $html .= $piste->titre;
            $html .= "</li>";
        }

        $html .= "</ul>";

        $html .= "<div class=\"audio-list-footer\">";
        $html .= "<p>Nombre de pistes : " . $this->audiolist->nbpistes . "</p>";
        $html .= "<p>Durée totale : " . $this->audiolist->dureetot . " secondes</p>";
        $html .= "</div>";

        $html .= "</div>";

        return $html;
    }
}