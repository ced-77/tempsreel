<?php 
/*
	Fichier de traitement des données du formulaire

 */

	// initialisation des constantes de configuration
		define('ADRESSE_MAIL_ENTREPRISE', 'cedric.ray@orange.fr' ); // adresse mail où le formulaire doit être envoyer
		


	// Creation des variables de gestion d'erreur
		$long_max       = 50;	// longueur max des champs nom et prenom
		$long_min       = 3; 	// longueur min des champs nom et prenom et objet
		$long_tel       = 10; 	// longueur du champ téléphone
		$long_max_objet = 100;	// longueur maxi du champ objet



	// initialisation des variables erreurs
		$erreurs = array(); // tabeau de la vérification de l'existance des champs
		$erreur  = array(); // erreur dans la saisie des champs

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
		 * @param string $champ le nom du champ à vérifier
		 * @return TRUE si la longueur est correte, FALSE si la longueur n'est pas correcte
		 * 		 		 
		*/
			function longueurChamp ($champ, $mini, $maxi) {
				// initialisation des varibles de paramettrage en variables globales
					global $donnees_formulaire;
				// condition de vérification et retour de la vérification
						
					$longueurChamp = strlen( $donnees_formulaire[ $champ ] );
					
					$resultat =( ! empty($donnees_formulaire[$champ]) and ($longueurChamp >= $mini and $longueurChamp <= $maxi ) );
	
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
									} elseif ( ! empty( $donnees_formulaire['civilite'] ) ) { $erreur['civilite'] = 'Civilité non définie'; }

							// vérification de la longueur du nom
														
								if ( ! empty( $donnees_formulaire['nom'] ) and  longueurChamp('nom', $long_min, $long_max ) ) {
										$nom = $donnees_formulaire['nom'];

									} elseif ( ! empty( $donnees_formulaire['nom'] ))  { $erreur['nom'] = 'Ce champ doit être compris entre 3 et 50 caractère.'; }

							// verification de la longueur du prenom
								if ( ! empty( $donnees_formulaire['prenom'] ) and longueurChamp('prenom', $long_min, $long_max ) ) {
										$prenom = $donnees_formulaire['prenom'];

									} elseif ( ! empty( $donnees_formulaire['prenom'] ) ) { $erreur['prenom'] = 'Ce champ doit être compris entre 3 et 50 caractère.'; }

							// vérification de la longueur de l'entreprise
								if ( ! empty( $donnees_formulaire['entreprise'] ) and longueurChamp( 'entreprise', $long_min, $long_max) ) {
										$entreprise = $donnees_formulaire['entreprise']; 

									} elseif ( ! empty( $donnees_formulaire['entreprise'] ) ) { $erreur['entreprise'] = 'Ce champ doit être compris entre 3 et 50 caractère.'; }

							// vérification du numéro de téléphone
								if ( ! empty( $donnees_formulaire['telephone'] ) and strlen($donnees_formulaire['telephone']) == $long_tel and is_int( intval($donnees_formulaire['telephone'] ) ) == TRUE ) {
									$telephone = $donnees_formulaire['telephone'];

									} elseif ( ! empty( $donnees_formulaire['telephone'] ) ) { $erreur['telephone'] = 'Le format de saisie : 0123456789 '; }

							// vérification du format de l'adress mail
								if ( ! empty( $donnees_formulaire['email'] ) and filter_var( $donnees_formulaire['email'], FILTER_VALIDATE_EMAIL) ) {
									$email = $donnees_formulaire['email'];

									} elseif ( ! empty( $donnees_formulaire['email'] ) ) { $erreur['email'] = 'Ce format d\'email n\'est pas valide'; }

							// verification de la longueur du champ objet
								if ( ! empty( $donnees_formulaire['objet'] ) and longueurChamp(	'objet', $long_min, $long_max_objet ) ) {
										$objet	= $donnees_formulaire['objet'];

									} elseif ( ! empty( $donnees_formulaire['objet'] ) ) { $erreur['objet'] = 'Ce champ doit être compris entre 3 et 100 caractère.'; }


				// definition de l'etat du traitement
					if ( ! empty($erreurs) or ! empty($erreur) ){
						$etat = 'erreur';
					} else { $etat = 'reussite'; }
					

				// création de la variable de renvoi : resultat
					$resultat  =  array(
						'etat'                => $etat,
						'erreur_generale'     => $erreurs,
						'erreur_saisie_champ' => $erreur,
						
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





// fin du fichier de traitement du formulaire
 ?>