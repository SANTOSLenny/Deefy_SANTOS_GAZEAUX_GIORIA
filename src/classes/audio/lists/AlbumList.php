<?php

namespace iutnc\deefy\audio\lists;

class AlbumList extends AudioList{

    protected String $artiste;
    protected String $date;

    public function __construct(String $nom, array $liste = []){ 
        parent::__construct($nom,$liste);
    }

    public function setArtisteAlbum(string $artiste): void {
        $this->artisteAlbum = $artiste;
    }

    public function setDateSortie(string $date): void {
        $this->dateSortie = $date;
    }
}