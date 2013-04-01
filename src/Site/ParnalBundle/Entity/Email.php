<?php

namespace Site\ParnalBundle\Entity;

class Email
{
    private $sujet;
    private $from;
    private $body;

    public function getSujet() {
    return $this->sujet;
    }

    public function setSujet($sujet) {
    $this->sujet = $sujet;
    }

    public function getFrom() {
    return $this->from;
    }

    public function setFrom($from) {
    $this->from = $from;
    }

    public function getBody() {
    return $this->body;
    }

    public function setBody($body) {
    $this->body = $body;
    }
}

