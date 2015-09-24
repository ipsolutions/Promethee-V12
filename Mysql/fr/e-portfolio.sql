##############################################################################
#    Copyright (c) 2002-2006 by Dominique Laporte (C-E-D@wanadoo.fr)         #
#                                                                            #
#    This file is part of Prométhée.                                         #
#                                                                            #
#    Prométhée is free software: you can redistribute it and/or modify       #
#    it under the terms of the GNU General Public License as published by    #
#    the Free Software Foundation, either version 3 of the License, or       #
#    (at your option) any later version.                                     #
#                                                                            #
#    Prométhée is distributed in the hope that it will be useful,            #
#    but WITHOUT ANY WARRANTY; without even the implied warranty of          #
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the           #
#    GNU General Public License for more details.                            #
#                                                                            #
#    You should have received a copy of the GNU General Public License       #
#    along with Prométhée.  If not, see <http://www.gnu.org/licenses/>.      #
##############################################################################


use `##DATABASE##`;


###############################################################################
# création de la dba des formations
###############################################################################
insert into pfolio_formation values('1','B2i-C2i','Attestation du Brevet Informatique et Internet','fr');
insert into pfolio_formation values('2','PIM, DEFI, NSI','Compétences Informatique et Internet','fr');
insert into pfolio_formation values('3','6ème',   'Niveau collège - 6ème','fr');
insert into pfolio_formation values('4','5ème',   'Niveau collège - 5ème','fr');
insert into pfolio_formation values('5','4ème',   'Niveau collège - 4ème','fr');
insert into pfolio_formation values('6','3ème',   'Niveau collège - 3ème','fr');
###############################################################################
# création de la dba des modalités d'évaluations des compétences
###############################################################################
insert into pfolio_eval values('1', 'Evaluation 3 niveaux','fr');
insert into pfolio_eval values('2', 'Evaluation Tout ou Rien','fr');
insert into pfolio_eval values('3', 'Evaluation ENFA','fr');
insert into pfolio_eval values('4', 'Evaluation code couleur','fr');
###############################################################################
# création de la dba des niveaux des évaluations des compétences
###############################################################################
insert into pfolio_level values('1',  '1', '#0000FF', 'A',  'compétence acquise : je connais parfaitement les notions et sais effectuer les opérations seul.', 'fr');
insert into pfolio_level values('2',  '1', '#00FF00', 'B',  'compétence à renforcer : je connais les notions et sais effectuer les opérations avec quelques conseils.', 'fr');
insert into pfolio_level values('3',  '1', '#FF0000', 'C',  'compétence en cours d\'acquisition : je sais effectuer les opérations à l\'aide d\'un mode opératoire.', 'fr');
insert into pfolio_level values('4',  '2', '#00FF00', 'OK', 'compétence acquise.', 'fr');
insert into pfolio_level values('5',  '2', '#FF0000', 'N/A','compétence non acquise.', 'fr');
insert into pfolio_level values('6',  '3', '#0000FF', '5',  'appropriation totale, transposable dans un nouveau contexte.', 'fr');
insert into pfolio_level values('7',  '3', '#0000FF', '4',  'maîtrise dans un contexte connu.', 'fr');
insert into pfolio_level values('8',  '3', '#0000FF', '3',  'appropriation en cours.', 'fr');
insert into pfolio_level values('9',  '3', '#0000FF', '2',  'initiation en cours.', 'fr');
insert into pfolio_level values('10', '3', '#0000FF', '1',  'compétence connue (le stagiaire en a entendu parler).', 'fr');
insert into pfolio_level values('11', '4', '#0000FF', '5',  'compétence maîtrisée.', 'fr');
insert into pfolio_level values('12', '4', '#00FF00', '4',  'compétence bien assimilée.', 'fr');
insert into pfolio_level values('13', '4', '#FFFF00', '3',  'compétence à renforcer.', 'fr');
insert into pfolio_level values('14', '4', '#FF6400', '2',  'compétence mal maîtrisée.', 'fr');
insert into pfolio_level values('15', '4', '#FF0000', '1',  'compétence peu développée.', 'fr');
###############################################################################
# création de la dba des Unités de Valeur
###############################################################################
insert into pfolio_uv values('','1','10','0','0','255','B2i niveau 1','Brevet Informatique et Internet - primaire',' 1 2 3 ','1','N','N','N','80','fr');
insert into pfolio_uv values('','1','10','0','0','255','B2i niveau 2','Brevet Informatique et Internet - collège',' 1 2 3 ','1','N','N','N','80','fr');
insert into pfolio_uv values('','1','10','0','0','255','B2i niveau 3','Brevet Informatique et Internet - lycée',' 1 2 3 ','1','N','N','N','80','fr');
insert into pfolio_uv values('','1','10','0','0','255','C2i niveau 1','Compétences Informatique et Internet - socle commun','','1','N','N','N','80','fr');
insert into pfolio_uv values('','1','10','0','0','255','C2i niveau 2 enseignement','Compétences Informatique et Internet - spécifique enseignant','','1','N','N','N','80','fr');
insert into pfolio_uv values('','1','10','0','0','255','C2i niveau 2 droit','Compétences Informatique et Internet - spécifique métiers du droit','','1','N','N','N','80','fr');
insert into pfolio_uv values('','1','10','0','0','255','C2i niveau 2 santé','Compétences Informatique et Internet - spécifique métiers de la santé','','1','N','N','N','80','fr');
insert into pfolio_uv values('','1','10','0','0','255','C2i niveau 2 ingénieur','Compétences Informatique et Internet - spécifique métiers de l\'ingénieur','','1','N','N','N','80','fr');
insert into pfolio_uv values('','1','10','0','0','255','B2i adultes','Brevet Informatique et Internet - pour adultes','','1','N','N','N','80','fr');
insert into pfolio_uv values('','2','10','0','0','255','PIM','Passeport pour l\'Internet et le Multimédia','','1','N','N','N','80','fr');
insert into pfolio_uv values('','2','10','0','0','255','DEFI niveau 1','Démarche d\'Evaluation du Fonctionnaire Internaute','','1','N','N','N','80','fr');
insert into pfolio_uv values('','2','10','0','0','255','DEFI niveau 2','Démarche d\'Evaluation du Fonctionnaire Internaute','','1','N','N','N','80','fr');
insert into pfolio_uv values('','2','10','0','0','255','NSI','Naviguer Sur Internet','','1','N','N','N','80','fr');
###############################################################################
# création de la dba des domaines de compétences B2i-C2i
###############################################################################
insert into pfolio values('','1','1','S\'approprier un environnement informatique de travail
','50','O');
insert into pfolio values('','1','2','Adopter une attitude responsable','50','O');
insert into pfolio values('','1','3','Créer, produire, traiter, exploiter 
des données','50','O');
insert into pfolio values('','1','4','S\'informer, se documenter','50','O');
insert into pfolio values('','1','5','Communiquer, échanger','50','O');

insert into pfolio values('','2','1','S\'approprier un environnement informatique de travail
','50','O');
insert into pfolio values('','2','2','Adopter une attitude responsable','50','O');
insert into pfolio values('','2','3','Créer, produire, traiter, exploiter 
des données','50','O');
insert into pfolio values('','2','4','S\'informer, se documenter','50','O');
insert into pfolio values('','2','5','Communiquer, échanger','50','O');

insert into pfolio values('','3','1','S\'approprier un environnement informatique de travail
','50','O');
insert into pfolio values('','3','2','Adopter une attitude responsable','50','O');
insert into pfolio values('','3','3','Créer, produire, traiter, exploiter des données','50','O');
insert into pfolio values('','3','4','S\'informer, se documenter','50','O');
insert into pfolio values('','3','5','Communiquer, échanger','50','O');

insert into pfolio values('','4','1','Compétence A1 : Tenir compte du caractère évolutif des TIC','50','O');
insert into pfolio values('','4','2','Compétence A2 : Intégrer la dimension éthique et le respect de la déontologie','50','O');
insert into pfolio values('','4','3','Compétence B1 : S\'approprier son environnement de travail','50','O');
insert into pfolio values('','4','4','Compétence B2 : Rechercher l\'information','50','O');
insert into pfolio values('','4','5','Compétence B3 : Sauvegarder, sécuriser, archiver ses données en local et en réseau  filaire ou sans fil','50','O');
insert into pfolio values('','4','6','Compétence B4 : Réaliser des documents destinés à être imprimés','50','O');
insert into pfolio values('','4','7','Compétence B5 : Réaliser la présentation de ses travaux en présentiel et en ligne','50','O');
insert into pfolio values('','4','8','Compétence B6 : Échanger et communiquer à distance','50','O');
insert into pfolio values('','4','9','Compétence B7 : Mener des projets en travail collaboratif à distance','50','O');

insert into pfolio values('','5','1','Compétence A1 : Maîtrise de l\'environnement numérique professionnel','50','O');
insert into pfolio values('','5','2','Compétence A2 : Développement des compétences pour la formation tout au long de la vie','50','O');
insert into pfolio values('','5','3','Compétence A3 : Responsabilité professionnelle dans le cadre du système éducatif','50','O');
insert into pfolio values('','5','4','Compétence B1 : Travail en réseau avec l\'utilisation des outils de travail collaboratif','50','O');
insert into pfolio values('','5','5','Compétence B2 : Conception et préparation de contenus d\'enseignement et de situations d\'apprentissage','50','O');
insert into pfolio values('','5','6','Compétence B3 : Mise en oeuvre pédagogique en présentiel et à distance','50','O');
insert into pfolio values('','5','7','Compétence B4 : Mise en œuvre de démarches d\'évaluation','50','O');

insert into pfolio values('','6','1','Compétence A : Problématiques et enjeux liés aux TIC dans les activités juridiques et judiciaires','50','O');
insert into pfolio values('','6','2','Compétence B1 : La recherche et l\'utilisation des ressources d\'information et de documentation juridique','50','O');
insert into pfolio values('','6','3','Compétence B2 : Sécurité','50','O');
insert into pfolio values('','6','4','Compétence B3 : Responsabilité professionnelle liée aux activités numériques','50','O');
insert into pfolio values('','6','5','Compétence B4 : Le travail collaboratif en réseau','50','O');
insert into pfolio values('','6','6','Compétence B5 : Les échanges numériques entre acteurs judiciaires ou juridiques et services offerts aux citoyens','50','O');
insert into pfolio values('','6','7','Compétence B6 : Traitement de l\'information juridique','50','O');

insert into pfolio values('','7','1','Compétence A1 : L’information en santé, documentation','50','O');
insert into pfolio values('','7','2','Compétence A2 : L’information en santé, juridique','50','O');
insert into pfolio values('','7','3','Compétence A3 : L’information en santé, sécurité','50','O');
insert into pfolio values('','7','4','Compétence B1 : Travail collaboratif en santé','50','O');
insert into pfolio values('','7','5','Compétence B2 : Systèmes d\’information','50','O');

insert into pfolio values('','8','1','Compétence A1 : Problématique et enjeux liés aux aspects juridiques en contexte professionnel','50','O');
insert into pfolio values('','8','2','Compétence A2 : La sécurité de l\’information et des systèmes d\’information','50','O');
insert into pfolio values('','8','3','Compétence B1 : Standards, normes techniques et interopérabilité','50','O');
insert into pfolio values('','8','4','Compétence B2 : Environnement numérique et ingénierie collaborative','50','O');

insert into pfolio values('','9','1','Compétence D1 : Environnement informatique','50','O');
insert into pfolio values('','9','2','Compétence D2 : Attitude citoyenne','50','O');
insert into pfolio values('','9','3','Compétence D3 : Traitement et Production','50','O');
insert into pfolio values('','9','4','Compétence D4 : Recherche de l\’information','50','O');
insert into pfolio values('','9','5','Compétence D5 : Communication','50','O');

insert into pfolio values('','10','1','Compétence A1 : Connaître et utiliser un équipement informatique et ses logiciels','50','O');
insert into pfolio values('','10','2','Compétence A2 : Naviguer sur Internet','50','O');
insert into pfolio values('','10','3','Compétence A3 : Communiquer avec Internet','50','O');
insert into pfolio values('','10','4','Compétence A4 : Créer et exploiter un document numérique','50','O');
insert into pfolio values('','10','5','Compétence A5 : Connaître les règles élémentaires du droit et du bon usage sur Internet','50','O');

insert into pfolio values('','11','1','Compétence M1 : Bases de l\'ordinateur et d\'Internet','50','O');
insert into pfolio values('','11','2','Compétence M2 : Traitement de texte et Tableur','50','O');
insert into pfolio values('','11','3','Compétence M3 : Messagerie et forum','50','O');
insert into pfolio values('','11','4','Compétence M4 : Navigation sur la Toile','50','O');
insert into pfolio values('','11','5','Compétence M5 : Sécurité des systèmes d\’information','50','O');
insert into pfolio values('','11','6','Compétence M6 : Protection des données personnelles et environnement juridiques','50','O');
insert into pfolio values('','11','7','Compétence M7 : Administration électronique','50','O');

insert into pfolio values('','12','1','Compétence M1 : Publication sur le Web','50','O');
insert into pfolio values('','12','2','Compétence M2 : Messagerie et forum','50','O');
insert into pfolio values('','12','3','Compétence M3 : Navigation sur la Toile','50','O');
insert into pfolio values('','12','4','Compétence M4 : Sécurité des systèmes d\’information','50','O');
insert into pfolio values('','12','5','Compétence M5 : Protection des données personnelles et environnement juridique','50','O');
insert into pfolio values('','12','6','Compétence M6 : Administration électronique','50','O');

insert into pfolio values('','13','1','Compétence A1 : Naviguer sur Internet','50','O');
insert into pfolio values('','13','2','Compétence A2 : Communiquer avec Internet','50','O');
insert into pfolio values('','13','3','Compétence A3 : Rechercher sur Internet','50','O');
###############################################################################
# création de la dba des compétences B2i
###############################################################################
## B2i niv 1 ##
insert into pfolio_data values('','1','1','Je sais désigner et nommer les principaux éléments composant l\'équipement informatique que j\'utilise et je sais à quoi ils servent.','N','O');
insert into pfolio_data values('','1','2','Je sais allumer et éteindre l\'équipement informatique; je sais lancer et quitter un logiciel.','N','O');
insert into pfolio_data values('','1','3','Je sais déplacer le pointeur, placer le curseur, sélectionner, effacer et valider.','N','O');
insert into pfolio_data values('','1','4','Je sais accéder à un dossier, ouvrir et enregistrer un fichier.','N','O');
insert into pfolio_data values('','2','1','Je connais les droits et devoirs indiqués dans la charte d\’usage des TIC de mon école.','N','O');
insert into pfolio_data values('','2','2','Je respecte les autres et je me protège moi-même dans le cadre de la communication et de la publication électroniques.','N','O');
insert into pfolio_data values('','2','3','Si je souhaite récupérer un document, je vérifie 
que j\'ai le droit de l\'utiliser et à quelles conditions.','N','O');
insert into pfolio_data values('','2','4','Je trouve des indices avant d\’accorder ma confiance aux informations et propositions que la machine me fournit.','N','O');
insert into pfolio_data values('','3','1','Je sais produire et modifier un texte, une image ou un son.','N','O');
insert into pfolio_data values('','3','2','Je sais saisir les caractères en minuscules, en majuscules, les différentes lettres accentuées et les signes de ponctuation.','N','O');
insert into pfolio_data values('','3','3','Je sais modifier la mise en forme des caractères et des paragraphes.','N','O');
insert into pfolio_data values('','3','4','Je sais utiliser les fonctions copier, couper, coller, insérer, glisser, déposer.','N','O');
insert into pfolio_data values('','3','5','Je sais regrouper dans un même document du texte ou des images ou du son.','N','O');
insert into pfolio_data values('','3','6','Je sais imprimer un document.','N','O');
insert into pfolio_data values('','4','1','Je sais utiliser les fenêtres, ascenseurs, boutons de défilement, liens, listes déroulantes, icônes et onglets.','N','O');
insert into pfolio_data values('','4','2','Je sais repérer les informations affichées à l\'écran.','N','O');
insert into pfolio_data values('','4','3','Je sais saisir une adresse internet et naviguer dans un site.','N','O');
insert into pfolio_data values('','4','4','Je sais utiliser un mot-clé ou un menu pour faire une recherche.','N','O');
insert into pfolio_data values('','5','1','Je sais envoyer et recevoir un message.','N','O');
insert into pfolio_data values('','5','2','Je sais dire de qui provient un message et à qui il est adressé.','N','O');
insert into pfolio_data values('','5','3','Je sais trouver le sujet d\’un message.','N','O');
insert into pfolio_data values('','5','4','Je sais trouver la date d\'envoi d\'un message.','N','O');
## B2i niv 2 ##
insert into pfolio_data values('','6','1','Je sais m\'identifier sur un réseau ou un site et mettre fin à cette identification.','N','O');
insert into pfolio_data values('','6','2','Je sais accéder aux logiciels et aux documents disponibles à partir de mon espace de travail.','N','O');
insert into pfolio_data values('','6','3','Je sais organiser mes espaces de stockage.','N','O');
insert into pfolio_data values('','6','4','Je sais lire les propriétés d\'un fichier : nom, format, taille, dates de création et de dernière modification.','N','O');
insert into pfolio_data values('','6','5','Je sais paramétrer l’impression (prévisualisation, quantité, partie de documents…).','N','O');
insert into pfolio_data values('','6','6','Je sais faire un autre choix que celui proposé par défaut (lieu d\’enregistrement, format, imprimante…).','N','O');
insert into pfolio_data values('','7','1','Je connais les droits et devoirs indiqués dans la charte d’usage des TIC et la procédure d\'alerte de mon établissement.','N','O');
insert into pfolio_data values('','7','2','Je protège ma vie privée en ne donnant sur internet des renseignements me concernant qu’avec l’accord de mon responsable légal.','N','O');
insert into pfolio_data values('','7','3','Lorsque j’utilise ou transmets des documents, je vérifie que j’en ai le droit.','N','O');
insert into pfolio_data values('','7','4','Je m\'interroge sur les résultats des traitements informatiques (calcul, représentation graphique, correcteur...).','N','O');
insert into pfolio_data values('','7','5','J’applique des règles de prudence contre les risques de malveillance (virus, spam...).','N','O');
insert into pfolio_data values('','7','6','Je sécurise mes données (gestion des mots de passe, fermeture de session, sauvegarde). ','N','O');
insert into pfolio_data values('','7','7','Je mets mes compétences informatiques au service d\'une production collective.','N','O');
insert into pfolio_data values('','8','1','Je sais modifier la mise en forme des caractères et des paragraphes, paginer automatiquement.','N','O');
insert into pfolio_data values('','8','2','Je sais utiliser l’outil de recherche et de remplacement dans un document.','N','O');
insert into pfolio_data values('','8','3','Je sais regrouper dans un même document plusieurs éléments (texte, image, tableau, son, graphique, vidéo…).','N','O');
insert into pfolio_data values('','8','4','Je sais créer, modifier une feuille de calcul, insérer une formule.','N','O');
insert into pfolio_data values('','8','5','Je sais réaliser un graphique de type donné.','N','O');
insert into pfolio_data values('','8','6','Je sais utiliser un outil de simulation (ou de modélisation) en étant conscient de ses limites.','N','O');
insert into pfolio_data values('','8','7','Je sais traiter un fichier image ou son à l’aide d’un logiciel dédié notamment pour modifier ses propriétés élémentaires.','N','O');
insert into pfolio_data values('','9','1','Je sais rechercher des références de documents à l’aide du logiciel documentaire présent au CDI.','N','O');
insert into pfolio_data values('','9','2','Je sais utiliser les fonctions principales d\'un logiciel de navigation sur le web (paramétrage, gestion des favoris, gestion des affichages et de l\'impression).','N','O');
insert into pfolio_data values('','9','3','je sais utiliser les fonctions principales d\'un outil de recherche sur le web (moteur de recherche, annuaire...).','N','O');
insert into pfolio_data values('','9','4','Je sais relever des éléments me permettant de connaître l’origine de l’information (auteur, date, source…).','N','O');
insert into pfolio_data values('','9','5','Je sais sélectionner des résultats lors d\'une recherche (et donner des arguments permettant de justifier mon choix).','N','O');
insert into pfolio_data values('','10','1','Lorsque j\'envoie ou je publie des informations, je réfléchis aux lecteurs possibles en fonction de l\'outil utilisé.','N','O');
insert into pfolio_data values('','10','2','Je sais ouvrir et enregistrer un fichier joint à un message ou à une publication.','N','O');
insert into pfolio_data values('','10','3','Je sais envoyer ou publier un message avec un fichier joint.','N','O');
insert into pfolio_data values('','10','4','Je sais utiliser un carnet d’adresses ou un annuaire pour choisir un destinataire.','N','O');
## B2i niv 3 ##
insert into pfolio_data values('','11','1','Je sais choisir les services, matériels et logiciels adaptés à mes besoins.','N','O');
insert into pfolio_data values('','11','2','Je sais structurer mon environnement de travail.','N','O');
insert into pfolio_data values('','11','3','Je sais régler les principaux paramètres de fonctionnement d\'un périphérique selon mes besoins. ','N','O');
insert into pfolio_data values('','11','4','Je sais personnaliser un logiciel selon mes besoins.','N','O');
insert into pfolio_data values('','11','5','Je sais m’affranchir des fonctions automatiques des logiciels (saisie, mémorisation mot de passe, correction orthographique, incrémentation…).','N','O');
insert into pfolio_data values('','11','6','Je sais utiliser une plate-forme de travail de groupe.','N','O');																																																																																																																																																																																																																																																														
insert into pfolio_data values('','12','1','Je connais la charte d\'usage des TIC de mon établissement.','N','O');
insert into pfolio_data values('','12','2','Je protège ma vie privée en réfléchissant aux informations personnelles que je communique.','N','O');
insert into pfolio_data values('','12','3','J\'utilise les documents ou les logiciels dans le respect des droits d’auteurs et de propriété.','N','O');
insert into pfolio_data values('','12','4','Je valide, à partir de critères définis, les résultats qu\'un traitement automatique me fournit (calcul, représentation graphique, correcteur...).','N','O');
insert into pfolio_data values('','12','5','Je suis capable de me référer en cas de besoin à la réglementation en vigueur sur les usages numériques.','N','O');
insert into pfolio_data values('','12','6','Je sais que l’on peut connaître mes opérations et accéder à mes données lors de l’utilisation d’un environnement informatique.','N','O');
insert into pfolio_data values('','12','7','Je mets mes compétences informatiques à la disposition des autres. ','N','O');
insert into pfolio_data values('','13','1','Je sais créer et modifier un document numérique composite transportable et publiable. ','N','O');
insert into pfolio_data values('','13','2','Je sais insérer automatiquement des informations dans un document (notes de bas de page, sommaire…). ','N','O');
insert into pfolio_data values('','13','3','Je sais utiliser des outils permettant de travailler à plusieurs sur un même document (outil de suivi de modifications…).','N','O');
insert into pfolio_data values('','13','4','Je sais utiliser ou créer des formules pour traiter les données. ','N','O');
insert into pfolio_data values('','13','5','Je sais produire une représentation graphique à partir d’un traitement de données numériques.  ','N','O');
insert into pfolio_data values('','13','6','Dans le cadre de mes activités scolaires, je sais repérer des exemples de modélisation ou simulation et je sais citer au moins un paramètre qui influence le résultat.','N','O');
insert into pfolio_data values('','13','7','Je sais publier un document numérique sur un espace approprié. ','N','O');
insert into pfolio_data values('','13','8','Je sais utiliser un modèle de document. ','N','O');
insert into pfolio_data values('','14','1','Je sais interroger les bases documentaires à ma disposition.','N','O');
insert into pfolio_data values('','14','2','Je sais utiliser les fonctions avancées des outils de recherche sur internet.','N','O');
insert into pfolio_data values('','14','3','Je sais énoncer des critères de tri d\'informations.','N','O');
insert into pfolio_data values('','14','4','Je sais constituer une bibliographie incluant des documents d’origine numérique.','N','O');
insert into pfolio_data values('','14','5','Je sais utiliser des outils de veille documentaire.','N','O');
insert into pfolio_data values('','15','1','Je sais choisir le service de communication selon mes besoins.','N','O');
insert into pfolio_data values('','15','2','Je sais organiser mes espaces d\'échange (messagerie, travail de groupe…)','N','O');
insert into pfolio_data values('','15','3','Je sais adapter le contenu des informations  transmises aux lecteurs potentiels : niveau de langage, forme, contenu, taille, copies.','N','O');
insert into pfolio_data values('','15','4','Je sais paramétrer un logiciel de messagerie pour récupérer mon courrier électronique.','N','O');
insert into pfolio_data values('','15','5','Je sais gérer des groupes de destinataires.','N','O');
## C2i niv 1 ##
insert into pfolio_data values('','16','1','Etre conscient de l\'évolution constante des TIC  et de la déontologie qui doit leur être associée, et capable d\'en tenir compte dans le cadre des apprentissages.','N','O');
insert into pfolio_data values('','16','2','Prendre conscience des nécessaires actualisations du référentiel du C2i‚ niveau 1.','N','O');
insert into pfolio_data values('','16','3','Travailler dans un esprit d\'ouverture et d\'adaptabilité (adaptabilité aux différents environnements de travail, échanges).','N','O');
insert into pfolio_data values('','16','4','Tenir compte des problèmes de compatibilité, de format de fichier, de norme et procédure de compression et d\'échange.','N','O');
insert into pfolio_data values('','17','1','Respecter les droits fondamentaux de l\'homme, les normes internationales et les lois qui en découlent.','N','O');
insert into pfolio_data values('','17','2','Maîtriser son identité numérique.','N','O');
insert into pfolio_data values('','17','3','Sécuriser les informations sensibles - personnelles et professionnelles -contre les intrusions frauduleuses, les disparitions, les destructions volontaires ou involontaires.','N','O');
insert into pfolio_data values('','17','4','Assurer la protection de la confidentialité.','N','O');
insert into pfolio_data values('','18','1','Organiser et personnaliser son bureau de travail.','N','O');
insert into pfolio_data values('','18','2','Être capable, constamment, de retrouver ses données.','N','O');
insert into pfolio_data values('','18','3','Structurer et gérer une arborescence de fichiers.','N','O');
insert into pfolio_data values('','18','4','Utiliser les outils adaptés (savoir choisir le logiciel qui convient aux objectifs poursuivis).','N','O');
insert into pfolio_data values('','18','5','Maintenir (mise à jour, nettoyage, défragmentation, ...).','N','O');
insert into pfolio_data values('','18','6','Organiser les liens (favoris - signets) dans des dossiers.','N','O');
insert into pfolio_data values('','18','7','Se connecter aux différents types de réseaux (filaires et sans fil).','N','O');
insert into pfolio_data values('','19','1','Distinguer les différents types d\'outils de recherche.','N','O');
insert into pfolio_data values('','19','2','Formaliser les requêtes de recherche.','N','O');
insert into pfolio_data values('','19','3','Récupérer et savoir utiliser les informations (texte, image, son, fichiers, pilote, applications, site, ...).','N','O');
insert into pfolio_data values('','20','1','Rechercher un fichier (par nom, par date, par texte, ...).','N','O');
insert into pfolio_data values('','20','2','Assurer la protection contre les virus.','N','O');
insert into pfolio_data values('','20','3','Protéger ses fichiers et ses dossiers (en lecture/ écriture).','N','O');
insert into pfolio_data values('','20','4','Assurer une sauvegarde (sur le réseau, support externe, ...).','N','O');
insert into pfolio_data values('','20','5','Compresser, décompresser un fichier ou un ensemble de fichiers/dossiers.','N','O');
insert into pfolio_data values('','20','6','Récupérer et transférer des données sur et à partir de terminaux mobiles.','N','O');
insert into pfolio_data values('','21','1','Réaliser des documents courts (CV, lettre, ...).','N','O');
insert into pfolio_data values('','21','2','Élaborer un document complexe et structuré (compte rendu, rapport, mémoire, bibliographie, ...).','N','O');
insert into pfolio_data values('','21','3','Maîtriser les fonctionnalités nécessaires à la structuration de documents complexes (notes de bas de pages, sommaire, index, styles, ...).','N','O');
insert into pfolio_data values('','21','4','Intégrer les informations (images, fichiers, graphiques, ...).','N','O');
insert into pfolio_data values('','21','5','Traiter des données chiffrées dans un tableur (formules arithmétiques et fonctions simples comme la somme et la moyenne, notion et usage de la référence absolue), les présenter sous forme de tableau (mises en forme dont format de nombre et bordures) et sous forme graphique (graphique simple intégrant une ou plusieurs séries).','N','O');
insert into pfolio_data values('','21','6','Créer des schémas (formes géométriques avec texte, traits, flèches et connecteurs, disposition en profondeur, groupes d\'objets, export sous forme d\'image).','N','O');
insert into pfolio_data values('','22','1','Communiquer le résultat de ses travaux en s\'appuyant sur un outil de présentation assistée par ordinateur.','N','O');
insert into pfolio_data values('','22','2','Adapter des documents initialement destinés à être imprimés pour une présentation sur écran.','N','O');
insert into pfolio_data values('','22','3','Réaliser des documents hypermédias intégrant textes, sons, images fixes et animées et liens internes et externes.','N','O');
insert into pfolio_data values('','23','4','le courrier électronique (en-têtes, taille et format des fichiers, organisation des dossiers, filtrage) ;','N','O');
insert into pfolio_data values('','23','5','les listes de diffusion (s\'inscrire, se désabonner) ;','N','O');
insert into pfolio_data values('','23','6','les forums de discussion (modéré, non modéré) ;','N','O');
insert into pfolio_data values('','23','7','le dialogue en temps réel ;','N','O');
insert into pfolio_data values('','23','8','les terminaux mobiles.','N','O');
insert into pfolio_data values('','24','1','Utiliser les outils d\'un espace de travail collaboratif (environnement numérique de travail) ;','N','O');
insert into pfolio_data values('','24','2','Élaborer en commun un document de travail','N','O');
insert into pfolio_data values('','24','3','Gérer différentes versions de documents partagés.','N','O');
## C2i niv 2 : enseignant ##
insert into pfolio_data values('','25','1','Identifier les personnes ressources TIC et leurs rôles respectifs, dans l\'école ou l\'établissement, et en dehors (circonscription, bassin, académie, niveau national...).','N','O');
insert into pfolio_data values('','25','2','S\’approprier différentes composantes informatiques (lieux, outils...) de son environnement professionnel.','N','O');
insert into pfolio_data values('','25','3','Choisir et utiliser les ressources et services d\'un espace numérique de travail (ENT).','N','O');
insert into pfolio_data values('','25','4','Choisir et utiliser les outils les plus adaptés pour communiquer avec les acteurs et usagers du système éducatif.','N','O');
insert into pfolio_data values('','25','5','Se constituer et organiser des ressources en utilisant des sources professionnelles.','N','O');
insert into pfolio_data values('','26','1','Utiliser les ressources en ligne et les dispositifs de formation ouverte et à distance (FOAD) pour sa formation.','N','O');
insert into pfolio_data values('','26','2','Se référer à des travaux de recherche liant didactique et TICE.','N','O');
insert into pfolio_data values('','26','3','Pratiquer une veille pédagogique et institutionnelle, notamment par l\'identification des réseaux d\'échanges concernant son domaine, sa discipline, son niveau d\'enseignement.','N','O');
insert into pfolio_data values('','27','1','Adapter son mode d\'expression et de communication aux différents espaces de diffusion (institutionnel, public, privé, interne, externe...).','N','O');
insert into pfolio_data values('','27','2','Prendre en compte les enjeux et respecter les règles concernant : la recherche et les critères de contrôle de validité, des informations, la sécurité informatique, le filtrage internet, etc…','N','O');
insert into pfolio_data values('','27','3','Prendre en compte les lois et les exigences d\'une utilisation professionnelle et citoyenne des TICE concernant la protection des libertés individuelles et de la sécurité des personnes, notamment: la protection des mineurs, la confidentialité des données,  la propriété intellectuelle,  le droit à l\'image, etc...','N','O');
insert into pfolio_data values('','27','4','Respecter et faire respecter la charte d\'usage de l\'établissement, dans une perspective éducative d\'apprentissage de la citoyenneté.','N','O');
insert into pfolio_data values('','28','1','Rechercher, produire, partager et mutualiser des documents, des informations, des ressources dans un environnement numérique.','N','O');
insert into pfolio_data values('','28','2','Contribuer à une production ou à un projet collectif au sein d\'équipes disciplinaires, interdisciplinaires, transversales ou éducatives.','N','O');
insert into pfolio_data values('','28','3','Concevoir des situations de recherche d\'information dans le cadre des projets transversaux et interdisciplinaires.','N','O');
insert into pfolio_data values('','29','1','Identifier les situations d\'apprentissage propices à l\'utilisation des TICE.','N','O');
insert into pfolio_data values('','29','2','Concevoir des situations d\'apprentissage mettant en œuvre des logiciels généraux ou spécifiques à la discipline, au domaine enseigné, au niveau de classe.','N','O');
insert into pfolio_data values('','29','3','Rechercher et intégrer des outils et des ressources dans une séquence d\'enseignement, en opérant des choix entre les supports et médias utilisables et leurs modalités d\'utilisation.','N','O');
insert into pfolio_data values('','29','4','Préparer des ressources adaptées à la diversité des publics et des situations pédagogiques en respectant les règles de la communication.','N','O');
insert into pfolio_data values('','30','1','Conduire des situations d\'apprentissage en tirant parti du potentiel des TIC : travail collectif, individualisé, en petits groupes, recherche documentaire.','N','O');
insert into pfolio_data values('','30','2','Gérer l\'alternance entre les activités utilisant les TICE et celles qui n’y ont pas recours.','N','O');
insert into pfolio_data values('','30','3','Prendre en compte la diversité des élèves, la difficulté scolaire en utilisant les TICE pour gérer des temps de travail différenciés.','N','O');
insert into pfolio_data values('','30','4','Utiliser les TICE pour accompagner des élèves, des groupes d\'élèves dans leurs projets de production ou de recherche d\'information.','N','O');
insert into pfolio_data values('','30','5','Prendre une décision pédagogique pertinente face à un incident technique.','N','O');
insert into pfolio_data values('','31','1','Identifier les compétences des référentiels TIC (B2i ou C2i) mises en œuvre dans une situation de formation proposée aux élèves, aux étudiants.','N','O');
insert into pfolio_data values('','31','2','S\’intégrer dans une démarche collective d\'évaluation des compétences TIC.','N','O');
insert into pfolio_data values('','31','3','Exploiter les résultats produits par des logiciels institutionnels d\'évaluation des élèves.','N','O');
## C2i niv 2 : droit ##
insert into pfolio_data values('','32','1','Enjeux de la régulation des technologies de l’information et de la communication.','N','O');
insert into pfolio_data values('','32','2','Identification des droits et des obligations générales et professionnelles et des règles déontologiques et éthiques.','N','O');
insert into pfolio_data values('','32','3','Conséquences sociales et économiques sur l’exercice des professions liées au Droit et aux structures professionnelles, adaptation à l’évolution du contexte professionnel.','N','O');
insert into pfolio_data values('','32','4','Modification des pratiques juridiques (cyberjustice…) et des conceptions du droit.','N','O');
insert into pfolio_data values('','32','5','Connaissance des services, des outils offerts, des opérateurs du marché.','N','O');
insert into pfolio_data values('','32','6','Éléments de prospective : suivi des évolutions (veille et actualisation).','N','O');
insert into pfolio_data values('','33','1','Appréhender le fonctionnement d’un système de gestion de données.','N','O');
insert into pfolio_data values('','33','2','Utiliser les techniques de requêtes.','N','O');
insert into pfolio_data values('','33','3','Évaluer et  valider l’information.','N','O');
insert into pfolio_data values('','33','4','Constituer une base de documentation personnelle.','N','O');
insert into pfolio_data values('','33','5','Traiter des résultats (interprétation, analyse et synthèse).','N','O');
insert into pfolio_data values('','34','1','Sécuriser ses données (niveaux et méthodes, outils).','N','O');
insert into pfolio_data values('','34','2','Échanger des données en toute sécurité.','N','O');
insert into pfolio_data values('','34','3','Conserver de façon pérenne ses données.','N','O');
insert into pfolio_data values('','35','1','Adopter un comportement responsable conforme aux exigences légales concernant en particulier : la protection des données personnelles, le droit au secret des correspondances, la propriété intellectuelle des contenus numériques, la protection des libertés individuelles (employés, clients, tiers…), l’écrit et la signature électronique (forme et valeur probatoire), la responsabilité liée à l’édition en ligne (mentions obligatoires et délits de presse).','N','O');
insert into pfolio_data values('','35','2','Respecter les devoirs déontologiques liés aux TIC.','N','O');
insert into pfolio_data values('','36','1','Rédiger des documents et des actes en commun.','N','O');
insert into pfolio_data values('','36','2','Constituer et gérer un groupe via l’Internet.','N','O');
insert into pfolio_data values('','36','3','Gérer des projets et des dossiers en réseau.','N','O');
insert into pfolio_data values('','37','1','Utiliser les téléprocédures administratives (déclarations fiscales et sociales, cadastre, état civil, casier judiciaire…).','N','O');
insert into pfolio_data values('','37','2','Utiliser les systèmes d’échanges judiciaires (greffe électronique des tribunaux civils, pénaux et de commerce, échange de conclusions,…).','N','O');
insert into pfolio_data values('','37','3','Élaborer des actes électroniques.','N','O');
insert into pfolio_data values('','37','4','Élaborer des actes authentiques électroniques.','N','O');
insert into pfolio_data values('','38','1','Utiliser et enrichir un clausier électronique.','N','O');
insert into pfolio_data values('','38','2','Être sensibilisé à l’usage des outils d’aide à la décision.','N','O');
insert into pfolio_data values('','38','3','Être sensibilisé à l’usage des outils d’analyse statistique et sémantique du contentieux.','N','O');
## C2i niv 2 : santé ##
insert into pfolio_data values('','39','1','Identifier et savoir utiliser classifications, thesaurus et codifications de l\’information en santé.','N','O');
insert into pfolio_data values('','39','2','Identifier les sources électroniques d\’information spécialisées et professionnelles en santé.','N','O');
insert into pfolio_data values('','39','3','Rechercher des informations en santé sur internet.','N','O');
insert into pfolio_data values('','39','4','Évaluer la qualité de l\’information en santé sur internté.','N','O');
insert into pfolio_data values('','39','5','Mettre en oeuvre une veille documentaire.','N','O');
insert into pfolio_data values('','40','1','Respecter les principes généraux de protection des libertés individuelles.','N','O');
insert into pfolio_data values('','40','2','Respecter les différentes règles encadrant le secret professionnel et déontologique.','N','O');
insert into pfolio_data values('','40','3','Respecter les règles relatives à l\’informatisation des données personnelles et définies par la loi "informatique et libertés".','N','O');
insert into pfolio_data values('','40','4','Respecter les principes généraux de l\’information du patient et du droit d’accès aux données de santé.','N','O');
insert into pfolio_data values('','40','5','Respecter les règles relatives à la pérennité de l\’information numérique en santé.','N','O');
insert into pfolio_data values('','40','6','Respecter les règles et pratiques spécifiques relatives à la propriété intellectuelle des contenus numériques.','N','O');
insert into pfolio_data values('','40','7','Appliquer les règles juridiques relatives à l\’informatisation des données de santé.','N','O');
insert into pfolio_data values('','40','8','Appliquer la procédure de déclaration d\’un fichier nominatif à la Commission nationale informatique et libertés (CNIL).','N','O');
insert into pfolio_data values('','40','9','Appliquer les règles d\’anonymisation des fichiers et/ou documents numériques.','N','O');
insert into pfolio_data values('','41','1','Évaluer les risques liés aux défauts de sécurité.','N','O');
insert into pfolio_data values('','41','2','Comprendre les méthodes de sécurisation des données et des échanges.','N','O');
insert into pfolio_data values('','41','3','Protéger l\’intégrité des données.','N','O');
insert into pfolio_data values('','41','4','Évaluer les dispositifs de sécurisation des informations, des supports et des traitements.','N','O');
insert into pfolio_data values('','41','5','Mettre en oeuvre des méthodes de sécurisation des données et des échanges.','N','O');
insert into pfolio_data values('','42','1','Identifier les exigences technologiques liées au travail en réseau.','N','O');
insert into pfolio_data values('','42','2','Mettre en oeuvre une collaboration dans le cadre de ses activités professionnelles.','N','O');
insert into pfolio_data values('','42','3','Apprécier les normes et standards et les technologies permettant l\’interopérabilité et le travail en réseau.','N','O');
insert into pfolio_data values('','42','4','Choisir et utiliser à bon escient les outils d\’échange et de partage de l\’information.','N','O');
insert into pfolio_data values('','42','5','Utiliser des ressources en ligne ou des dispositifs de formation ouverte et à distance.','N','O');
insert into pfolio_data values('','43','1','Maîtriser les éléments fondamentaux du dossier patient .','N','O');
insert into pfolio_data values('','43','2','S\’initier à l\’organisation, la mise en oeuvre et l\’utilisation d\’un système d\’information.','N','O');
insert into pfolio_data values('','43','3','Identifier les circuits d\’informations et gérer les échanges avec l\’extérieur.','N','O');
insert into pfolio_data values('','43','4','Mettre en oeuvre une démarche qualité.','N','O');
insert into pfolio_data values('','43','5','Identifier les éléments clés structurels, fonctionnels et financiers de l\’informatisation de son lieu d\’activité professionnelle.','N','O');
insert into pfolio_data values('','43','6','Gérer les échanges avec l\’administration et entre professionnels.','N','O');
insert into pfolio_data values('','43','7','Mettre en oeuvre des outils d\’optimisation des tâches et des activités.','N','O');
## C2i niv 2 : ingénieur ##
insert into pfolio_data values('','44','1','Maîtriser le contexte juridique et déontologique de la charte inter et intra-entreprises de bonne utilisation des TIC au travail.','N','O');
insert into pfolio_data values('','44','2','Appliquer la législation sur la protection des œuvres numériques, des bases de données et connaître les sanctions pénales et civiles.','N','O');
insert into pfolio_data values('','44','3','Prendre en compte la jurisprudence en ce qui concerne la cybersurveillance des salariés.','N','O');
insert into pfolio_data values('','44','4','Mettre en œuvre, à bon escient, les obligations légales de la CNIL.','N','O');
insert into pfolio_data values('','44','5','Apprécier la valeur juridique d\’un document numérique.','N','O');
insert into pfolio_data values('','44','6','Distinguer les types de licences logicielles et les aspects contractuels de leur exploitation. ','N','O');
insert into pfolio_data values('','44','7','Distinguer les types de responsabilité des acteurs aux plans national et international.','N','O');
insert into pfolio_data values('','45','1','Identifier et hiérarchiser les informations blanches, grises et noires.','N','O');
insert into pfolio_data values('','45','2','Manipuler ces informations, selon le lieu et le mode d’accès, avec les procédures et les outils adéquats.','N','O');
insert into pfolio_data values('','45','3','Maîtriser les processus d\’une politique de sécurité pour participer à sa mise en place.','N','O');
insert into pfolio_data values('','45','4','Distinguer les acteurs de la mise en place de la politique de sécurité et identifier leurs responsabilités légales.','N','O');
insert into pfolio_data values('','45','5','Évaluer les risques accidentels et intentionnels et prendre les dispositions nécessaires.','N','O');
insert into pfolio_data values('','46','1','Appréhender le système d\’information et en comprendre ses enjeux.','N','O');
insert into pfolio_data values('','46','2','Intégrer les outils TIC à la gestion de projets.','N','O');
insert into pfolio_data values('','46','3','Comprendre un document de modélisation de données ou de processus métiers','N','O');
insert into pfolio_data values('','46','4','Prendre en compte les aspects de l\’accessibilité. ','N','O');
insert into pfolio_data values('','46','5','Respecter les exigences de l\’interopérabilité.','N','O');
insert into pfolio_data values('','47','1','Pratiquer les outils d\’ingénierie collaborative de la conception à l\’exploitation d\’un processus ou d\’un produit.','N','O');
insert into pfolio_data values('','47','2','Animer un espace collaboratif et mettre en œuvre les bonnes pratiques et le contexte d\’usage des outils synchrones et asynchrones.','N','O');
insert into pfolio_data values('','47','3','Assurer la bonne gestion des documents et le cycle de vie. ','N','O');
insert into pfolio_data values('','47','4','Maîtriser les contraintes de travail connecté ou déconnecté et maîtriser la configuration et la sécurité de son accès réseau.','N','O');
## B2i adultes ##
insert into pfolio_data values('','48','1','Connaître le vocabulaire spécifique et maîtriser les éléments matériels et logiciels de base. ','N','O');
insert into pfolio_data values('','48','2','Gérer et organiser les fichiers, identifier leurs propriétés et caractéristiques. ','N','O');
insert into pfolio_data values('','48','3','Organiser, personnaliser et gérer un environnement informatique. ','N','O');
insert into pfolio_data values('','48','4','Se connecter et s\'identifier sur différents types de réseaux. ','N','O');
insert into pfolio_data values('','49','1','Connaître les règles d\'usage et les dangers liés aux réseaux et aux échanges de données. ','N','O');
insert into pfolio_data values('','49','2','Connaître les droits et obligations relatifs à l\'utilisation de l\'informatique et d\'internet. ','N','O');
insert into pfolio_data values('','49','3','Protéger les informations concernant sa personne et ses données. ','N','O');
insert into pfolio_data values('','49','4','Prendre part à la société de l\'information dans ses dimensions administratives et citoyennes. ','N','O');
insert into pfolio_data values('','50','1','Concevoir un document : objectif, démarche, choix de l\'outil. ','N','O');
insert into pfolio_data values('','50','2','Mettre en œuvre les fonctionnalités de base d\'outils permettant le traitement de textes, de nombres, d\'images et de sons. ','N','O');
insert into pfolio_data values('','50','3','Réaliser un document composite. ','N','O');
insert into pfolio_data values('','50','4','Diffuser un document numérique. ','N','O');
insert into pfolio_data values('','51','1','Consulter de l\'information à partir de différents supports. ','N','O');
insert into pfolio_data values('','51','2','Concevoir une démarche adaptée à l\'objectif de recherche d\'information et la mettre en œuvre. ','N','O');
insert into pfolio_data values('','51','3','Identifier et organiser les informations. ','N','O');
insert into pfolio_data values('','51','4','Évaluer la qualité et la pertinence de l\'information. ','N','O');
insert into pfolio_data values('','51','5','Réaliser une veille informationnelle. ','N','O');
insert into pfolio_data values('','52','1','Utiliser un outil de communication adapté aux besoins. ','N','O');
insert into pfolio_data values('','52','2','Échanger des documents numériques. ','N','O');
insert into pfolio_data values('','52','3','Collaborer en réseau.','N','O');
## PIM ##
insert into pfolio_data values('','53','1','Identifier et mettre en fonction les principaux éléments composant un équipement informatique','N','O');
insert into pfolio_data values('','53','2','Utiliser la souris et le clavier','N','O');
insert into pfolio_data values('','53','3','Naviguer dans son espace de travail','N','O');
insert into pfolio_data values('','54','1','Se repérer dans Internet','N','O');
insert into pfolio_data values('','54','2','S\'informer sur Internet','N','O');
insert into pfolio_data values('','54','3','Utiliser des services en ligne','N','O');
insert into pfolio_data values('','55','1','Ouvrir un compte de messagerie électronique','N','O');
insert into pfolio_data values('','55','2','Utiliser une messagerie électronique','N','O');
insert into pfolio_data values('','55','3','Utiliser des outils d\'échange et de dialogue','N','O');
insert into pfolio_data values('','56','1','Créer et mettre en forme un texte court','N','O');
insert into pfolio_data values('','56','2','Utiliser des images','N','O');
insert into pfolio_data values('','56','3','Diffuser un document numérique','N','O');
insert into pfolio_data values('','57','1','Connaître les règles élémentaires du droit relatif à l\'informatique et à Internet','N','O');
insert into pfolio_data values('','57','2','Connaître les règles de bon usage d\'Internet','N','O');
insert into pfolio_data values('','57','3','Protéger sa personne et ses données','N','O');
## DEFI niveau 1 ##
insert into pfolio_data values('','58','1','Allumer un ordinateur et mettre hors tension un ordinateur','N','O');
insert into pfolio_data values('','58','2','Utiliser la souris et quelques commandes claviers élémentaires','N','O');
insert into pfolio_data values('','58','3','Utiliser quelques commandes claviers plus complexes (telles que la saisie du caractère « euro »)','N','O');
insert into pfolio_data values('','58','4','Désigner correctement, à partir d\'un vocabulaire de base, les composants matériels et logiciels d\'un ordinateur connecté à l\'internet.','N','O');
insert into pfolio_data values('','58','5','Manipuler les fenêtres (réduire, agrandir, fermer une fenêtre, retrouver une fenêtre qui est en arrière plan)','N','O');
insert into pfolio_data values('','58','6','Ouvrir un fichier existant, imprimer un document, enregistrer un document, supprimer, déplacer des fichiers','N','O');
insert into pfolio_data values('','58','7','Différencier un fichier et un dossier','N','O');
insert into pfolio_data values('','58','8','reconnaître quelques icônes d\'applications et de documents','N','O');
insert into pfolio_data values('','58','9','Établir et mettre fin à une connexion à distance déjà paramétrée','N','O');
insert into pfolio_data values('','58','10','Comprendre les notions intranet/internet','N','O');

insert into pfolio_data values('','59','1','saisir ou modifier un texte sans mise en forme','N','O');
insert into pfolio_data values('','59','2','effectuer une mise en forme simple','N','O');
insert into pfolio_data values('','59','3','utiliser le correcteur orthographique','N','O');
insert into pfolio_data values('','59','4','effectuer les 4 opérations à l\'aide d\'un tableur','N','O');

insert into pfolio_data values('','60','1','Adresser, recevoir, imprimer un message électronique, y répondre ou le rediriger, au moyen du logiciel de messagerie habituel, déjà configuré,','N','O');
insert into pfolio_data values('','60','2','Recevoir et exploiter un fichier comme pièce jointe (ou attachée) dans un format qui permet d\'ouvrir le fichier directement','N','O');
insert into pfolio_data values('','60','3','Comprendre l\'adresse mél :','N','O');
insert into pfolio_data values('','60','4','Faire la différence entre une adresse mél et un site Web','N','O');
insert into pfolio_data values('','60','5','Distinguer une adresse personnelle d\'une adresse fonctionnelle','N','O');
insert into pfolio_data values('','60','6','Repérer une adresse mél invalide (absence d\'@ ; accents ; espace)','N','O');
insert into pfolio_data values('','60','7','Comprendre le chemin d\'un message','N','O');
insert into pfolio_data values('','60','8','Adresser un fichier comme pièce jointe (maîtrise simple de la manipulation)','N','O');
insert into pfolio_data values('','60','9','Gérer sa boîte aux lettres (supprimer des messages)','N','O');
insert into pfolio_data values('','60','10','Respecter les règles d\'utilisation de la messagerie','N','O');
insert into pfolio_data values('','60','11','Savoir dans quel cas privilégier la messagerie par rapport aux autres médias','N','O');
insert into pfolio_data values('','60','12','Avoir conscience que l\'usage de la messagerie engage sa responsabilité','N','O');
insert into pfolio_data values('','60','13','Adapter le contenu du message aux capacités de l\'outil (ordre de grandeur)','N','O');
insert into pfolio_data values('','60','14','Remplir l\'objet du message de manière intelligible','N','O');
insert into pfolio_data values('','60','15','Utiliser la signature (s\'identifier) à partir d\'un message','N','O');
insert into pfolio_data values('','60','16','Lire des contributions sur des forums','N','O');

insert into pfolio_data values('','61','1','Naviguer sur le Web en utilisant la souris et les liens hypertextes,','N','O');
insert into pfolio_data values('','61','2','Utiliser les boutons précédent et suivant','N','O');
insert into pfolio_data values('','61','3','Accéder à un site Internet en saisissant son adresse dans la barre d\'adresse du navigateur, (adresse lue dans un document texte par exemple)','N','O');
insert into pfolio_data values('','61','4','Faire la différence entre une page et un site','N','O');
insert into pfolio_data values('','61','5','Imprimer une page d\'un site','N','O');
insert into pfolio_data values('','61','6','Identifier l\'auteur du site et la source d\'information.','N','O');
insert into pfolio_data values('','61','7','Repérer l\'url d\'un site (dans la barre d\'outils, dans la barre d\'état)','N','O');
insert into pfolio_data values('','61','8','Comprendre la structure de l\'url','N','O');
insert into pfolio_data values('','61','9','Repérer un url invalide','N','O');
insert into pfolio_data values('','61','10','Utiliser un moteur de recherche : Faire une recherche simple dans l\'intranet de son ministère','N','O');
insert into pfolio_data values('','61','11','Différencier une page HTML d\'un fichier téléchargé','N','O');
insert into pfolio_data values('','61','12','Savoir télécharger et ouvrir des documents simples (document traitement de texte, rtf, pdf) à partir d\'un site public (ministères, services publics)','N','O');

insert into pfolio_data values('','62','1','Comprendre les enjeux d\'une politique de sécurité','N','O');
insert into pfolio_data values('','62','2','Identifier les risques sur la sécurité par point d\'entrée (disquette, fichier joint, accès à l\'ordinateur)','N','O');
insert into pfolio_data values('','62','3','Comprendre et respecter les principales règles de sécurité et les procédures d\'organisation','N','O');
insert into pfolio_data values('','62','4','Connaissance des articles du code pénal relatif aux atteintes aux systèmes de traitement automatisé des données, au secret des correspondances, à la propriété intellectuelle','N','O');
insert into pfolio_data values('','62','5','Gestion des mots de passe','N','O');
insert into pfolio_data values('','62','6','Adopter une attitude responsable vis à vis de la sécurité dans l\'utilisation quotidienne de son poste de travail.','N','O');
insert into pfolio_data values('','62','7','avoir une posture appropriée lorsqu\'on utilise un ordinateur (fatigue, posture, durée d\'utilisation)','N','O');

insert into pfolio_data values('','63','1','Connaître les principales dispositions juridiques relatives à la protection des données personnelles : les droits (information, accès, rectification, opposition, etc.)','N','O');
insert into pfolio_data values('','63','2','Être à même d\'identifier quelles informations relèvent des données personnelles.','N','O');
insert into pfolio_data values('','63','3','Adopter une attitude critique vis à vis des sites qui demandent des informations nominatives.','N','O');
insert into pfolio_data values('','63','4','Droit de la messagerie électronique : connaître le caractère privé de la communication par mél, le secret des correspondances,','N','O');
insert into pfolio_data values('','63','5','Savoir que l\'on est responsable en cas d\'utilisation de logiciels piratés ou de contenus protégés,','N','O');
insert into pfolio_data values('','63','6','Identifier les contenus illicites (pédophilie, nazisme, incitation à la haine raciale…)','N','O');
insert into pfolio_data values('','63','7','Connaître le caractère répréhensible de certains types de contenus et savoir ce que l\'on encourt à les utiliser','N','O');

insert into pfolio_data values('','64','1','Développement des services d\'information de l\'usager','N','O');
insert into pfolio_data values('','64','2','Développement des téléservices','N','O');
insert into pfolio_data values('','64','3','Simplifications administratives','N','O');
insert into pfolio_data values('','64','4','savoir où trouver les vraies informations','N','O');
insert into pfolio_data values('','64','5','Savoir distinguer un site relevant du service public d\'un site privé (.com, .org)','N','O');
insert into pfolio_data values('','64','6','reconnaître le domaine gouv.fr','N','O');
insert into pfolio_data values('','64','7','Savoir utiliser le portail de l\'administration (service-public.fr) pour rechercher','N','O');
insert into pfolio_data values('','64','8','des informations d\'actualité','N','O');
insert into pfolio_data values('','64','9','des informations pratiques','N','O');
insert into pfolio_data values('','64','10','des informations juridiques','N','O');
insert into pfolio_data values('','64','11','des formulaires','N','O');
insert into pfolio_data values('','64','12','des téléservices','N','O');
insert into pfolio_data values('','64','13','les coordonnées des services','N','O');
insert into pfolio_data values('','64','14','Connaître quelques sites publics importants (Elysée, Parlement, Premier Ministre, Journal Officiel, Légifrance…) et savoir les utiliser.','N','O');
insert into pfolio_data values('','64','15','Connaître les types de contenu et les grandes rubriques de l\'intranet d\'un service ou d\'un ministère','N','O');
insert into pfolio_data values('','64','16','Identifier différents acteurs et leur rôle (webmestres, responsables réseau, responsable sécurité…)','N','O');
insert into pfolio_data values('','64','17','Connaître les grands principes d\'utilisation des TIC par les organisations syndicales dans la fonction publique.','N','O');
## DEFI niveau 2 ##
insert into pfolio_data values('','65','1','Savoir mettre en ligne des documents de façon élémentaire','N','O');
insert into pfolio_data values('','65','2','règles de nommage','N','O');
insert into pfolio_data values('','65','3','types de fichiers (formats de fichiers)','N','O');
insert into pfolio_data values('','65','4','les logiciels à utiliser','N','O');
insert into pfolio_data values('','65','5','les processus de publication : Savoir utiliser un éditeur HTML simple et mettre une page en ligne','N','O');

insert into pfolio_data values('','66','1','Écrire à plusieurs destinataires (avec sa messagerie, au moyen d\'une liste de diffusion ou à l\'aide de son carnet d\'adresses)','N','O');
insert into pfolio_data values('','66','2','Gérer son carnet d\'adresses','N','O');
insert into pfolio_data values('','66','3','Gérer sa boite aux lettres (Trier ses messages, organiser ses dossiers)','N','O');
insert into pfolio_data values('','66','4','Recevoir et exploiter un fichier comme pièce jointe dans un format compressé','N','O');
insert into pfolio_data values('','66','5','Sauvegarder une pièce jointe','N','O');
insert into pfolio_data values('','66','6','Identifier les ordres de grandeur de tailles de fichiers pouvant être envoyés en pièce jointe','N','O');
insert into pfolio_data values('','66','7','Connaître la notion de « SPAM » (messages électroniques non sollicités) et les règles pour l\'éviter','N','O');
insert into pfolio_data values('','66','8','Rendre les pièces jointes exploitables par les destinataires','N','O');
insert into pfolio_data values('','66','9','Utiliser avec pertinence l\'envoi multiple','N','O');
insert into pfolio_data values('','66','10','Écrire des contributions sur des forums','N','O');
insert into pfolio_data values('','66','11','Respecter les règles de participation à des forums','N','O');

insert into pfolio_data values('','67','1','Garder l\'adresse d\'un site au moyen des favoris ou signets,','N','O');
insert into pfolio_data values('','67','2','Utiliser un moteur de recherche','N','O');
insert into pfolio_data values('','67','3','Élaborer une stratégie de recherche (faire la différence entre un moteur de recherche et un annuaire)','N','O');
insert into pfolio_data values('','67','4','Connaissance approfondie de l\'Internet','N','O');

insert into pfolio_data values('','68','1','Connaître le rôle des cookies','N','O');
insert into pfolio_data values('','68','2','Savoir que l\'on peut les activer et les désactiver sur son poste','N','O');
insert into pfolio_data values('','68','3','Connaître les rôles des dispositifs de protection (pare-feux, antivirus, cryptographie, sites internet sécurisés)','N','O');
insert into pfolio_data values('','68','4','Comprendre les principaux dispositifs d\'authentification et les principes de la signature électronique','N','O');

insert into pfolio_data values('','69','1','Les obligations (déclaration des traitements, principe de finalité…)','N','O');
insert into pfolio_data values('','69','2','Caractère public de la communication sur des forums','N','O');
insert into pfolio_data values('','69','3','Propriété intellectuelle (Droit d\'auteur, protection des logiciels…)','N','O');
insert into pfolio_data values('','69','4','Reconnaître quelques exemples pratiques de ce que l\'on peut faire et ne pas faire','N','O');

insert into pfolio_data values('','70','1','La dématérialisation des procédures','N','O');
insert into pfolio_data values('','70','2','Connaître quelques contenus des SIT (systèmes d\'information territoriaux)','N','O');
insert into pfolio_data values('','70','3','Savoir utiliser le méta-annuaire Maia','N','O');
insert into pfolio_data values('','70','4','retrouver l\'adresse mél d\'un correspondant dans le méta annuaire Maia','N','O');
insert into pfolio_data values('','70','5','Connaître les grandes fonctionnalités de CELIA (ou DOLCE) (outil de gestion de communautés virtuelles sur ADER et Internet)','N','O');
## NSI ##
insert into pfolio_data values('','71','1','établir la connexion à Internet','N','O');
insert into pfolio_data values('','71','2','utiliser les principales fonctionnalités d\'un navigateur','N','O');
insert into pfolio_data values('','71','3','circuler dans l\'architecture du réseau (la toile)','N','O');
insert into pfolio_data values('','71','4','organiser un “ bureau virtuel ” en classant les sites favoris en fonction des thématiques recherchées','N','O');

insert into pfolio_data values('','72','1','comprendre et utiliser le vocabulaire spécifique et les usages (Netiquette) facilitant l\'intégration dans la communauté des internautes','N','O');
insert into pfolio_data values('','72','2','utiliser le courrier électronique dans ses principales fonctionnalités','N','O');
insert into pfolio_data values('','72','3','télécharger les fichiers joints en organisant son disque dur','N','O');
insert into pfolio_data values('','72','4','participer à des forums et à des news groups','N','O');
insert into pfolio_data values('','72','5','connaître les fonctions et les usages de la communication synchrone (le “ chat ”)','N','O');

insert into pfolio_data values('','73','1','organiser sa question pour obtenir la réponse adaptée','N','O');
insert into pfolio_data values('','73','2','obtenir des résultats satisfaisants à la question posée en utilisant les fonctions simples et thématiques d\'un moteur de recherche','N','O');
insert into pfolio_data values('','73','3','savoir quand et comment solliciter la communauté des internautes (principalement par l\'utilisation des forums) pour affiner sa recherche ou contribuer soi même.','N','O');
###############################################################################