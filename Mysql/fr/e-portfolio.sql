##############################################################################
#    Copyright (c) 2002-2006 by Dominique Laporte (C-E-D@wanadoo.fr)         #
#                                                                            #
#    This file is part of Prom�th�e.                                         #
#                                                                            #
#    Prom�th�e is free software: you can redistribute it and/or modify       #
#    it under the terms of the GNU General Public License as published by    #
#    the Free Software Foundation, either version 3 of the License, or       #
#    (at your option) any later version.                                     #
#                                                                            #
#    Prom�th�e is distributed in the hope that it will be useful,            #
#    but WITHOUT ANY WARRANTY; without even the implied warranty of          #
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the           #
#    GNU General Public License for more details.                            #
#                                                                            #
#    You should have received a copy of the GNU General Public License       #
#    along with Prom�th�e.  If not, see <http://www.gnu.org/licenses/>.      #
##############################################################################


use `##DATABASE##`;


###############################################################################
# cr�ation de la dba des formations
###############################################################################
insert into pfolio_formation values('1','B2i-C2i','Attestation du Brevet Informatique et Internet','fr');
insert into pfolio_formation values('2','PIM, DEFI, NSI','Comp�tences Informatique et Internet','fr');
insert into pfolio_formation values('3','6�me',   'Niveau coll�ge - 6�me','fr');
insert into pfolio_formation values('4','5�me',   'Niveau coll�ge - 5�me','fr');
insert into pfolio_formation values('5','4�me',   'Niveau coll�ge - 4�me','fr');
insert into pfolio_formation values('6','3�me',   'Niveau coll�ge - 3�me','fr');
###############################################################################
# cr�ation de la dba des modalit�s d'�valuations des comp�tences
###############################################################################
insert into pfolio_eval values('1', 'Evaluation 3 niveaux','fr');
insert into pfolio_eval values('2', 'Evaluation Tout ou Rien','fr');
insert into pfolio_eval values('3', 'Evaluation ENFA','fr');
insert into pfolio_eval values('4', 'Evaluation code couleur','fr');
###############################################################################
# cr�ation de la dba des niveaux des �valuations des comp�tences
###############################################################################
insert into pfolio_level values('1',  '1', '#0000FF', 'A',  'comp�tence acquise : je connais parfaitement les notions et sais effectuer les op�rations seul.', 'fr');
insert into pfolio_level values('2',  '1', '#00FF00', 'B',  'comp�tence � renforcer : je connais les notions et sais effectuer les op�rations avec quelques conseils.', 'fr');
insert into pfolio_level values('3',  '1', '#FF0000', 'C',  'comp�tence en cours d\'acquisition : je sais effectuer les op�rations � l\'aide d\'un mode op�ratoire.', 'fr');
insert into pfolio_level values('4',  '2', '#00FF00', 'OK', 'comp�tence acquise.', 'fr');
insert into pfolio_level values('5',  '2', '#FF0000', 'N/A','comp�tence non acquise.', 'fr');
insert into pfolio_level values('6',  '3', '#0000FF', '5',  'appropriation totale, transposable dans un nouveau contexte.', 'fr');
insert into pfolio_level values('7',  '3', '#0000FF', '4',  'ma�trise dans un contexte connu.', 'fr');
insert into pfolio_level values('8',  '3', '#0000FF', '3',  'appropriation en cours.', 'fr');
insert into pfolio_level values('9',  '3', '#0000FF', '2',  'initiation en cours.', 'fr');
insert into pfolio_level values('10', '3', '#0000FF', '1',  'comp�tence connue (le stagiaire en a entendu parler).', 'fr');
insert into pfolio_level values('11', '4', '#0000FF', '5',  'comp�tence ma�tris�e.', 'fr');
insert into pfolio_level values('12', '4', '#00FF00', '4',  'comp�tence bien assimil�e.', 'fr');
insert into pfolio_level values('13', '4', '#FFFF00', '3',  'comp�tence � renforcer.', 'fr');
insert into pfolio_level values('14', '4', '#FF6400', '2',  'comp�tence mal ma�tris�e.', 'fr');
insert into pfolio_level values('15', '4', '#FF0000', '1',  'comp�tence peu d�velopp�e.', 'fr');
###############################################################################
# cr�ation de la dba des Unit�s de Valeur
###############################################################################
insert into pfolio_uv values('','1','10','0','0','255','B2i niveau 1','Brevet Informatique et Internet - primaire',' 1 2 3 ','1','N','N','N','80','fr');
insert into pfolio_uv values('','1','10','0','0','255','B2i niveau 2','Brevet Informatique et Internet - coll�ge',' 1 2 3 ','1','N','N','N','80','fr');
insert into pfolio_uv values('','1','10','0','0','255','B2i niveau 3','Brevet Informatique et Internet - lyc�e',' 1 2 3 ','1','N','N','N','80','fr');
insert into pfolio_uv values('','1','10','0','0','255','C2i niveau 1','Comp�tences Informatique et Internet - socle commun','','1','N','N','N','80','fr');
insert into pfolio_uv values('','1','10','0','0','255','C2i niveau 2 enseignement','Comp�tences Informatique et Internet - sp�cifique enseignant','','1','N','N','N','80','fr');
insert into pfolio_uv values('','1','10','0','0','255','C2i niveau 2 droit','Comp�tences Informatique et Internet - sp�cifique m�tiers du droit','','1','N','N','N','80','fr');
insert into pfolio_uv values('','1','10','0','0','255','C2i niveau 2 sant�','Comp�tences Informatique et Internet - sp�cifique m�tiers de la sant�','','1','N','N','N','80','fr');
insert into pfolio_uv values('','1','10','0','0','255','C2i niveau 2 ing�nieur','Comp�tences Informatique et Internet - sp�cifique m�tiers de l\'ing�nieur','','1','N','N','N','80','fr');
insert into pfolio_uv values('','1','10','0','0','255','B2i adultes','Brevet Informatique et Internet - pour adultes','','1','N','N','N','80','fr');
insert into pfolio_uv values('','2','10','0','0','255','PIM','Passeport pour l\'Internet et le Multim�dia','','1','N','N','N','80','fr');
insert into pfolio_uv values('','2','10','0','0','255','DEFI niveau 1','D�marche d\'Evaluation du Fonctionnaire Internaute','','1','N','N','N','80','fr');
insert into pfolio_uv values('','2','10','0','0','255','DEFI niveau 2','D�marche d\'Evaluation du Fonctionnaire Internaute','','1','N','N','N','80','fr');
insert into pfolio_uv values('','2','10','0','0','255','NSI','Naviguer Sur Internet','','1','N','N','N','80','fr');
###############################################################################
# cr�ation de la dba des domaines de comp�tences B2i-C2i
###############################################################################
insert into pfolio values('','1','1','S\'approprier un environnement informatique de travail
','50','O');
insert into pfolio values('','1','2','Adopter une attitude responsable','50','O');
insert into pfolio values('','1','3','Cr�er, produire, traiter, exploiter 
des donn�es','50','O');
insert into pfolio values('','1','4','S\'informer, se documenter','50','O');
insert into pfolio values('','1','5','Communiquer, �changer','50','O');

insert into pfolio values('','2','1','S\'approprier un environnement informatique de travail
','50','O');
insert into pfolio values('','2','2','Adopter une attitude responsable','50','O');
insert into pfolio values('','2','3','Cr�er, produire, traiter, exploiter 
des donn�es','50','O');
insert into pfolio values('','2','4','S\'informer, se documenter','50','O');
insert into pfolio values('','2','5','Communiquer, �changer','50','O');

insert into pfolio values('','3','1','S\'approprier un environnement informatique de travail
','50','O');
insert into pfolio values('','3','2','Adopter une attitude responsable','50','O');
insert into pfolio values('','3','3','Cr�er, produire, traiter, exploiter des donn�es','50','O');
insert into pfolio values('','3','4','S\'informer, se documenter','50','O');
insert into pfolio values('','3','5','Communiquer, �changer','50','O');

insert into pfolio values('','4','1','Comp�tence A1 : Tenir compte du caract�re �volutif des TIC','50','O');
insert into pfolio values('','4','2','Comp�tence A2 : Int�grer la dimension �thique et le respect de la d�ontologie','50','O');
insert into pfolio values('','4','3','Comp�tence B1 : S\'approprier son environnement de travail','50','O');
insert into pfolio values('','4','4','Comp�tence B2 : Rechercher l\'information','50','O');
insert into pfolio values('','4','5','Comp�tence B3 : Sauvegarder, s�curiser, archiver ses donn�es en local et en r�seau��filaire ou sans fil','50','O');
insert into pfolio values('','4','6','Comp�tence B4 : R�aliser des documents destin�s � �tre imprim�s','50','O');
insert into pfolio values('','4','7','Comp�tence B5 : R�aliser la pr�sentation de ses travaux en pr�sentiel et en ligne','50','O');
insert into pfolio values('','4','8','Comp�tence B6 : �changer et communiquer � distance','50','O');
insert into pfolio values('','4','9','Comp�tence B7 : Mener des projets en travail collaboratif � distance','50','O');

insert into pfolio values('','5','1','Comp�tence A1 : Ma�trise de l\'environnement num�rique professionnel','50','O');
insert into pfolio values('','5','2','Comp�tence A2 : D�veloppement des comp�tences pour la formation tout au long de la vie','50','O');
insert into pfolio values('','5','3','Comp�tence A3 : Responsabilit� professionnelle dans le cadre du syst�me �ducatif','50','O');
insert into pfolio values('','5','4','Comp�tence B1 : Travail en r�seau avec l\'utilisation des outils de travail collaboratif','50','O');
insert into pfolio values('','5','5','Comp�tence B2 : Conception et pr�paration de contenus d\'enseignement et de situations d\'apprentissage','50','O');
insert into pfolio values('','5','6','Comp�tence B3 : Mise en oeuvre p�dagogique en pr�sentiel et � distance','50','O');
insert into pfolio values('','5','7','Comp�tence B4 : Mise en �uvre de d�marches d\'�valuation','50','O');

insert into pfolio values('','6','1','Comp�tence A : Probl�matiques et enjeux li�s aux TIC dans les activit�s juridiques et judiciaires','50','O');
insert into pfolio values('','6','2','Comp�tence B1 : La recherche et l\'utilisation des ressources d\'information et de documentation juridique','50','O');
insert into pfolio values('','6','3','Comp�tence B2 : S�curit�','50','O');
insert into pfolio values('','6','4','Comp�tence B3 : Responsabilit� professionnelle li�e aux activit�s num�riques','50','O');
insert into pfolio values('','6','5','Comp�tence B4 : Le travail collaboratif en r�seau','50','O');
insert into pfolio values('','6','6','Comp�tence B5 : Les �changes num�riques entre acteurs judiciaires ou juridiques et services offerts aux citoyens','50','O');
insert into pfolio values('','6','7','Comp�tence B6 : Traitement de l\'information juridique','50','O');

insert into pfolio values('','7','1','Comp�tence A1 : L�information en sant�, documentation','50','O');
insert into pfolio values('','7','2','Comp�tence A2 : L�information en sant�, juridique','50','O');
insert into pfolio values('','7','3','Comp�tence A3 : L�information en sant�, s�curit�','50','O');
insert into pfolio values('','7','4','Comp�tence B1 : Travail collaboratif en sant�','50','O');
insert into pfolio values('','7','5','Comp�tence B2 : Syst�mes d\�information','50','O');

insert into pfolio values('','8','1','Comp�tence A1 : Probl�matique et enjeux li�s aux aspects juridiques en contexte professionnel','50','O');
insert into pfolio values('','8','2','Comp�tence A2 : La s�curit� de l\�information et des syst�mes d\�information','50','O');
insert into pfolio values('','8','3','Comp�tence B1 : Standards, normes techniques et interop�rabilit�','50','O');
insert into pfolio values('','8','4','Comp�tence B2 : Environnement num�rique et ing�nierie collaborative','50','O');

insert into pfolio values('','9','1','Comp�tence D1 : Environnement informatique','50','O');
insert into pfolio values('','9','2','Comp�tence D2 : Attitude citoyenne','50','O');
insert into pfolio values('','9','3','Comp�tence D3 : Traitement et Production','50','O');
insert into pfolio values('','9','4','Comp�tence D4 : Recherche de l\�information','50','O');
insert into pfolio values('','9','5','Comp�tence D5 : Communication','50','O');

insert into pfolio values('','10','1','Comp�tence A1 : Conna�tre et utiliser un �quipement informatique et ses logiciels','50','O');
insert into pfolio values('','10','2','Comp�tence A2 : Naviguer sur Internet','50','O');
insert into pfolio values('','10','3','Comp�tence A3 : Communiquer avec Internet','50','O');
insert into pfolio values('','10','4','Comp�tence A4 : Cr�er et exploiter un document num�rique','50','O');
insert into pfolio values('','10','5','Comp�tence A5 : Conna�tre les r�gles �l�mentaires du droit et du bon usage sur Internet','50','O');

insert into pfolio values('','11','1','Comp�tence M1 : Bases de l\'ordinateur et d\'Internet','50','O');
insert into pfolio values('','11','2','Comp�tence M2 : Traitement de texte et Tableur','50','O');
insert into pfolio values('','11','3','Comp�tence M3 : Messagerie et forum','50','O');
insert into pfolio values('','11','4','Comp�tence M4 : Navigation sur la Toile','50','O');
insert into pfolio values('','11','5','Comp�tence M5 : S�curit� des syst�mes d\�information','50','O');
insert into pfolio values('','11','6','Comp�tence M6 : Protection des donn�es personnelles et environnement juridiques','50','O');
insert into pfolio values('','11','7','Comp�tence M7 : Administration �lectronique','50','O');

insert into pfolio values('','12','1','Comp�tence M1 : Publication sur le Web','50','O');
insert into pfolio values('','12','2','Comp�tence M2 : Messagerie et forum','50','O');
insert into pfolio values('','12','3','Comp�tence M3 : Navigation sur la Toile','50','O');
insert into pfolio values('','12','4','Comp�tence M4 : S�curit� des syst�mes d\�information','50','O');
insert into pfolio values('','12','5','Comp�tence M5 : Protection des donn�es personnelles et environnement juridique','50','O');
insert into pfolio values('','12','6','Comp�tence M6 : Administration �lectronique','50','O');

insert into pfolio values('','13','1','Comp�tence A1 : Naviguer sur Internet','50','O');
insert into pfolio values('','13','2','Comp�tence A2 : Communiquer avec Internet','50','O');
insert into pfolio values('','13','3','Comp�tence A3 : Rechercher sur Internet','50','O');
###############################################################################
# cr�ation de la dba des comp�tences B2i
###############################################################################
## B2i niv 1 ##
insert into pfolio_data values('','1','1','Je sais d�signer et nommer les principaux �l�ments composant l\'�quipement informatique que j\'utilise et je sais � quoi ils servent.','N','O');
insert into pfolio_data values('','1','2','Je sais allumer et �teindre l\'�quipement informatique; je sais lancer et quitter un logiciel.','N','O');
insert into pfolio_data values('','1','3','Je sais d�placer le pointeur, placer le curseur, s�lectionner, effacer et valider.','N','O');
insert into pfolio_data values('','1','4','Je sais acc�der � un dossier, ouvrir et enregistrer un fichier.','N','O');
insert into pfolio_data values('','2','1','Je connais les droits et devoirs indiqu�s dans la charte d\�usage des TIC de mon �cole.','N','O');
insert into pfolio_data values('','2','2','Je respecte les autres et je me prot�ge moi-m�me dans le cadre de la communication et de la publication �lectroniques.','N','O');
insert into pfolio_data values('','2','3','Si je souhaite r�cup�rer un document, je v�rifie 
que j\'ai le droit de l\'utiliser et � quelles conditions.','N','O');
insert into pfolio_data values('','2','4','Je trouve des indices avant d\�accorder ma confiance aux informations et propositions que la machine me fournit.','N','O');
insert into pfolio_data values('','3','1','Je sais produire et modifier un texte, une image ou un son.','N','O');
insert into pfolio_data values('','3','2','Je sais saisir les caract�res en minuscules, en majuscules, les diff�rentes lettres accentu�es et les signes de ponctuation.','N','O');
insert into pfolio_data values('','3','3','Je sais modifier la mise en forme des caract�res et des paragraphes.','N','O');
insert into pfolio_data values('','3','4','Je sais utiliser les fonctions copier, couper, coller, ins�rer, glisser, d�poser.','N','O');
insert into pfolio_data values('','3','5','Je sais regrouper dans un m�me document du texte ou des images ou du son.','N','O');
insert into pfolio_data values('','3','6','Je sais imprimer un document.','N','O');
insert into pfolio_data values('','4','1','Je sais utiliser les fen�tres, ascenseurs, boutons de d�filement, liens, listes d�roulantes, ic�nes et onglets.','N','O');
insert into pfolio_data values('','4','2','Je sais rep�rer les informations affich�es � l\'�cran.','N','O');
insert into pfolio_data values('','4','3','Je sais saisir une adresse internet et naviguer dans un site.','N','O');
insert into pfolio_data values('','4','4','Je sais utiliser un mot-cl� ou un menu pour faire une recherche.','N','O');
insert into pfolio_data values('','5','1','Je sais envoyer et recevoir un message.','N','O');
insert into pfolio_data values('','5','2','Je sais dire de qui provient un message et � qui il est adress�.','N','O');
insert into pfolio_data values('','5','3','Je sais trouver le sujet d\�un message.','N','O');
insert into pfolio_data values('','5','4','Je sais trouver la date d\'envoi d\'un message.','N','O');
## B2i niv 2 ##
insert into pfolio_data values('','6','1','Je sais m\'identifier sur un r�seau ou un site et mettre fin � cette identification.','N','O');
insert into pfolio_data values('','6','2','Je sais acc�der aux logiciels et aux documents disponibles � partir de mon espace de travail.','N','O');
insert into pfolio_data values('','6','3','Je sais organiser mes espaces de stockage.','N','O');
insert into pfolio_data values('','6','4','Je sais lire les propri�t�s d\'un fichier : nom, format, taille, dates de cr�ation et de derni�re modification.','N','O');
insert into pfolio_data values('','6','5','Je sais param�trer l�impression (pr�visualisation, quantit�, partie de documents�).','N','O');
insert into pfolio_data values('','6','6','Je sais faire un autre choix que celui propos� par d�faut (lieu d\�enregistrement, format, imprimante�).','N','O');
insert into pfolio_data values('','7','1','Je connais les droits et devoirs indiqu�s dans la charte d�usage des TIC et la proc�dure d\'alerte de mon �tablissement.','N','O');
insert into pfolio_data values('','7','2','Je prot�ge ma vie priv�e en ne donnant sur internet des renseignements me concernant qu�avec l�accord de mon responsable l�gal.','N','O');
insert into pfolio_data values('','7','3','Lorsque j�utilise ou transmets des documents, je v�rifie que j�en ai le droit.','N','O');
insert into pfolio_data values('','7','4','Je m\'interroge sur les r�sultats des traitements informatiques (calcul, repr�sentation graphique, correcteur...).','N','O');
insert into pfolio_data values('','7','5','J�applique des r�gles de prudence contre les risques de malveillance (virus, spam...).','N','O');
insert into pfolio_data values('','7','6','Je s�curise mes donn�es (gestion des mots de passe, fermeture de session, sauvegarde). ','N','O');
insert into pfolio_data values('','7','7','Je mets mes comp�tences informatiques au service d\'une production collective.','N','O');
insert into pfolio_data values('','8','1','Je sais modifier la mise en forme des caract�res et des paragraphes, paginer automatiquement.','N','O');
insert into pfolio_data values('','8','2','Je sais utiliser l�outil de recherche et de remplacement dans un document.','N','O');
insert into pfolio_data values('','8','3','Je sais regrouper dans un m�me document plusieurs �l�ments (texte, image, tableau, son, graphique, vid�o�).','N','O');
insert into pfolio_data values('','8','4','Je sais cr�er, modifier une feuille de calcul, ins�rer une formule.','N','O');
insert into pfolio_data values('','8','5','Je sais r�aliser un graphique de type donn�.','N','O');
insert into pfolio_data values('','8','6','Je sais utiliser un outil de simulation (ou de mod�lisation) en �tant conscient de ses limites.','N','O');
insert into pfolio_data values('','8','7','Je sais traiter un fichier image ou son � l�aide d�un logiciel d�di� notamment pour modifier ses propri�t�s �l�mentaires.','N','O');
insert into pfolio_data values('','9','1','Je sais rechercher des r�f�rences de documents � l�aide du logiciel documentaire pr�sent au CDI.','N','O');
insert into pfolio_data values('','9','2','Je sais utiliser les fonctions principales d\'un logiciel de navigation sur le web (param�trage, gestion des favoris, gestion des affichages et de l\'impression).','N','O');
insert into pfolio_data values('','9','3','je sais utiliser les fonctions principales d\'un outil de recherche sur le web (moteur de recherche, annuaire...).','N','O');
insert into pfolio_data values('','9','4','Je sais relever des �l�ments me permettant de conna�tre l�origine de l�information (auteur, date, source�).','N','O');
insert into pfolio_data values('','9','5','Je sais s�lectionner des r�sultats lors d\'une recherche (et donner des arguments permettant de justifier mon choix).','N','O');
insert into pfolio_data values('','10','1','Lorsque j\'envoie ou je publie des informations, je r�fl�chis aux lecteurs possibles en fonction de l\'outil utilis�.','N','O');
insert into pfolio_data values('','10','2','Je sais ouvrir et enregistrer un fichier joint � un message ou � une publication.','N','O');
insert into pfolio_data values('','10','3','Je sais envoyer ou publier un message avec un fichier joint.','N','O');
insert into pfolio_data values('','10','4','Je sais utiliser un carnet d�adresses ou un annuaire pour choisir un destinataire.','N','O');
## B2i niv 3 ##
insert into pfolio_data values('','11','1','Je sais choisir les services, mat�riels et logiciels adapt�s � mes besoins.','N','O');
insert into pfolio_data values('','11','2','Je sais structurer mon environnement de travail.','N','O');
insert into pfolio_data values('','11','3','Je sais r�gler les principaux param�tres de fonctionnement d\'un p�riph�rique selon mes besoins. ','N','O');
insert into pfolio_data values('','11','4','Je sais personnaliser un logiciel selon mes besoins.','N','O');
insert into pfolio_data values('','11','5','Je sais m�affranchir des fonctions automatiques des logiciels (saisie, m�morisation mot de passe, correction orthographique, incr�mentation�).','N','O');
insert into pfolio_data values('','11','6','Je sais utiliser une plate-forme de travail de groupe.','N','O');																																																																																																																																																																																																																																																														
insert into pfolio_data values('','12','1','Je connais la charte d\'usage des TIC de mon �tablissement.','N','O');
insert into pfolio_data values('','12','2','Je prot�ge ma vie priv�e en r�fl�chissant aux informations personnelles que je communique.','N','O');
insert into pfolio_data values('','12','3','J\'utilise les documents ou les logiciels dans le respect des droits d�auteurs et de propri�t�.','N','O');
insert into pfolio_data values('','12','4','Je valide, � partir de crit�res d�finis, les r�sultats qu\'un traitement automatique me fournit (calcul, repr�sentation graphique, correcteur...).','N','O');
insert into pfolio_data values('','12','5','Je suis capable de me r�f�rer en cas de besoin � la r�glementation en vigueur sur les usages num�riques.','N','O');
insert into pfolio_data values('','12','6','Je sais que l�on peut conna�tre mes op�rations et acc�der � mes donn�es lors de l�utilisation d�un environnement informatique.','N','O');
insert into pfolio_data values('','12','7','Je mets mes comp�tences informatiques � la disposition des autres. ','N','O');
insert into pfolio_data values('','13','1','Je sais cr�er et modifier un document num�rique composite transportable et publiable. ','N','O');
insert into pfolio_data values('','13','2','Je sais ins�rer automatiquement des informations dans un document (notes de bas de page, sommaire�). ','N','O');
insert into pfolio_data values('','13','3','Je sais utiliser des outils permettant de travailler � plusieurs sur un m�me document (outil de suivi de modifications�).','N','O');
insert into pfolio_data values('','13','4','Je sais utiliser ou cr�er des formules pour traiter les donn�es. ','N','O');
insert into pfolio_data values('','13','5','Je sais produire une repr�sentation graphique � partir d�un traitement de donn�es num�riques.  ','N','O');
insert into pfolio_data values('','13','6','Dans le cadre de mes activit�s scolaires, je sais rep�rer des exemples de mod�lisation ou simulation et je sais citer au moins un param�tre qui influence le r�sultat.','N','O');
insert into pfolio_data values('','13','7','Je sais publier un document num�rique sur un espace appropri�. ','N','O');
insert into pfolio_data values('','13','8','Je sais utiliser un mod�le de document. ','N','O');
insert into pfolio_data values('','14','1','Je sais interroger les bases documentaires � ma disposition.','N','O');
insert into pfolio_data values('','14','2','Je sais utiliser les fonctions avanc�es des outils de recherche sur internet.','N','O');
insert into pfolio_data values('','14','3','Je sais �noncer des crit�res de tri d\'informations.','N','O');
insert into pfolio_data values('','14','4','Je sais constituer une bibliographie incluant des documents d�origine num�rique.','N','O');
insert into pfolio_data values('','14','5','Je sais utiliser des outils de veille documentaire.','N','O');
insert into pfolio_data values('','15','1','Je sais choisir le service de communication selon mes besoins.','N','O');
insert into pfolio_data values('','15','2','Je sais organiser mes espaces d\'�change (messagerie, travail de groupe�)','N','O');
insert into pfolio_data values('','15','3','Je sais adapter le contenu des informations  transmises aux lecteurs potentiels : niveau de langage, forme, contenu, taille, copies.','N','O');
insert into pfolio_data values('','15','4','Je sais param�trer un logiciel de messagerie pour r�cup�rer mon courrier �lectronique.','N','O');
insert into pfolio_data values('','15','5','Je sais g�rer des groupes de destinataires.','N','O');
## C2i niv 1 ##
insert into pfolio_data values('','16','1','Etre conscient de l\'�volution constante des TIC� et de la d�ontologie qui doit leur �tre associ�e, et capable d\'en tenir compte dans le cadre des apprentissages.','N','O');
insert into pfolio_data values('','16','2','Prendre conscience des n�cessaires actualisations du r�f�rentiel du C2i� niveau 1.','N','O');
insert into pfolio_data values('','16','3','Travailler dans un esprit d\'ouverture et d\'adaptabilit� (adaptabilit� aux diff�rents environnements de travail, �changes).','N','O');
insert into pfolio_data values('','16','4','Tenir compte des probl�mes de compatibilit�, de format de fichier, de norme et proc�dure de compression et d\'�change.','N','O');
insert into pfolio_data values('','17','1','Respecter les droits fondamentaux de l\'homme, les normes internationales et les lois qui en d�coulent.','N','O');
insert into pfolio_data values('','17','2','Ma�triser son identit� num�rique.','N','O');
insert into pfolio_data values('','17','3','S�curiser les informations sensibles - personnelles et professionnelles -contre les intrusions frauduleuses, les disparitions, les destructions volontaires ou involontaires.','N','O');
insert into pfolio_data values('','17','4','Assurer la protection de la confidentialit�.','N','O');
insert into pfolio_data values('','18','1','Organiser et personnaliser son bureau de travail.','N','O');
insert into pfolio_data values('','18','2','�tre capable, constamment, de retrouver ses donn�es.','N','O');
insert into pfolio_data values('','18','3','Structurer et g�rer une arborescence de fichiers.','N','O');
insert into pfolio_data values('','18','4','Utiliser les outils adapt�s (savoir choisir le logiciel qui convient aux objectifs poursuivis).','N','O');
insert into pfolio_data values('','18','5','Maintenir (mise � jour, nettoyage, d�fragmentation, ...).','N','O');
insert into pfolio_data values('','18','6','Organiser les liens (favoris - signets) dans des dossiers.','N','O');
insert into pfolio_data values('','18','7','Se connecter aux diff�rents types de r�seaux (filaires et sans fil).','N','O');
insert into pfolio_data values('','19','1','Distinguer les diff�rents types d\'outils de recherche.','N','O');
insert into pfolio_data values('','19','2','Formaliser les requ�tes de recherche.','N','O');
insert into pfolio_data values('','19','3','R�cup�rer et savoir utiliser les informations (texte, image, son, fichiers, pilote, applications, site, ...).','N','O');
insert into pfolio_data values('','20','1','Rechercher un fichier (par nom, par date, par texte, ...).','N','O');
insert into pfolio_data values('','20','2','Assurer la protection contre les virus.','N','O');
insert into pfolio_data values('','20','3','Prot�ger ses fichiers et ses dossiers (en lecture/ �criture).','N','O');
insert into pfolio_data values('','20','4','Assurer une sauvegarde (sur le r�seau, support externe, ...).','N','O');
insert into pfolio_data values('','20','5','Compresser, d�compresser un fichier ou un ensemble de fichiers/dossiers.','N','O');
insert into pfolio_data values('','20','6','R�cup�rer et transf�rer des donn�es sur et � partir de terminaux mobiles.','N','O');
insert into pfolio_data values('','21','1','R�aliser des documents courts (CV, lettre, ...).','N','O');
insert into pfolio_data values('','21','2','�laborer un document complexe et structur� (compte rendu, rapport, m�moire, bibliographie, ...).','N','O');
insert into pfolio_data values('','21','3','Ma�triser les fonctionnalit�s n�cessaires � la structuration de documents complexes (notes de bas de pages, sommaire, index, styles, ...).','N','O');
insert into pfolio_data values('','21','4','Int�grer les informations (images, fichiers, graphiques, ...).','N','O');
insert into pfolio_data values('','21','5','Traiter des donn�es chiffr�es dans un tableur (formules arithm�tiques et fonctions simples comme la somme et la moyenne, notion et usage de la r�f�rence absolue), les pr�senter sous forme de tableau (mises en forme dont format de nombre et bordures) et sous forme graphique (graphique simple int�grant une ou plusieurs s�ries).','N','O');
insert into pfolio_data values('','21','6','Cr�er des sch�mas (formes g�om�triques avec texte, traits, fl�ches et connecteurs, disposition en profondeur, groupes d\'objets, export sous forme d\'image).','N','O');
insert into pfolio_data values('','22','1','Communiquer le r�sultat de ses travaux en s\'appuyant sur un outil de pr�sentation assist�e par ordinateur.','N','O');
insert into pfolio_data values('','22','2','Adapter des documents initialement destin�s � �tre imprim�s pour une pr�sentation sur �cran.','N','O');
insert into pfolio_data values('','22','3','R�aliser des documents hyperm�dias int�grant textes, sons, images fixes et anim�es et liens internes et externes.','N','O');
insert into pfolio_data values('','23','4','le courrier �lectronique (en-t�tes, taille et format des fichiers, organisation des dossiers, filtrage) ;','N','O');
insert into pfolio_data values('','23','5','les listes de diffusion (s\'inscrire, se d�sabonner) ;','N','O');
insert into pfolio_data values('','23','6','les forums de discussion (mod�r�, non mod�r�) ;','N','O');
insert into pfolio_data values('','23','7','le dialogue en temps r�el ;','N','O');
insert into pfolio_data values('','23','8','les terminaux mobiles.','N','O');
insert into pfolio_data values('','24','1','Utiliser les outils d\'un espace de travail collaboratif (environnement num�rique de travail) ;','N','O');
insert into pfolio_data values('','24','2','�laborer en commun un document de travail','N','O');
insert into pfolio_data values('','24','3','G�rer diff�rentes versions de documents partag�s.','N','O');
## C2i niv 2 : enseignant ##
insert into pfolio_data values('','25','1','Identifier les personnes ressources TIC et leurs r�les respectifs, dans l\'�cole ou l\'�tablissement, et en dehors (circonscription, bassin, acad�mie, niveau national...).','N','O');
insert into pfolio_data values('','25','2','S\�approprier diff�rentes composantes informatiques (lieux, outils...) de son environnement professionnel.','N','O');
insert into pfolio_data values('','25','3','Choisir et utiliser les ressources et services d\'un espace num�rique de travail (ENT).','N','O');
insert into pfolio_data values('','25','4','Choisir et utiliser les outils les plus adapt�s pour communiquer avec les acteurs et usagers du syst�me �ducatif.','N','O');
insert into pfolio_data values('','25','5','Se constituer et organiser des ressources en utilisant des sources professionnelles.','N','O');
insert into pfolio_data values('','26','1','Utiliser les ressources en ligne et les dispositifs de formation ouverte et � distance (FOAD) pour sa formation.','N','O');
insert into pfolio_data values('','26','2','Se r�f�rer � des travaux de recherche liant didactique et TICE.','N','O');
insert into pfolio_data values('','26','3','Pratiquer une veille p�dagogique et institutionnelle, notamment par l\'identification des r�seaux d\'�changes concernant son domaine, sa discipline, son niveau d\'enseignement.','N','O');
insert into pfolio_data values('','27','1','Adapter son mode d\'expression et de communication aux diff�rents espaces de diffusion (institutionnel, public, priv�, interne, externe...).','N','O');
insert into pfolio_data values('','27','2','Prendre en compte les enjeux et respecter les r�gles concernant : la recherche et les crit�res de contr�le de validit�, des informations, la s�curit� informatique, le filtrage internet, etc�','N','O');
insert into pfolio_data values('','27','3','Prendre en compte les lois et les exigences d\'une utilisation professionnelle et citoyenne des TICE concernant la protection des libert�s individuelles et de la s�curit� des personnes, notamment: la protection des mineurs, la confidentialit� des donn�es,  la propri�t� intellectuelle,  le droit � l\'image, etc...','N','O');
insert into pfolio_data values('','27','4','Respecter et faire respecter la charte d\'usage de l\'�tablissement, dans une perspective �ducative d\'apprentissage de la citoyennet�.','N','O');
insert into pfolio_data values('','28','1','Rechercher, produire, partager et mutualiser des documents, des informations, des ressources dans un environnement num�rique.','N','O');
insert into pfolio_data values('','28','2','Contribuer � une production ou � un projet collectif au sein d\'�quipes disciplinaires, interdisciplinaires, transversales ou �ducatives.','N','O');
insert into pfolio_data values('','28','3','Concevoir des situations de recherche d\'information dans le cadre des projets transversaux et interdisciplinaires.','N','O');
insert into pfolio_data values('','29','1','Identifier les situations d\'apprentissage propices � l\'utilisation des TICE.','N','O');
insert into pfolio_data values('','29','2','Concevoir des situations d\'apprentissage mettant en �uvre des logiciels g�n�raux ou sp�cifiques � la discipline, au domaine enseign�, au niveau de classe.','N','O');
insert into pfolio_data values('','29','3','Rechercher et int�grer des outils et des ressources dans une s�quence d\'enseignement, en op�rant des choix entre les supports et m�dias utilisables et leurs modalit�s d\'utilisation.','N','O');
insert into pfolio_data values('','29','4','Pr�parer des ressources adapt�es � la diversit� des publics et des situations p�dagogiques en respectant les r�gles de la communication.','N','O');
insert into pfolio_data values('','30','1','Conduire des situations d\'apprentissage en tirant parti du potentiel des TIC : travail collectif, individualis�, en petits groupes, recherche documentaire.','N','O');
insert into pfolio_data values('','30','2','G�rer l\'alternance entre les activit�s utilisant les TICE et celles qui n�y ont pas recours.','N','O');
insert into pfolio_data values('','30','3','Prendre en compte la diversit� des �l�ves, la difficult� scolaire en utilisant les TICE pour g�rer des temps de travail diff�renci�s.','N','O');
insert into pfolio_data values('','30','4','Utiliser les TICE pour accompagner des �l�ves, des groupes d\'�l�ves dans leurs projets de production ou de recherche d\'information.','N','O');
insert into pfolio_data values('','30','5','Prendre une d�cision p�dagogique pertinente face � un incident technique.','N','O');
insert into pfolio_data values('','31','1','Identifier les comp�tences des r�f�rentiels TIC (B2i ou C2i) mises en �uvre dans une situation de formation propos�e aux �l�ves, aux �tudiants.','N','O');
insert into pfolio_data values('','31','2','S\�int�grer dans une d�marche collective d\'�valuation des comp�tences TIC.','N','O');
insert into pfolio_data values('','31','3','Exploiter les r�sultats produits par des logiciels institutionnels d\'�valuation des �l�ves.','N','O');
## C2i niv 2 : droit ##
insert into pfolio_data values('','32','1','Enjeux de la r�gulation des technologies de l�information et de la communication.','N','O');
insert into pfolio_data values('','32','2','Identification des droits et des obligations g�n�rales et professionnelles et des r�gles d�ontologiques et �thiques.','N','O');
insert into pfolio_data values('','32','3','Cons�quences sociales et �conomiques sur l�exercice des professions li�es au Droit et aux structures professionnelles, adaptation � l��volution du contexte professionnel.','N','O');
insert into pfolio_data values('','32','4','Modification des pratiques juridiques (cyberjustice�) et des conceptions du droit.','N','O');
insert into pfolio_data values('','32','5','Connaissance des services, des outils offerts, des op�rateurs du march�.','N','O');
insert into pfolio_data values('','32','6','�l�ments de prospective : suivi des �volutions (veille et actualisation).','N','O');
insert into pfolio_data values('','33','1','Appr�hender le fonctionnement d�un syst�me de gestion de donn�es.','N','O');
insert into pfolio_data values('','33','2','Utiliser les techniques de requ�tes.','N','O');
insert into pfolio_data values('','33','3','�valuer et� valider l�information.','N','O');
insert into pfolio_data values('','33','4','Constituer une base�de documentation personnelle.','N','O');
insert into pfolio_data values('','33','5','Traiter des r�sultats (interpr�tation, analyse et synth�se).','N','O');
insert into pfolio_data values('','34','1','S�curiser ses donn�es (niveaux et m�thodes, outils).','N','O');
insert into pfolio_data values('','34','2','�changer des donn�es en toute s�curit�.','N','O');
insert into pfolio_data values('','34','3','Conserver de fa�on p�renne ses donn�es.','N','O');
insert into pfolio_data values('','35','1','Adopter un comportement responsable conforme aux exigences l�gales concernant en particulier : la protection des donn�es personnelles, le droit au secret des correspondances, la propri�t� intellectuelle des contenus num�riques, la protection des libert�s individuelles (employ�s, clients, tiers�), l��crit et la signature �lectronique (forme et valeur probatoire), la responsabilit� li�e � l��dition en ligne (mentions obligatoires et d�lits de presse).','N','O');
insert into pfolio_data values('','35','2','Respecter les devoirs d�ontologiques li�s aux TIC.','N','O');
insert into pfolio_data values('','36','1','R�diger des documents et des actes en commun.','N','O');
insert into pfolio_data values('','36','2','Constituer et g�rer un groupe via l�Internet.','N','O');
insert into pfolio_data values('','36','3','G�rer des projets et des dossiers en r�seau.','N','O');
insert into pfolio_data values('','37','1','Utiliser les t�l�proc�dures administratives (d�clarations fiscales et sociales, cadastre, �tat civil, casier judiciaire�).','N','O');
insert into pfolio_data values('','37','2','Utiliser les syst�mes d��changes judiciaires (greffe �lectronique des tribunaux civils, p�naux et de commerce, �change de conclusions,�).','N','O');
insert into pfolio_data values('','37','3','�laborer des actes �lectroniques.','N','O');
insert into pfolio_data values('','37','4','�laborer des actes authentiques �lectroniques.','N','O');
insert into pfolio_data values('','38','1','Utiliser et enrichir un clausier �lectronique.','N','O');
insert into pfolio_data values('','38','2','�tre sensibilis� � l�usage des outils d�aide � la d�cision.','N','O');
insert into pfolio_data values('','38','3','�tre sensibilis� � l�usage des outils d�analyse statistique et s�mantique du contentieux.','N','O');
## C2i niv 2 : sant� ##
insert into pfolio_data values('','39','1','Identifier et savoir utiliser classifications, thesaurus et codifications de l\�information en sant�.','N','O');
insert into pfolio_data values('','39','2','Identifier les sources �lectroniques d\�information sp�cialis�es et professionnelles en sant�.','N','O');
insert into pfolio_data values('','39','3','Rechercher des informations en sant� sur internet.','N','O');
insert into pfolio_data values('','39','4','�valuer la qualit� de l\�information en sant� sur internt�.','N','O');
insert into pfolio_data values('','39','5','Mettre en oeuvre une veille documentaire.','N','O');
insert into pfolio_data values('','40','1','Respecter les principes g�n�raux de protection des libert�s individuelles.','N','O');
insert into pfolio_data values('','40','2','Respecter les diff�rentes r�gles encadrant le secret professionnel et d�ontologique.','N','O');
insert into pfolio_data values('','40','3','Respecter les r�gles relatives � l\�informatisation des donn�es personnelles et d�finies par la loi "informatique et libert�s".','N','O');
insert into pfolio_data values('','40','4','Respecter les principes g�n�raux de l\�information du patient et du droit d�acc�s aux donn�es de sant�.','N','O');
insert into pfolio_data values('','40','5','Respecter les r�gles relatives � la p�rennit� de l\�information num�rique en sant�.','N','O');
insert into pfolio_data values('','40','6','Respecter les r�gles et pratiques sp�cifiques relatives � la propri�t� intellectuelle des contenus num�riques.','N','O');
insert into pfolio_data values('','40','7','Appliquer les r�gles juridiques relatives � l\�informatisation des donn�es de sant�.','N','O');
insert into pfolio_data values('','40','8','Appliquer la proc�dure de d�claration d\�un fichier nominatif � la Commission nationale informatique et libert�s (CNIL).','N','O');
insert into pfolio_data values('','40','9','Appliquer les r�gles d\�anonymisation des fichiers et/ou documents num�riques.','N','O');
insert into pfolio_data values('','41','1','�valuer les risques li�s aux d�fauts de s�curit�.','N','O');
insert into pfolio_data values('','41','2','Comprendre les m�thodes de s�curisation des donn�es et des �changes.','N','O');
insert into pfolio_data values('','41','3','Prot�ger l\�int�grit� des donn�es.','N','O');
insert into pfolio_data values('','41','4','�valuer les dispositifs de s�curisation des informations, des supports et des traitements.','N','O');
insert into pfolio_data values('','41','5','Mettre en oeuvre des m�thodes de s�curisation des donn�es et des �changes.','N','O');
insert into pfolio_data values('','42','1','Identifier les exigences technologiques li�es au travail en r�seau.','N','O');
insert into pfolio_data values('','42','2','Mettre en oeuvre une collaboration dans le cadre de ses activit�s professionnelles.','N','O');
insert into pfolio_data values('','42','3','Appr�cier les normes et standards et les technologies permettant l\�interop�rabilit� et le travail en r�seau.','N','O');
insert into pfolio_data values('','42','4','Choisir et utiliser � bon escient les outils d\��change et de partage de l\�information.','N','O');
insert into pfolio_data values('','42','5','Utiliser des ressources en ligne ou des dispositifs de formation ouverte et � distance.','N','O');
insert into pfolio_data values('','43','1','Ma�triser les �l�ments fondamentaux du dossier patient .','N','O');
insert into pfolio_data values('','43','2','S\�initier � l\�organisation, la mise en oeuvre et l\�utilisation d\�un syst�me d\�information.','N','O');
insert into pfolio_data values('','43','3','Identifier les circuits d\�informations et g�rer les �changes avec l\�ext�rieur.','N','O');
insert into pfolio_data values('','43','4','Mettre en oeuvre une d�marche qualit�.','N','O');
insert into pfolio_data values('','43','5','Identifier les �l�ments cl�s structurels, fonctionnels et financiers de l\�informatisation de son lieu d\�activit� professionnelle.','N','O');
insert into pfolio_data values('','43','6','G�rer les �changes avec l\�administration et entre professionnels.','N','O');
insert into pfolio_data values('','43','7','Mettre en oeuvre des outils d\�optimisation des t�ches et des activit�s.','N','O');
## C2i niv 2 : ing�nieur ##
insert into pfolio_data values('','44','1','Ma�triser le contexte juridique et d�ontologique de la charte inter et intra-entreprises de bonne utilisation des TIC au travail.','N','O');
insert into pfolio_data values('','44','2','Appliquer la l�gislation sur la protection des �uvres num�riques, des bases de donn�es et conna�tre les sanctions p�nales et civiles.','N','O');
insert into pfolio_data values('','44','3','Prendre en compte la jurisprudence en ce qui concerne la cybersurveillance des salari�s.','N','O');
insert into pfolio_data values('','44','4','Mettre en �uvre, � bon escient, les obligations l�gales de la CNIL.','N','O');
insert into pfolio_data values('','44','5','Appr�cier la valeur juridique d\�un document num�rique.','N','O');
insert into pfolio_data values('','44','6','Distinguer les types de licences logicielles et les aspects contractuels de leur exploitation. ','N','O');
insert into pfolio_data values('','44','7','Distinguer les types de responsabilit� des acteurs aux plans national et international.','N','O');
insert into pfolio_data values('','45','1','Identifier et hi�rarchiser les informations blanches, grises et noires.','N','O');
insert into pfolio_data values('','45','2','Manipuler ces informations, selon le lieu et le mode d�acc�s, avec les proc�dures et les outils ad�quats.','N','O');
insert into pfolio_data values('','45','3','Ma�triser les processus d\�une politique de s�curit� pour participer � sa mise en place.','N','O');
insert into pfolio_data values('','45','4','Distinguer les acteurs de la mise en place de la politique de s�curit� et identifier leurs responsabilit�s l�gales.','N','O');
insert into pfolio_data values('','45','5','�valuer les risques accidentels et intentionnels et prendre les dispositions n�cessaires.','N','O');
insert into pfolio_data values('','46','1','Appr�hender le syst�me d\�information et en comprendre ses enjeux.','N','O');
insert into pfolio_data values('','46','2','Int�grer les outils TIC � la gestion de projets.','N','O');
insert into pfolio_data values('','46','3','Comprendre un document de mod�lisation de donn�es ou de processus m�tiers','N','O');
insert into pfolio_data values('','46','4','Prendre en compte les aspects de l\�accessibilit�. ','N','O');
insert into pfolio_data values('','46','5','Respecter les exigences de l\�interop�rabilit�.','N','O');
insert into pfolio_data values('','47','1','Pratiquer les outils d\�ing�nierie collaborative de la conception � l\�exploitation d\�un processus ou d\�un produit.','N','O');
insert into pfolio_data values('','47','2','Animer un espace collaboratif et mettre en �uvre les bonnes pratiques et le contexte d\�usage des outils synchrones et asynchrones.','N','O');
insert into pfolio_data values('','47','3','Assurer la bonne gestion des documents et le cycle de vie. ','N','O');
insert into pfolio_data values('','47','4','Ma�triser les contraintes de travail connect� ou d�connect� et ma�triser la configuration et la s�curit� de son acc�s r�seau.','N','O');
## B2i adultes ##
insert into pfolio_data values('','48','1','Conna�tre le vocabulaire sp�cifique et ma�triser les �l�ments mat�riels et logiciels de base. ','N','O');
insert into pfolio_data values('','48','2','G�rer et organiser les fichiers, identifier leurs propri�t�s et caract�ristiques. ','N','O');
insert into pfolio_data values('','48','3','Organiser, personnaliser et g�rer un environnement informatique. ','N','O');
insert into pfolio_data values('','48','4','Se connecter et s\'identifier sur diff�rents types de r�seaux. ','N','O');
insert into pfolio_data values('','49','1','Conna�tre les r�gles d\'usage et les dangers li�s aux r�seaux et aux �changes de donn�es. ','N','O');
insert into pfolio_data values('','49','2','Conna�tre les droits et obligations relatifs � l\'utilisation de l\'informatique et d\'internet. ','N','O');
insert into pfolio_data values('','49','3','Prot�ger les informations concernant sa personne et ses donn�es. ','N','O');
insert into pfolio_data values('','49','4','Prendre part � la soci�t� de l\'information dans ses dimensions administratives et citoyennes. ','N','O');
insert into pfolio_data values('','50','1','Concevoir un document : objectif, d�marche, choix de l\'outil. ','N','O');
insert into pfolio_data values('','50','2','Mettre en �uvre les fonctionnalit�s de base d\'outils permettant le traitement de textes, de nombres, d\'images et de sons. ','N','O');
insert into pfolio_data values('','50','3','R�aliser un document composite. ','N','O');
insert into pfolio_data values('','50','4','Diffuser un document num�rique. ','N','O');
insert into pfolio_data values('','51','1','Consulter de l\'information � partir de diff�rents supports. ','N','O');
insert into pfolio_data values('','51','2','Concevoir une d�marche adapt�e � l\'objectif de recherche d\'information et la mettre en �uvre. ','N','O');
insert into pfolio_data values('','51','3','Identifier et organiser les informations. ','N','O');
insert into pfolio_data values('','51','4','�valuer la qualit� et la pertinence de l\'information. ','N','O');
insert into pfolio_data values('','51','5','R�aliser une veille informationnelle. ','N','O');
insert into pfolio_data values('','52','1','Utiliser un outil de communication adapt� aux besoins. ','N','O');
insert into pfolio_data values('','52','2','�changer des documents num�riques. ','N','O');
insert into pfolio_data values('','52','3','Collaborer en r�seau.','N','O');
## PIM ##
insert into pfolio_data values('','53','1','Identifier et mettre en fonction les principaux �l�ments composant un �quipement informatique','N','O');
insert into pfolio_data values('','53','2','Utiliser la souris et le clavier','N','O');
insert into pfolio_data values('','53','3','Naviguer dans son espace de travail','N','O');
insert into pfolio_data values('','54','1','Se rep�rer dans Internet','N','O');
insert into pfolio_data values('','54','2','S\'informer sur Internet','N','O');
insert into pfolio_data values('','54','3','Utiliser des services en ligne','N','O');
insert into pfolio_data values('','55','1','Ouvrir un compte de messagerie �lectronique','N','O');
insert into pfolio_data values('','55','2','Utiliser une messagerie �lectronique','N','O');
insert into pfolio_data values('','55','3','Utiliser des outils d\'�change et de dialogue','N','O');
insert into pfolio_data values('','56','1','Cr�er et mettre en forme un texte court','N','O');
insert into pfolio_data values('','56','2','Utiliser des images','N','O');
insert into pfolio_data values('','56','3','Diffuser un document num�rique','N','O');
insert into pfolio_data values('','57','1','Conna�tre les r�gles �l�mentaires du droit relatif � l\'informatique et � Internet','N','O');
insert into pfolio_data values('','57','2','Conna�tre les r�gles de bon usage d\'Internet','N','O');
insert into pfolio_data values('','57','3','Prot�ger sa personne et ses donn�es','N','O');
## DEFI niveau 1 ##
insert into pfolio_data values('','58','1','Allumer un ordinateur et mettre hors tension un ordinateur','N','O');
insert into pfolio_data values('','58','2','Utiliser la souris et quelques commandes claviers �l�mentaires','N','O');
insert into pfolio_data values('','58','3','Utiliser quelques commandes claviers plus complexes (telles que la saisie du caract�re � euro �)','N','O');
insert into pfolio_data values('','58','4','D�signer correctement, � partir d\'un vocabulaire de base, les composants mat�riels et logiciels d\'un ordinateur connect� � l\'internet.','N','O');
insert into pfolio_data values('','58','5','Manipuler les fen�tres (r�duire, agrandir, fermer une fen�tre, retrouver une fen�tre qui est en arri�re plan)','N','O');
insert into pfolio_data values('','58','6','Ouvrir un fichier existant, imprimer un document, enregistrer un document, supprimer, d�placer des fichiers','N','O');
insert into pfolio_data values('','58','7','Diff�rencier un fichier et un dossier','N','O');
insert into pfolio_data values('','58','8','reconna�tre quelques ic�nes d\'applications et de documents','N','O');
insert into pfolio_data values('','58','9','�tablir et mettre fin � une connexion � distance d�j� param�tr�e','N','O');
insert into pfolio_data values('','58','10','Comprendre les notions intranet/internet','N','O');

insert into pfolio_data values('','59','1','saisir ou modifier un texte sans mise en forme','N','O');
insert into pfolio_data values('','59','2','effectuer une mise en forme simple','N','O');
insert into pfolio_data values('','59','3','utiliser le correcteur orthographique','N','O');
insert into pfolio_data values('','59','4','effectuer les 4 op�rations � l\'aide d\'un tableur','N','O');

insert into pfolio_data values('','60','1','Adresser, recevoir, imprimer un message �lectronique, y r�pondre ou le rediriger, au moyen du logiciel de messagerie habituel, d�j� configur�,','N','O');
insert into pfolio_data values('','60','2','Recevoir et exploiter un fichier comme pi�ce jointe (ou attach�e) dans un format qui permet d\'ouvrir le fichier directement','N','O');
insert into pfolio_data values('','60','3','Comprendre l\'adresse m�l :','N','O');
insert into pfolio_data values('','60','4','Faire la diff�rence entre une adresse m�l et un site Web','N','O');
insert into pfolio_data values('','60','5','Distinguer une adresse personnelle d\'une adresse fonctionnelle','N','O');
insert into pfolio_data values('','60','6','Rep�rer une adresse m�l invalide (absence d\'@ ; accents ; espace)','N','O');
insert into pfolio_data values('','60','7','Comprendre le chemin d\'un message','N','O');
insert into pfolio_data values('','60','8','Adresser un fichier comme pi�ce jointe (ma�trise simple de la manipulation)','N','O');
insert into pfolio_data values('','60','9','G�rer sa bo�te aux lettres (supprimer des messages)','N','O');
insert into pfolio_data values('','60','10','Respecter les r�gles d\'utilisation de la messagerie','N','O');
insert into pfolio_data values('','60','11','Savoir dans quel cas privil�gier la messagerie par rapport aux autres m�dias','N','O');
insert into pfolio_data values('','60','12','Avoir conscience que l\'usage de la messagerie engage sa responsabilit�','N','O');
insert into pfolio_data values('','60','13','Adapter le contenu du message aux capacit�s de l\'outil (ordre de grandeur)','N','O');
insert into pfolio_data values('','60','14','Remplir l\'objet du message de mani�re intelligible','N','O');
insert into pfolio_data values('','60','15','Utiliser la signature (s\'identifier) � partir d\'un message','N','O');
insert into pfolio_data values('','60','16','Lire des contributions sur des forums','N','O');

insert into pfolio_data values('','61','1','Naviguer sur le Web en utilisant la souris et les liens hypertextes,','N','O');
insert into pfolio_data values('','61','2','Utiliser les boutons pr�c�dent et suivant','N','O');
insert into pfolio_data values('','61','3','Acc�der � un site Internet en saisissant son adresse dans la barre d\'adresse du navigateur, (adresse lue dans un document texte par exemple)','N','O');
insert into pfolio_data values('','61','4','Faire la diff�rence entre une page et un site','N','O');
insert into pfolio_data values('','61','5','Imprimer une page d\'un site','N','O');
insert into pfolio_data values('','61','6','Identifier l\'auteur du site et la source d\'information.','N','O');
insert into pfolio_data values('','61','7','Rep�rer l\'url d\'un site (dans la barre d\'outils, dans la barre d\'�tat)','N','O');
insert into pfolio_data values('','61','8','Comprendre la structure de l\'url','N','O');
insert into pfolio_data values('','61','9','Rep�rer un url invalide','N','O');
insert into pfolio_data values('','61','10','Utiliser un moteur de recherche : Faire une recherche simple dans l\'intranet de son minist�re','N','O');
insert into pfolio_data values('','61','11','Diff�rencier une page HTML d\'un fichier t�l�charg�','N','O');
insert into pfolio_data values('','61','12','Savoir t�l�charger et ouvrir des documents simples (document traitement de texte, rtf, pdf) � partir d\'un site public (minist�res, services publics)','N','O');

insert into pfolio_data values('','62','1','Comprendre les enjeux d\'une politique de s�curit�','N','O');
insert into pfolio_data values('','62','2','Identifier les risques sur la s�curit� par point d\'entr�e (disquette, fichier joint, acc�s � l\'ordinateur)','N','O');
insert into pfolio_data values('','62','3','Comprendre et respecter les principales r�gles de s�curit� et les proc�dures d\'organisation','N','O');
insert into pfolio_data values('','62','4','Connaissance des articles du code p�nal relatif aux atteintes aux syst�mes de traitement automatis� des donn�es, au secret des correspondances, � la propri�t� intellectuelle','N','O');
insert into pfolio_data values('','62','5','Gestion des mots de passe','N','O');
insert into pfolio_data values('','62','6','Adopter une attitude responsable vis � vis de la s�curit� dans l\'utilisation quotidienne de son poste de travail.','N','O');
insert into pfolio_data values('','62','7','avoir une posture appropri�e lorsqu\'on utilise un ordinateur (fatigue, posture, dur�e d\'utilisation)','N','O');

insert into pfolio_data values('','63','1','Conna�tre les principales dispositions juridiques relatives � la protection des donn�es personnelles : les droits (information, acc�s, rectification, opposition, etc.)','N','O');
insert into pfolio_data values('','63','2','�tre � m�me d\'identifier quelles informations rel�vent des donn�es personnelles.','N','O');
insert into pfolio_data values('','63','3','Adopter une attitude critique vis � vis des sites qui demandent des informations nominatives.','N','O');
insert into pfolio_data values('','63','4','Droit de la messagerie �lectronique : conna�tre le caract�re priv� de la communication par m�l, le secret des correspondances,','N','O');
insert into pfolio_data values('','63','5','Savoir que l\'on est responsable en cas d\'utilisation de logiciels pirat�s ou de contenus prot�g�s,','N','O');
insert into pfolio_data values('','63','6','Identifier les contenus illicites (p�dophilie, nazisme, incitation � la haine raciale�)','N','O');
insert into pfolio_data values('','63','7','Conna�tre le caract�re r�pr�hensible de certains types de contenus et savoir ce que l\'on encourt � les utiliser','N','O');

insert into pfolio_data values('','64','1','D�veloppement des services d\'information de l\'usager','N','O');
insert into pfolio_data values('','64','2','D�veloppement des t�l�services','N','O');
insert into pfolio_data values('','64','3','Simplifications administratives','N','O');
insert into pfolio_data values('','64','4','savoir o� trouver les vraies informations','N','O');
insert into pfolio_data values('','64','5','Savoir distinguer un site relevant du service public d\'un site priv� (.com, .org)','N','O');
insert into pfolio_data values('','64','6','reconna�tre le domaine gouv.fr','N','O');
insert into pfolio_data values('','64','7','Savoir utiliser le portail de l\'administration (service-public.fr) pour rechercher','N','O');
insert into pfolio_data values('','64','8','des informations d\'actualit�','N','O');
insert into pfolio_data values('','64','9','des informations pratiques','N','O');
insert into pfolio_data values('','64','10','des informations juridiques','N','O');
insert into pfolio_data values('','64','11','des formulaires','N','O');
insert into pfolio_data values('','64','12','des t�l�services','N','O');
insert into pfolio_data values('','64','13','les coordonn�es des services','N','O');
insert into pfolio_data values('','64','14','Conna�tre quelques sites publics importants (Elys�e, Parlement, Premier Ministre, Journal Officiel, L�gifrance�) et savoir les utiliser.','N','O');
insert into pfolio_data values('','64','15','Conna�tre les types de contenu et les grandes rubriques de l\'intranet d\'un service ou d\'un minist�re','N','O');
insert into pfolio_data values('','64','16','Identifier diff�rents acteurs et leur r�le (webmestres, responsables r�seau, responsable s�curit�)','N','O');
insert into pfolio_data values('','64','17','Conna�tre les grands principes d\'utilisation des TIC par les organisations syndicales dans la fonction publique.','N','O');
## DEFI niveau 2 ##
insert into pfolio_data values('','65','1','Savoir mettre en ligne des documents de fa�on �l�mentaire','N','O');
insert into pfolio_data values('','65','2','r�gles de nommage','N','O');
insert into pfolio_data values('','65','3','types de fichiers (formats de fichiers)','N','O');
insert into pfolio_data values('','65','4','les logiciels � utiliser','N','O');
insert into pfolio_data values('','65','5','les processus de publication : Savoir utiliser un �diteur HTML simple et mettre une page en ligne','N','O');

insert into pfolio_data values('','66','1','�crire � plusieurs destinataires (avec sa messagerie, au moyen d\'une liste de diffusion ou � l\'aide de son carnet d\'adresses)','N','O');
insert into pfolio_data values('','66','2','G�rer son carnet d\'adresses','N','O');
insert into pfolio_data values('','66','3','G�rer sa boite aux lettres (Trier ses messages, organiser ses dossiers)','N','O');
insert into pfolio_data values('','66','4','Recevoir et exploiter un fichier comme pi�ce jointe dans un format compress�','N','O');
insert into pfolio_data values('','66','5','Sauvegarder une pi�ce jointe','N','O');
insert into pfolio_data values('','66','6','Identifier les ordres de grandeur de tailles de fichiers pouvant �tre envoy�s en pi�ce jointe','N','O');
insert into pfolio_data values('','66','7','Conna�tre la notion de � SPAM � (messages �lectroniques non sollicit�s) et les r�gles pour l\'�viter','N','O');
insert into pfolio_data values('','66','8','Rendre les pi�ces jointes exploitables par les destinataires','N','O');
insert into pfolio_data values('','66','9','Utiliser avec pertinence l\'envoi multiple','N','O');
insert into pfolio_data values('','66','10','�crire des contributions sur des forums','N','O');
insert into pfolio_data values('','66','11','Respecter les r�gles de participation � des forums','N','O');

insert into pfolio_data values('','67','1','Garder l\'adresse d\'un site au moyen des favoris ou signets,','N','O');
insert into pfolio_data values('','67','2','Utiliser un moteur de recherche','N','O');
insert into pfolio_data values('','67','3','�laborer une strat�gie de recherche (faire la diff�rence entre un moteur de recherche et un annuaire)','N','O');
insert into pfolio_data values('','67','4','Connaissance approfondie de l\'Internet','N','O');

insert into pfolio_data values('','68','1','Conna�tre le r�le des cookies','N','O');
insert into pfolio_data values('','68','2','Savoir que l\'on peut les activer et les d�sactiver sur son poste','N','O');
insert into pfolio_data values('','68','3','Conna�tre les r�les des dispositifs de protection (pare-feux, antivirus, cryptographie, sites internet s�curis�s)','N','O');
insert into pfolio_data values('','68','4','Comprendre les principaux dispositifs d\'authentification et les principes de la signature �lectronique','N','O');

insert into pfolio_data values('','69','1','Les obligations (d�claration des traitements, principe de finalit�)','N','O');
insert into pfolio_data values('','69','2','Caract�re public de la communication sur des forums','N','O');
insert into pfolio_data values('','69','3','Propri�t� intellectuelle (Droit d\'auteur, protection des logiciels�)','N','O');
insert into pfolio_data values('','69','4','Reconna�tre quelques exemples pratiques de ce que l\'on peut faire et ne pas faire','N','O');

insert into pfolio_data values('','70','1','La d�mat�rialisation des proc�dures','N','O');
insert into pfolio_data values('','70','2','Conna�tre quelques contenus des SIT (syst�mes d\'information territoriaux)','N','O');
insert into pfolio_data values('','70','3','Savoir utiliser le m�ta-annuaire Maia','N','O');
insert into pfolio_data values('','70','4','retrouver l\'adresse m�l d\'un correspondant dans le m�ta annuaire Maia','N','O');
insert into pfolio_data values('','70','5','Conna�tre les grandes fonctionnalit�s de CELIA (ou DOLCE) (outil de gestion de communaut�s virtuelles sur ADER et Internet)','N','O');
## NSI ##
insert into pfolio_data values('','71','1','�tablir la connexion � Internet','N','O');
insert into pfolio_data values('','71','2','utiliser les principales fonctionnalit�s d\'un navigateur','N','O');
insert into pfolio_data values('','71','3','circuler dans l\'architecture du r�seau (la toile)','N','O');
insert into pfolio_data values('','71','4','organiser un � bureau virtuel � en classant les sites favoris en fonction des th�matiques recherch�es','N','O');

insert into pfolio_data values('','72','1','comprendre et utiliser le vocabulaire sp�cifique et les usages (Netiquette) facilitant l\'int�gration dans la communaut� des internautes','N','O');
insert into pfolio_data values('','72','2','utiliser le courrier �lectronique dans ses principales fonctionnalit�s','N','O');
insert into pfolio_data values('','72','3','t�l�charger les fichiers joints en organisant son disque dur','N','O');
insert into pfolio_data values('','72','4','participer � des forums et � des news groups','N','O');
insert into pfolio_data values('','72','5','conna�tre les fonctions et les usages de la communication synchrone (le � chat �)','N','O');

insert into pfolio_data values('','73','1','organiser sa question pour obtenir la r�ponse adapt�e','N','O');
insert into pfolio_data values('','73','2','obtenir des r�sultats satisfaisants � la question pos�e en utilisant les fonctions simples et th�matiques d\'un moteur de recherche','N','O');
insert into pfolio_data values('','73','3','savoir quand et comment solliciter la communaut� des internautes (principalement par l\'utilisation des forums) pour affiner sa recherche ou contribuer soi m�me.','N','O');
###############################################################################