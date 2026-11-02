<?php

namespace iutnc\deefy\actions;

class DefaultAction extends Action {

    public function execute(): string {
        return "<h1>Bienvenue sur Deefy</h1>";
    }
}