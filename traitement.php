<?php 
/*
	Fichier de traitement des données du formulaire

 */

	// Verification de la varaible $_POST
		if ( ! empty($_POST) ) {

			// initialisation des variables erreurs
				$erreur_civilite   = '';
				$erreur_nom        = '';
				$erreur_prenom     = '';
				$erreur_entreprise = '';
				$erreur_telephone  = '';
				$erreur_emai       = '';

			// initialisation des variables de données
				$civilite   = '' ;
				$nom        = '' ;
				$prenom     = '' ;
				$entreprise = '' ;
				$telephone  = '' ;
				$email      = '' ;


			// recuperation de la variable $_POST
				$recuperation_post = $_POST[ 'donnees' ];


				// on retranscrit la recuperation en tableau pour traitement
					parse_str($recuperation_post, $donnees_formulaire);
					
					// recuperation des données
						$civilite = $donnees_formulaire['civilite'];
						$nom      = $donnees_formulaire['nom'];
						$prenom   = $donnees_formulaire['prenom'];
						



					// definition de l'etat du traitement
						$etat = 'reussite';

				// création de la variable de renvoi : resultat
					$resultat =  array(
						'etat'            => $etat,
						'erreur_civilite' => $erreur_civilite,
						'erreur_nom' => $erreur_nom,
						'erreur_prenom' => $erreur_prenom,
						'erreur_entreprise' => $erreur_entreprise,
						'erreur_telephone' => $erreur_telephone,
						'erreur_emai' => $erreur_telephone,

						'civilite'        => $civilite,
						'nom'             => $nom,
						'prenom'          => $prenom


						);

				// transphormation du resultat en json afin de pouvoir etre lu en jQuery
					$resultat_json = json_encode($resultat);






			// revoie du traitement en json pour utilisation en jQuery
				echo ($resultat_json); 


				// fin du traitement
				exit;
		// fin de la condition de l'existance d'une variable post
		} else { echo 'erreur0' ; exit; }






 ?>