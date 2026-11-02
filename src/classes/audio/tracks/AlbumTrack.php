<?php

namespace iutnc\deefy\audio\tracks;

require_once 'AudioTrack.php';

Class AlbumTrack extends AudioTrack{

    private String $album;
    private int $num_piste;
    private int $annee = 0;

    public function __construct(String $titre, String $chem, String $album, int $num){
        parent::__construct($titre, $chem);
        $this->album = $album;
        $this->num_piste = $num;
    }

    public function setAnnee(int $ann){
        $this->annee = $ann;
    }

    public function __toString(): String {
        return json_encode(get_object_vars($this));
    }
}