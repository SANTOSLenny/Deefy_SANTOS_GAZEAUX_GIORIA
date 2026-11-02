<?php

require_once __DIR__ . '/vendor/autoload.php';

use iutnc\deefy\repository\DeefyRepository;

DeefyRepository::setConfig(__DIR__ . '/src/config/deefy.db.ini');

$repo = DeefyRepository::getInstance();

echo "Connexion à MySQL réussie !";

$playlists = $repo->findAllPlaylists();

foreach ($playlists as $pl) {
    echo "Playlist : " . $pl->nom . " : " . $pl->id . "<br>";
}

$playlist = new \iutnc\deefy\audio\lists\Playlist("Playlist de test");

$playlist = $repo->saveEmptyPlaylist($playlist);

echo "Playlist créée : " . $playlist->nom . " (ID : " . $playlist->id . ")";

$track = new \iutnc\deefy\audio\tracks\PodcastTrack(
    "Podcast de test",
    "test.mp3"
);

$track->setArtiste("Toto");
$track->setGenre("Documentaire");
$track->setSec(180);
$track->setDate("2026-11-02");

$track = $repo->savePodcastTrack($track);

echo "Piste créée : " . $track->titre . " (ID : " . $track->id . ")";

$repo->addTrackToPlaylist($playlist->id, $track->id);

echo "<p>Piste ajoutée à la playlist !</p>";