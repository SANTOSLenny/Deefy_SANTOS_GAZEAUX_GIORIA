<?php

namespace iutnc\deefy\audio\lists;

use iutnc\deefy\audio\tracks\AudioTrack;
use iutnc\deefy\exception\InvalidPropertyNameException;

class AudioList{

    protected string $nom;
    protected int $nbpistes;
    protected int $dureetot;
    protected array $liste;
    protected ?int $id = null;

    public function __construct(String $nom, array $liste = []){
        $this->nom = $nom;
        $this->liste = $liste;
        $this->nbpistes = count($liste);

        $totale = 0;
        foreach ($this->liste as $piste) {
            if ($piste instanceof AudioTrack) {
                $totale += $piste->sec;
            }
        }
        $this->dureetot = $totale;
    }

    public function __get(String $att){
        if(property_exists($this,$att)){
            return $this->$att;
        }
        throw new InvalidPropertyNameException("Attribut invalide!");
    }

    public function setId(int $id): void {
    $this->id = $id;
    }
}