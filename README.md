# PeerSync

PeerSync est une plateforme d’entraide pour les apprenants de l’ENAA. Elle permet de définir ses compétences, publier des demandes d’aide, prendre en charge une session en tant que tuteur, puis clôturer et évaluer l’échange.

## Objectif Produit

L’application vise à organiser l’entraide entre apprenants et tuteurs autour de tickets clairs, suivis par statut, avec une vision simple des compétences, des sessions et de la valorisation des contributeurs.

## Épics et User Stories

### Épic 1 : Gestion des Utilisateurs et Profils

#### US 1 : Connexion et rôles

En tant qu’apprenant de l’ENAA, je veux me connecter à PeerSync et définir mes compétences maîtrisées ou à travailler, afin de pouvoir proposer mon aide ou demander du support.

Critères d’acceptation :

- L’utilisateur se connecte avec ses identifiants ENAA.
- Le profil contient une liste de tags de compétences, par exemple POO, SQL ou JavaScript.

### Épic 2 : Gestion des Demandes d’Aide

#### US 2 : Création d’une demande d’aide

En tant qu’apprenant bloqué sur un concept, je veux publier une demande d’aide précise avec un titre, une description et la techno concernée, afin qu’un tuteur disponible puisse la prendre en charge.

Critères d’acceptation :

- Un formulaire permet de saisir le sujet et de choisir la catégorie.
- La demande apparaît sur le tableau de bord de la plateforme.
- La demande est créée avec un statut initial, par exemple `Status::EN_ATTENTE`.

#### US 3 : Prise en charge par un tuteur

En tant que tuteur volontaire, je veux voir la liste des demandes en attente et en accepter une, afin de planifier une session d’entraide avec l’apprenant.

Critères d’acceptation :

- Le tuteur clique sur « Aider cet apprenant ».
- Le statut de la demande passe de « En attente » à « Assignée ».
- Les deux utilisateurs reçoivent un lien ou une notification pour se contacter.
- La logique d’assignation vérifie qu’un tuteur ne s’assigne pas lui-même.

### Épic 3 : Suivi et Validation des Sessions

#### US 4 : Clôture et validation de la session

En tant qu’apprenant ayant reçu de l’aide, je veux marquer la demande comme résolue une fois la session terminée, afin de valider que le concept est compris et libérer le tuteur.

Critères d’acceptation :

- L’apprenant clique sur « Résolu ».
- Il peut laisser un court commentaire de remerciement.
- Le statut du ticket passe à `Status::RESOLUE`.

#### US 5 : Avis et commentaires

En tant qu’apprenant, je veux laisser une note de 1 à 5 étoiles à mon tuteur après la session.

Critères d’acceptation :

- Le système refuse la persistance si la note est hors de l’intervalle 1 à 5.

### Bonus : Gamification et valorisation des tuteurs

#### US 6 : Système de badges et points

En tant que tuteur à l’ENAA, je veux accumuler des points et décrocher des badges en fonction du nombre de sessions validées, afin de valoriser mon investissement auprès de la communauté et de l’administration.

Critères d’acceptation :

- Chaque session clôturée rapporte des points au tuteur.
- Un badge peut être attribué après un certain seuil, par exemple 5 sessions sur le tag PHP.

#### US 7 : Mur des héros

En tant qu’apprenant, je veux consulter un classement des tuteurs les plus actifs du mois, afin de célébrer l’entraide et repérer les référents techniques de la promotion.

### Épic 5 : Dashboard Administration & Valorisation

#### US 8 : Visualisation de l’engagement

En tant qu’administrateur de l’ENAA, je veux accéder à un tableau de bord statistique, afin de mesurer l’impact du tutorat et valoriser officiellement les tuteurs.

Critères d’acceptation :

- Un espace admin affiche des compteurs et des classements.
- Il est possible de voir ou d’exporter le volume d’heures d’entraide générées.

## Fonctionnalités couvertes

- Connexion avec rôle `tuteur` ou `apprenant`
- Gestion de profil et de compétences
- Création de demandes d’aide
- Assignation à un tuteur
- Clôture avec commentaire
- Statuts de ticket gérés en base

## Structure du projet

```text
config/
  Database.php
Database/
  requete.sql
public/
  index.php
  dashboard.php
  request_detail.php
  profil.php
scripts/
  login_process.php
  assign_process.php
  request_process.php
  resolve_process.php
src/
  Entities/
    User.php
    HelpRequest.php
    Evaluation.php
  Enums/
    Status.php
  Repositories/
    UserRepository.php
    HelpRequestRepository.php
```

## Modèle de données

Tables principales :

- `users`
- `skills`
- `users_skills`
- `help_requests`

### ERD

Le diagramme de données est disponible dans [images/erd-simple.drawio](images/erd-simple.drawio).

## UML

### Class Diagram

- `User` représente un compte utilisateur.
- `HelpRequest` représente une demande d’aide avec son statut.
- `Status` représente les états du ticket.
- `UserRepository` et `HelpRequestRepository` encapsulent l’accès à la base.

### Séquences métier

- Connexion : `public/index.php` -> `scripts/login_process.php` -> `UserRepository`
- Création d’aide : `public/request_detail.php` -> `scripts/request_process.php` -> `HelpRequestRepository`
- Assignation : `public/dashboard.php` -> `scripts/assign_process.php`
- Résolution : `public/dashboard.php` -> `scripts/resolve_process.php`

## Démarrage local

1. Importer `Database/requete.sql` dans MySQL.
2. Vérifier les identifiants dans `config/Database.php`.
3. Déposer le projet dans `htdocs`.
4. Ouvrir `public/index.php` dans le navigateur.

## Notes techniques

- Le projet utilise `PDO` pour l’accès à MySQL.
- Les classes métier sont dans `src/`.
- Les scripts de traitement restent dans `scripts/` pour gérer les formulaires et les redirections.
