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
										var traitement = 'Erreur de saisie...';
										$('#resultat').html(traitement);

									} else if ( reponse['etat'] == 'reussite' ) {
												// marquer : envoi du formulaire reussi...
													var traitement = 'Envoi du formulaire reussi...';
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