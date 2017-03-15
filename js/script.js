$(document).ready(function{

	// recuperation du formulaire en cliquant sur le submit
		$('button').on(click, function(event){

			// suppression de l'action part default
				event.preventDefault();
			// recupération des données du formulaire et 
			// transphormation des données pour transmition du formulaire au fichier php
				var forumlaire = $('form');
				var data = formulaire.serialize();

			// envoie des données recupérer au fichier PHP
			// de traitement
				console.log(formulaire);
				console.log(data);

				$.ajax({
					type: 'POST',
					url: 'traitement.php',
					data: {'donnees':data},
					dataType: 'html',

					success : function(reponse, statut){
						// affichage du retour de donnée
						// par le fichier de traitement
							console.log(reponse);
						// traitement de la réponse du fichier de traitement
						
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