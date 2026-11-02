<?php

namespace iutnc\deefy\actions;

use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\render\AudioListRenderer;

class AddPodcastTrackAction extends Action {

    public function execute(): string {

        if($this->http_method === "GET"){

        return <<<HTML
            <h1>Ajouter une piste</h1>

            <form method="post" action="?action=add-track" enctype="multipart/form-data">

            <label>Fichier MP3 :</label>
            <input type="file" name="userfile" accept=".mp3,audio/mpeg">
            <br>

            <label>Titre :</label>
            <input type="text" name="titre">

            <label>Artiste :</label>
            <input type="text" name="artiste">

            <label>Genre :</label>
            <input type="text" name="genre">

            <label>Durée :</label>
            <input type="text" name="duree">

            <label>Date :</label>
            <input type="date" name="date">

            <button type="submit">Ajouter la piste</button>

        </form>
        HTML;
        } else {
            $titre = filter_var(
                $_POST["titre"] ?? "",
                FILTER_SANITIZE_SPECIAL_CHARS
            );

             $artiste = filter_var(
                $_POST["artiste"] ?? "",
                FILTER_SANITIZE_SPECIAL_CHARS
            ); 

            $genre = filter_var(
                $_POST["genre"] ?? "",
                FILTER_SANITIZE_SPECIAL_CHARS
            );

            $duree = filter_var(
                $_POST["duree"] ?? 0,
                FILTER_VALIDATE_INT
            );

             $date = filter_var(
                $_POST["date"] ?? "",
                FILTER_SANITIZE_SPECIAL_CHARS
            );

            if (!isset($_FILES["userfile"]) ||
                $_FILES["userfile"]["error"] !== UPLOAD_ERR_OK) {
                return "<p>Erreur lors de l'upload du fichier.</p>";
            }

            $nomFichier = $_FILES["userfile"]["name"];
            $typeFichier = $_FILES["userfile"]["type"];

            if (
    substr($nomFichier, -4) !== ".mp3" ||
    $typeFichier !== "audio/mpeg"
) {
    return "<p>Le fichier doit être un fichier MP3.</p>";
}


$nouveauNom = bin2hex(random_bytes(16)) . ".mp3";


$dossier = __DIR__ . "/../../../audio/";


if (!is_dir($dossier)) {
    mkdir($dossier, 0777, true);
}


$destination = $dossier . $nouveauNom;


if (!move_uploaded_file(
    $_FILES["userfile"]["tmp_name"],
    $destination
)) {
    return "<p>Erreur lors de l'enregistrement du fichier.</p>";
}


$piste = new PodcastTrack(
    $titre,
    "audio/" . $nouveauNom
);

            $piste->setArtiste($artiste);
            $piste->setGenre($genre);
            $piste->setSec($duree);
            $piste->setDate($date);

            $playlist = $_SESSION["playlist"];

            $playlist->ajouterPiste($piste);

            $_SESSION["playlist"] = $playlist;

            $renderer = new AudioListRenderer($playlist);

            $html = $renderer->render(1);

            $html .= '<a href="?action=add-track">Ajouter encore une piste</a>';

            return $html;
        }
    }
}