<?php

namespace iutnc\deefy\render;

use iutnc\deefy\audio\tracks\AlbumTrack;

Class AlbumTrackRenderer extends Renderer{

    public AlbumTrack $at;

    public function __construct(AlbumTrack $at){
        $this->at = $at;
    }
}