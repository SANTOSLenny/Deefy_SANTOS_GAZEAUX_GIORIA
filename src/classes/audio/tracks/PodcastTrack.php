<?php

namespace iutnc\deefy\audio\tracks;

require_once 'AudioTrack.php';

Class PodcastTrack extends AudioTrack{

    private string $date;

    public function __construct(string $titre, string $chem){
        parent::__construct($titre, $chem);
    }

    public function setDate(string $date){
        $this->date = $date;
    }

    public function getDate(): string {
    return $this->date;
    }
}