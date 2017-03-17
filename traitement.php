<?php 
/*
	Fichier de traitement des données du formulaire

 */

	// Verification de la varaible $_POST
		if ( ! empty($_POST) ) {

			// on recupere les données de la variable $_POST
				$recuperation_post = $_POST[ 'donnees' ];


				// on retranscrit la recuperation en tableau pour traitement
					parse_str($recuperation_post, $donnees_formulaire);
					echo ('donnee du tableau du formulaire :' );
					var_dump($donnees_formulaire);

				// fin du traitement
				exit;





		// fin de la condition de l'existance d'une variable post
		} else { echo 'erreur0' ; exit; }







 ?>