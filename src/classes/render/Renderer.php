<?php

namespace iutnc\deefy\render;

Class Renderer{

    public function render(int $selector){
        switch($selector){
            default:
            case 1:
                return "<div class=\"track-compact\">{$this->at->__get("titre")}</div>";
                break;
            case 2:
                return "
                    <div class=\"track-long\">
                        <h3>{$this->at->__get("titre")}</h3>
                        <audio controls src=\"{$this->at->__get("nom")}\"></audio>
                    </div>
                ";
                break;
        }
    }

}