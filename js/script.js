$(document).ready(function(){

	// recuperation du formulaire en cliquant sur le submit
		$('button').on('click', function(event){

			// suppression de l'action part default
				event.preventDefault();
			// recupération des données du formulaire et 
			// transphormation des données pour transmition du formulaire au fichier php
				var formulaire = $('form');
				var data = formulaire.serialize();


			// envoie des données recupérer au fichier PHP
			// de traitement
				console.log(formulaire);
				console.log(data);

				$.ajax({
					type: 'POST',
					url: 'traitement.php',
					data: {'donnees':data},
					dataType: 'json',

					success : function(reponse, statut){
						// affichage du retour de donnée
						// par le fichier de traitement
							console.log(reponse);
							console.log(reponse['etat']);

						// traitement de la réponse du fichier de traitement
							// verification des erreurs
								if ( reponse['etat'] == 'erreur' ) {
									// marquer : Erreur de saisie...
										var traitement = ' - Erreur de saisie... - ';
										$('#resultat').html(traitement);


										// creation des tableaux de verification de saisie
											// champs obligatoires
												var tableau_verification_obligatoire =  {
																		nom : 'nom',
																		entreprise : 'entreprise',
																		email : 'email',
																		objet : 'objet'
																		};

											// champ non obligatoires
												var tableau_verification_non_obligatoire = {
																		prenom : 'prenom',
																		telephone : 'telephone'
																		};

										// verification des variables obligatoires
											
											// verification des champs erreur(s)
												for ( var donnee in tableau_verification_obligatoire ) {

													// verification de la non existance d'une saisie
														if ( reponse['erreur_generale'][donnee] != ''  ) {

															// affichage de l'erreur de saisie
															$('#erreur_'+donnee).html(reponse['erreur_generale'][donnee]);

															// fin de la condition de l'existance du message d'erreur
															}

														if ( reponse['erreur_saisie_champ'][donnee] != '' ) {

																// affichage de l'erreur de saisie
																$('#erreur_'+donnee).html(reponse['erreur_saisie_champ'][donnee]);


															// fin de la condition de l'existance d'un message d'erreur propre au champ ( mauvaise saisie )
															}
												// fin de la boucle de verification des sasisie des variables obligatoires
												}



										// verification des variable non-obligatoires
											// verification des erreurs de saisie
												for ( var donnee in tableau_verification_non_obligatoire ) {

													if ( reponse['erreur_saisie_champ'][donnee] != '' ) {
														// affichage de l'erreur de la saisie
															$('#erreur_'+donnee).html(reponse['erreur_saisie_champ'][donnee]);
													// fin de la condition de l'existance d'un champs erreur	
													}


												// fin du tableau de verification des chomps non obligatoires
												} 

									} else if ( reponse['etat'] == 'reussite' ) {
												// marquer : envoi du formulaire reussi...
													var traitement = ' - Envoi du formulaire reussi... - ';
													$('#resultat').html(traitement);


												} else { 
														// marquer choix impossible...
															
														}

						
						// Affichage de l'etat de la requette 
							console.log('Etat de la réponse : '+statut);

					// fin du traitement du success
					},

					error : function (resultat, statut, erreur){
						console.log("reponse jquery : " + resultat);
						console.log("statut de la requete : "+statut);
						console.log("type d'erreur : "+erreur);
						$('.erreur').html('Errreur : ('+erreur+')')

					// fin de la gestion d'erreur
					},



				// fin de la fonction AJAX
				})
				





		// fin de la fonction du click sur le bouton submit
		})






// fin du script javaScript et jQuery
})