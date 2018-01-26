<?php
class Contact {
    private $c_nom;
    private $c_email;
    private $c_sujet;
    private $c_message;
    private $to;
    private $headers;

    // fonction d'insertion dans la BDD
    public function insertContact($c_nom, $c_email, $c_message, $c_sujet){

// on récupère les données rentrées par l'utilisateur
        $this->c_nom = strip_tags($c_nom);
        $this->c_email = strip_tags($c_email);
        $this->c_sujet = strip_tags($c_message);
        $this->c_message = strip_tags($c_sujet);

        require_once('inc/connexion.php');
        // on requiert le fichier connexion.php qui contient l'accès à la BDD
        $req = $pdo->prepare('INSERT INTO t_contact (c_nom, c_email, c_message, c_sujet) VALUES (:c_nom, :c_email, :c_message, :c_sujet)');
        $req->execute([
            ':c_nom'=> $this->c_nom,
            ':c_email'=> $this->c_email,
            ':c_message'=> $this->c_message,
            ':c_sujet'=> $this->c_sujet

        ]);
        // on ferme la requête (protection c/ les injections)
        $req->closeCursor();
    }

    // Bonus - envoi d'un email
    public function sendEmail($c_sujet, $c_email, $c_message) {
        $this->to = 'bleyyannickpro@gmail.com';
        $this->c_email = strip_tags($c_email);
        $this->c_sujet = strip_tags($c_sujet);
        $this->c_message = strip_tags($c_message);
        $this->headers = 'From: ' . $this->c_email . "\r\n"; //retours à la ligne
        $this->headers .= 'MIME-version: 1.0' . "\r\n";
        $this->headers .= 'Content-type : text/html; charset=utf-8' . "\r\n";

        // on utilise la fonction mail() de PHP
        mail($this->to, $this->c_sujet, $this->c_message, $this->headers);
    }

}
