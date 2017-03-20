<?php 
/*
	Fichier de traitement des données du formulaire

 */

	// Creation des variables de gestion d'erreur
		$long_max = 255;
		$long_min = 2;

	// initialisation des variables erreurs
		$erreurs            = array();
		$erreur_civilite    = '' ;
		$erreur_nom         = '' ;
		$erreur_prenom      = '' ;
		$erreur_entreprise  = '' ;
		$erreur_telephone   = '' ;
		$erreur_email       = '' ;
		$erreur_objet       = '' ;
		$erreur_description = '' ;

	// initialisation des variables de données
		$civilite    = '' ;
		$nom         = '' ;
		$prenom      = '' ;
		$entreprise  = '' ;
		$telephone   = '' ;
		$email       = '' ;
		$objet       = '' ;
		$description = '' ;


	// creation des fonctions
	
		/**
		 * 	fonction existe
		 *
		 *  cette fonction permet de controler si un champ à bien ete 
		 *  rempli dans le formulaire
		 *
		 * @param   string $champ le nom du champ à vérifier
		 * @return true si le champ à bien été rempli sinon retourne False
		 * 
		 */
		
		 	function existe($champ) {
		 		global $donnees_formulaire;
		 		$existe = (! empty($donnees_formulaire[$champ]) && trim($donnees_formulaire[$champ]) !== '' ) ;
		 		return $existe; // retourne le resultat TRUE ou FALSE


			// fin de la fonction de controle du formulaire
			}



		/**
		 * 	fonction (verification de la longueur des donnes)
		 *
		 * 	fonction pour vérifier la longueur mini et max des champs
		 *
		 * @param 
		 *
		 * @return TRUE si la longueur est correte, FALSE si la longueur n'est pas correcte
		 * 		 		 
		*/
			function longueurChamp ($champ) {
				// initialisation des varibles de paramettrage en variables globales
					global $long_max, $long_min, $donnees_formulaire;

				// condition de vérification et retour de la vérification
					
						$resultat =( ! empty($donnees_formulaire[$champ]) and (strlen($donnees_formulaire[$champ]) > $long_min or strlen($donnees_formulaire[$champ]) < $long_max) );

				// retour du resultat
					return $resultat;

			// fin de la controle de la longueur du champ
			}

	

	// Verification de la varaible $_POST
		if ( !empty( $_POST ) && !empty( $_POST['donnees'] ) ) {

			
				

			// recuperation de la variable $_POST
				$recuperation_post = $_POST[ 'donnees' ];


				// on retranscrit la recuperation en tableau pour traitement
					parse_str($recuperation_post, $donnees_formulaire);

					
					// verification des champs obligatoires
						// creation du tableau de controle
							 $controle = array (
												'civilite'   => 'civilite',
												'nom'        => 'nom',
												'prenom'     => 'prenom',
												'entreprise' => 'entreprise',
												'telephone'  =>	'telephone',
												'email'      =>	'email',
												'objet'      => 'objet'
												);

						// verification des données
							foreach ($controle as $key => $champ) {
								if ( existe($champ) == FALSE ) {

									$erreurs[$champ] = ' - Champ obligatoire -';
								}
							// fin du foreach pour vérification de saisi formulaire	
							}



						// verification des données
							// vérification de la civilité 
							
								if ( ! empty( $donnees_formulaire['civilite'] ) and ( $donnees_formulaire['civilite'] == '1' or $donnees_formulaire['civilite'] == '2' or $donnees_formulaire['civilite'] == '3' ) ) {
										$civilite = $donnees_formulaire['civilite'];
									} else { $erreur_civilite = 'Civilité non définie'; }

							// vérification de la longueur du nom
														
								if ( longueurChamp('nom') ) {
										$nom = $donnees_formulaire['nom'];

									} else { $erreur_nom = 'Ce champ doit être compris entre 3 et 255 caractère.'; }

							// verification de la longueur du prenom
								if ( longueurChamp('prenom') ) {
										$prenom = $donnees_formulaire['prenom'];

									} else { $erreur_prenom = 'Ce champ doit être compris entre 3 et 255 caractère.'; }
							


							
						
					
					// recuperation des données
						
						
						$prenom   = $donnees_formulaire['prenom'];
						



				// definition de l'etat du traitement
					if ( ! empty($erreurs) ){
						$etat = 'erreur';
					} else { $etat = 'reussite'; }
					

				// création de la variable de renvoi : resultat
					$resultat  =  array(
						'etat'               => $etat,
						'erreur_generale'    => $erreurs,
						'erreur_civilite'    => $erreur_civilite,
						'erreur_nom'         => $erreur_nom,
						'erreur_prenom'      => $erreur_prenom,
						'erreur_entreprise'  => $erreur_entreprise,
						'erreur_telephone'   => $erreur_telephone,
						'erreur_emai'        => $erreur_email,
						'erreur_objet'       => $erreur_objet,
						'erreur_description' => $erreur_description,
						
						'civilite'    => $civilite,
						'nom'         => $nom,
						'prenom'      => $prenom,
						'entreprise'  => $entreprise,
						'telephone'   => $telephone,
						'email'       => $email,
						'objet'       => $objet,
						'description' => $description
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