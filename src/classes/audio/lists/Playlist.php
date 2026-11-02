<?php

namespace iutnc\deefy\audio\lists;

use iutnc\deefy\audio\tracks\AudioTrack;

class Playlist extends AudioList {

    public function __construct(string $nom, array $pistes = []) {
        parent::__construct($nom, $pistes);
    }

    public function ajouterPiste(AudioTrack $piste): void {
        $this->liste[] = $piste;
        $this->nbpistes = count($this->liste);
        $this->dureetot += $piste->sec;
    }

    public function supprimerPiste(int $index): void {
        if (isset($this->liste[$index])) {
            $this->dureetot -= $this->liste[$index]->sec;

            unset($this->liste[$index]);

            $this->liste = array_values($this->liste);

            $this->nbpistes = count($this->liste);
        }
    }

    public function ajouterListePistes(array $nvlPistes): void {
        foreach ($nvlPistes as $piste) {
            if ($piste instanceof AudioTrack) {
                $this->ajouterPiste($piste);
            }
        }
    }
}