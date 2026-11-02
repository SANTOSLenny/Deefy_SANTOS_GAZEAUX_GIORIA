<?php

namespace iutnc\deefy\audio\tracks;

use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\exception\InvalidPropertyValueException;

Class AudioTrack{

    protected String $titre;
    protected String $artiste = "";
    protected String $genre = "";
    protected int $sec = 0;
    protected String $nom;
    protected ?int $id = null;

    public function __construct(string $titre, string $chem){
        $this->titre = $titre;
        $this->nom = $chem;
    }

    public function __get(string $att){
        if(property_exists($this, $att)){
            return $this->$att;
        }
        throw new InvalidPropertyNameException("Attribut invalide : " . $att);
    }

    public function setSec(int $sec){
        if($sec < 0){
            throw new InvalidPropertyValueException("Durée invalide ! (>0");
        }
        $this->sec = $sec;
    }

    public function setArtiste(string $art){
        $this->artiste = $art;
    }

    public function setGenre(string $genre){
        $this->genre = $genre;
    }

    public function __toString(): string {
        return json_encode(get_object_vars($this));
    }

    public function setId(int $id): void {
    $this->id = $id;
    }
}