<?php

namespace iutnc\deefy\actions;

class AddUserAction extends Action {

    public function execute(): string {

        if ($this->http_method === "GET") {

            return <<<HTML
                <h1>Inscription</h1>

                <form method="post" action="?action=add-user">

                    <label>Nom :</label>
                    <input type="text" name="nom">
                    <br>

                    <label>Email :</label>
                    <input type="email" name="email">
                    <br>

                    <label>Âge :</label>
                    <input type="number" name="age">
                    <br>

                    <button type="submit">Connexion</button>

                </form>
            HTML;

        } else {

            $nom = filter_var(
                $_POST["nom"] ?? "",
                FILTER_SANITIZE_SPECIAL_CHARS
            );

            $email = filter_var(
                $_POST["email"] ?? "",
                FILTER_SANITIZE_SPECIAL_CHARS
            );

            $age = filter_var(
                $_POST["age"] ?? "",
                FILTER_SANITIZE_SPECIAL_CHARS
            );

            return "Nom:$nom, Email:$email, Age:$age ans";
        }
    }
}