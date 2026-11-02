<?php

namespace iutnc\deefy\repository;
use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\audio\tracks\PodcastTrack;

use PDO;

class DeefyRepository {

    private static ?DeefyRepository $instance = null;
    private static array $config = [];

    private PDO $pdo;

    public static function setConfig(string $file): void {
        self::$config = parse_ini_file($file);
    }

    private function __construct() {

        $dsn = "mysql:host=" . self::$config["host"]
             . ";dbname=" . self::$config["database"]
             . ";charset=utf8mb4";

        $this->pdo = new PDO(
            $dsn,
            self::$config["username"],
            self::$config["password"]
        );

        $this->pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
    }

    public static function getInstance(): DeefyRepository {

        if (self::$instance === null) {
            self::$instance = new DeefyRepository();
        }

        return self::$instance;
    }

    public function findAllPlaylists(): array {

    $requete = $this->pdo->query("SELECT * FROM playlist");

    $resultat = [];

    while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {

        $playlist = new Playlist($ligne["nom"]);
        $playlist->setId((int) $ligne["id"]);

        $resultat[] = $playlist;
    }

    return $resultat;
    }

    public function saveEmptyPlaylist(Playlist $playlist): Playlist {

    $requete = $this->pdo->prepare(
        "INSERT INTO playlist (nom) VALUES (:nom)"
    );

    $requete->execute([
        "nom" => $playlist->nom
    ]);

    $playlist->setId((int) $this->pdo->lastInsertId());

    return $playlist;
    }

    public function savePodcastTrack(PodcastTrack $track): PodcastTrack {

    $requete = $this->pdo->prepare(
        "INSERT INTO track
        (titre, genre, duree, filename, type, auteur_podcast, date_posdcast)
        VALUES
        (:titre, :genre, :duree, :filename, 'P', :auteur, :date)"
    );

    $requete->execute([
        "titre" => $track->titre,
        "genre" => $track->genre,
        "duree" => $track->sec,
        "filename" => $track->nom,
        "auteur" => $track->artiste,
        "date" => $track->getDate()
    ]);

    $track->setId((int) $this->pdo->lastInsertId());

    return $track;
    }

    public function addTrackToPlaylist(int $idPlaylist, int $idTrack): void {

    $requete = $this->pdo->prepare(
        "INSERT INTO playlist2track
        (id_pl, id_track, no_piste_dans_liste)
        VALUES (:playlist, :track, :numero)"
    );

    $numero = $this->pdo->prepare(
        "SELECT COALESCE(MAX(no_piste_dans_liste), 0) + 1
         FROM playlist2track
         WHERE id_pl = :playlist"
    );

    $numero->execute([
        "playlist" => $idPlaylist
    ]);

    $position = (int) $numero->fetchColumn();

    $requete->execute([
        "playlist" => $idPlaylist,
        "track" => $idTrack,
        "numero" => $position
    ]);
    }

    public function findPlaylistById(int $id): ?Playlist {

    $requete = $this->pdo->prepare("SELECT * FROM playlist WHERE id = :id");

    $requete->execute(["id" => $id]);

    $ligne = $requete->fetch(PDO::FETCH_ASSOC);

    if (!$ligne) {
        return null;
    }

    $playlist = new Playlist($ligne["nom"]);
    $playlist->setId((int) $ligne["id"]);

    return $playlist;
    }
}