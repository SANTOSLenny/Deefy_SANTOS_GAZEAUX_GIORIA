<?php

namespace iutnc\deefy\render;

use iutnc\deefy\audio\tracks\PodcastTrack;

Class PodcastTrackRenderer extends Renderer{

    public PodcastTrack $at;

    public function __construct(PodcastTrack $at){
        $this->at = $at;
    }
}