<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2002-2006 by Dominique Laporte(C-E-D@wanadoo.fr)

   This file is part of Prom�th�e.

   Prom�th�e is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   Prom�th�e is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with Prom�th�e.  If not, see <http://www.gnu.org/licenses/>.
 *-----------------------------------------------------------------------*/
?>

<?php
/*
 *		module   : ephemeride.php
 *		projet   : affichage de la f�te du jour
 *
 *		version  : 1.1
 *		auteur   : laporte
 *		creation : 2/11/02
 *		modif    : 4/03/06 - par D. Laporte
 *                     afiichage d'�v�nements : <saint|�v�nement>
 */


//---------------------------------------------------------------------------
// Fonction d'ephemeride
function ephemeride($jour, $mois)
{
	$saint = array();

	$saint[1][1]  = "le Jour de l'an";
	$saint[1][2]  = "Basile";
	$saint[1][3]  = "Genevi�ve";
	$saint[1][4]  = "Odilon";
	$saint[1][5]  = "Edouard";
	$saint[1][6]  = "Balthazar";
	$saint[1][7]  = "Raymond";
	$saint[1][8]  = "Lucien";
	$saint[1][9]  = "Alix";
	$saint[1][10] = "Guillaume";
	$saint[1][11] = "Hortense et Pauline";
	$saint[1][12] = "Tatiana";
	$saint[1][13] = "Hilaire et Yvette";
	$saint[1][14] = "Nina";
	$saint[1][15] = "Rachel et R�mi";
	$saint[1][16] = "Marcel";
	$saint[1][17] = "Roseline";
	$saint[1][18] = "Gwendal et Prisca";
	$saint[1][19] = "Marius";
	$saint[1][20] = "Fabien et S�bastien";
	$saint[1][21] = "Agn�s";
	$saint[1][22] = "Vincent";
	$saint[1][23] = "Banard";
	$saint[1][24] = "Fran�ois de Sales";
	$saint[1][25] = "Conversion de Paul";
	$saint[1][26] = "Pauline et Timoth�";
	$saint[1][27] = "Ang�le";
	$saint[1][28] = "Manfred et Thomas d'Aquin";
	$saint[1][29] = "Gildas";
	$saint[1][30] = "Jacinthe et Martine";
	$saint[1][31] = "Marcelle";
	$saint[2][1]  = "Ella et Sim�on";
	$saint[2][2]  = "Th�ophane";
	$saint[2][3]  = "Blaise";
	$saint[2][3]  = "Nelson et Oscar";
	$saint[2][4]  = "V�ronique";
	$saint[2][5]  = "Agathe";
	$saint[2][6]  = "Doroth�e et Gaston";
	$saint[2][7]  = "Eug�nie";
	$saint[2][8]  = "Jacqueline";
	$saint[2][9]  = "Apolline";
	$saint[2][10] = "Arnaud";
	$saint[2][11] = "Notre Dame de Lourdes";
	$saint[2][12] = "F�lix";
	$saint[2][13] = "B�atrice";
	$saint[2][14] = "Valentin";
	$saint[2][15] = "Claude";
	$saint[2][16] = "Julienne";
	$saint[2][17] = "Alexis";
	$saint[2][18] = "Bernadette";
	$saint[2][19] = "Gabin";
	$saint[2][20] = "Aim�e";
	$saint[2][21] = "Damien";
	$saint[2][22] = "Isabelle";
	$saint[2][23] = "Lazare";
	$saint[2][24] = "Modeste";
	$saint[2][25] = "Rom�o";
	$saint[2][26] = "Nestor";
	$saint[2][27] = "Honorine et L�andre";
	$saint[2][28] = "Romain";
	$saint[2][29] = "Auguste";
	$saint[3][1]  = "Albin";
	$saint[3][2]  = "Charles le Bon";
	$saint[3][3]  = "Gu�nol� et Marin";
	$saint[3][4]  = "Casimir";
	$saint[3][5]  = "Olivia";
	$saint[3][6]  = "Colette";
	$saint[3][7]  = "F�licie et Nathan";
	$saint[3][8]  = "Jean de Dieu";
	$saint[3][9]  = "Fran�oise";
	$saint[3][10] = "Vivien";
	$saint[3][11] = "Rosine";
	$saint[3][12] = "Justine et Pol";
	$saint[3][13] = "Rodrigue";
	$saint[3][14] = "Mathilde";
	$saint[3][15] = "Louise";
	$saint[3][16] = "B�n�dicte";
	$saint[3][17] = "Patrice et Patrick";
	$saint[3][18] = "Cyrille";
	$saint[3][19] = "Joseph";
	$saint[3][20] = "le Printemps|joyeux anniversaire Dom !";
	$saint[3][21] = "Axelle et Cl�mence";
	$saint[3][22] = "L�a";
	$saint[3][23] = "R�becca";
	$saint[3][23] = "Victorien";
	$saint[3][24] = "Catherine et Karine";
	$saint[3][25] = "Humbert";
	$saint[3][26] = "Larissa";
	$saint[3][27] = "Habib";
	$saint[3][28] = "Gontran";
	$saint[3][29] = "Gladys";
	$saint[3][30] = "Am�d�e";
	$saint[3][31] = "Benjamin";
	$saint[4][1]  = "Hugues et Val�ry";
	$saint[4][2]  = "Sandrine";
	$saint[4][3]  = "Richard";
	$saint[4][4]  = "Isidore";
	$saint[4][5]  = "Ir�ne";
	$saint[4][6]  = "Marcellin";
	$saint[4][7]  = "Clotaire et Jean-Baptiste de la Salle";
	$saint[4][8]  = "Julie";
	$saint[4][9]  = "Gautier";
	$saint[4][10] = "Fulbert";
	$saint[4][11] = "Stanislas";
	$saint[4][12] = "Jules";
	$saint[4][13] = "Ida";
	$saint[4][14] = "Ludivine et Maxime";
	$saint[4][15] = "C�sar";
	$saint[4][16] = "Rameaux";
	$saint[4][17] = "Anicet";
	$saint[4][18] = "Parfait";
	$saint[4][19] = "Emma";
	$saint[4][20] = "Odette et Th�otime";
	$saint[4][21] = "Anselme";
	$saint[4][22] = "Alexandre";
	$saint[4][23] = "Georges";
	$saint[4][24] = "Fid�le";
	$saint[4][25] = "Marc";
	$saint[4][26] = "Alida";
	$saint[4][27] = "Zita";
	$saint[4][28] = "Val�rie";
	$saint[4][29] = "Catherine de Sienne";
	$saint[4][30] = "Robert";
	$saint[5][1]  = "le 1er mai";
	$saint[5][2]  = "Boris et Zo�";
	$saint[5][3]  = "Philippe";
	$saint[5][4]  = "Florian et Sylvain";
	$saint[5][5]  = "Judith";
	$saint[5][6]  = "Marien et Prudence";
	$saint[5][7]  = "Domitille et Gis�le";
	$saint[5][8]  = "D�sir�";
	$saint[5][9]  = "Pac�me";
	$saint[5][10] = "Solange";
	$saint[5][11] = "Estelle et Mayeul";
	$saint[5][12] = "Achille";
	$saint[5][13] = "Ma�l";
	$saint[5][14] = "Agla� et Matthias";
	$saint[5][15] = "Denise";
	$saint[5][16] = "Brendan et Honor�";
	$saint[5][17] = "Pascal";
	$saint[5][18] = "Eric";
	$saint[5][19] = "C�lestin";
	$saint[5][20] = "Bernardin";
	$saint[5][21] = "Constantin";
	$saint[5][22] = "Emile";
	$saint[5][23] = "Didier";
	$saint[5][24] = "Donatien";
	$saint[5][25] = "Sophie";
	$saint[5][26] = "B�renger";
	$saint[5][27] = "Augustin";
	$saint[5][28] = "Germain";
	$saint[5][29] = "Aymar";
	$saint[5][30] = "Ferdinand";
	$saint[5][31] = "P�tronille";
	$saint[6][1]  = "Justin et Ronan";
	$saint[6][2]  = "Blandine";
	$saint[6][3]  = "K�vin";
	$saint[6][4]  = "Clothilde";
	$saint[6][5]  = "Igor";
	$saint[6][6]  = "Norbert";
	$saint[6][7]  = "Gilbert";
	$saint[6][8]  = "M�dard";
	$saint[6][9]  = "Diane";
	$saint[6][10] = "Landry";
	$saint[6][11] = "Barnab�";
	$saint[6][12] = "Guy";
	$saint[6][13] = "Antoine de Padoue";
	$saint[6][14] = "Elis�e et Val�re";
	$saint[6][15] = "Germaine";
	$saint[6][16] = "Fran�ois-R�gis et R�gis";
	$saint[6][17] = "Herv�";
	$saint[6][18] = "L�once";
	$saint[6][19] = "Gervais et Romuald";
	$saint[6][20] = "Silv�re";
	$saint[6][21] = "Et�";
	$saint[6][22] = "Alban";
	$saint[6][23] = "Audrey";
	$saint[6][24] = "Jean-Baptiste";
	$saint[6][25] = "Ali�nor";
	$saint[6][25] = "Prosper";
	$saint[6][26] = "Anthelme";
	$saint[6][27] = "Fernand";
	$saint[6][28] = "Ir�n�e";
	$saint[6][29] = "Paul et Pierre";
	$saint[6][30] = "Adolphe et Martial";
	$saint[7][1]  = "Aaron";
	$saint[7][2]  = "Martinien";
	$saint[7][3]  = "Thomas";
	$saint[7][4]  = "Florent";
	$saint[7][5]  = "Antoine";
	$saint[7][6]  = "Nolwen et Mariette";
	$saint[7][7]  = "Raoul";
	$saint[7][8]  = "Edgar";
	$saint[7][9]  = "Amandine";
	$saint[7][10] = "Ulrich";
	$saint[7][11] = "Benoit";
	$saint[7][12] = "Jason et Olivier";
	$saint[7][13] = "Enzo";
	$saint[7][14] = "Camille";
	$saint[7][15] = "Donald";
	$saint[7][15] = "Vladimir";
	$saint[7][16] = "Elvire";
	$saint[7][17] = "Arlette et Charlotte et Marcelline";
	$saint[7][18] = "Fr�d�ric";
	$saint[7][19] = "Ars�ne et Micheline";
	$saint[7][20] = "Elie et Marina";
	$saint[7][21] = "Rodolphe";
	$saint[7][22] = "Madeleine et Wandrille";
	$saint[7][23] = "Brigitte";
	$saint[7][24] = "Christine et S�gol�ne";
	$saint[7][25] = "Jacques et Valentine";
	$saint[7][26] = "Anne";
	$saint[7][27] = "Aur�le et Nathalie";
	$saint[7][28] = "Samson";
	$saint[7][29] = "B�atrice";
	$saint[7][30] = "Juliette";
	$saint[7][31] = "Ignace de Loyola";
	$saint[8][1]  = "Alphonse";
	$saint[8][2]  = "Julien Eymard";
	$saint[8][3]  = "Lydie";
	$saint[8][4]  = "Vianney";
	$saint[8][5]  = "Abel";
	$saint[8][6]  = "Transfiguration";
	$saint[8][7]  = "Ga�tan";
	$saint[8][8]  = "Dominique";
	$saint[8][9]  = "Amour";
	$saint[8][10] = "Laurent";
	$saint[8][11] = "Claire";
	$saint[8][12] = "Clarisse";
	$saint[8][13] = "Hippolyte";
	$saint[8][14] = "Evrard";
	$saint[8][15] = "Alfred et Marie";
	$saint[8][16] = "Armel et Roch";
	$saint[8][17] = "Hyacinthe";
	$saint[8][18] = "H�l�ne et La�titia";
	$saint[8][19] = "Jean Eudes";
	$saint[8][20] = "Bernard et Samuel";
	$saint[8][21] = "Christophe";
	$saint[8][22] = "Fabrice";
	$saint[8][23] = "Rose de Lima";
	$saint[8][24] = "Barth�l�my";
	$saint[8][25] = "Louis";
	$saint[8][26] = "Natacha";
	$saint[8][27] = "Monique";
	$saint[8][28] = "Augustin et Elouan";
	$saint[8][29] = "M�d�ric et Sabine";
	$saint[8][30] = "Fiacre";
	$saint[8][31] = "Aristide";
	$saint[9][1]  = "Gilles et Jossu�";
	$saint[9][2]  = "Ingrid";
	$saint[9][3]  = "Gr�goire";
	$saint[9][4]  = "Rosalie";
	$saint[9][5]  = "Bertin";
	$saint[9][6]  = "Bertrand et Eva";
	$saint[9][7]  = "Reine";
	$saint[9][8]  = "Adrien";
	$saint[9][9]  = "Alain et Omer";
	$saint[9][10] = "In�s";
	$saint[9][11] = "Adelphe";
	$saint[9][12] = "Apollinaire";
	$saint[9][13] = "Aim�";
	$saint[9][14] = "Croix Glorieuse";
	$saint[9][15] = "Dolores et Roland";
	$saint[9][16] = "Edith";
	$saint[9][17] = "Hildegarde";
	$saint[9][18] = "V�ra";
	$saint[9][18] = "Nad�ge";
	$saint[9][19] = "Emilie";
	$saint[9][20] = "Davy";
	$saint[9][21] = "Matthieu";
	$saint[9][21] = "D�borah";
	$saint[9][22] = "Maurice";
	$saint[9][23] = "Faustine";
	$saint[9][24] = "Th�cle";
	$saint[9][25] = "Hermann";
	$saint[9][26] = "C�me et Damien";
	$saint[9][27] = "Vincent de Paul";
	$saint[9][28] = "Venceslas";
	$saint[9][29] = "Gabriel et Michel";
	$saint[9][29] = "Rapha�l";
	$saint[9][30] = "J�r�me";
	$saint[10][1] = "Ariel";
	$saint[10][1] = "Th�r�se de l'Enfant J�sus";
	$saint[10][2] = "L�ger et Ruth";
	$saint[10][3] = "G�rard et Sybille";
	$saint[10][4] = "Fran�ois d'assise";
	$saint[10][5] = "Cam�ia";
	$saint[10][6] = "Bruno";
	$saint[10][7] = "Gustave et Serge";
	$saint[10][8] = "P�agie et Tha�s";
	$saint[10][9] = "Denis";
	$saint[10][10] = "Ghislain";
	$saint[10][11] = "Firmin";
	$saint[10][12] = "Edwin";
	$saint[10][13] = "G�raud";
	$saint[10][14] = "C�leste";
	$saint[10][15] = "Th�r�se d'Avila";
	$saint[10][16] = "Edwige";
	$saint[10][17] = "Baudoin et Sol�ne";
	$saint[10][18] = "Luc";
	$saint[10][19] = "Cl�o et Ren�";
	$saint[10][20] = "Adeline et Aline";
	$saint[10][21] = "C�line et Ursule";
	$saint[10][22] = "Elodie";
	$saint[10][23] = "Jean de Capistran et Simon";
	$saint[10][24] = "Florentin";
	$saint[10][25] = "Cr�pin";
	$saint[10][26] = "Dimitri";
	$saint[10][27] = "Emeline";
	$saint[10][28] = "Jude et Simon";
	$saint[10][29] = "Narcisse";
	$saint[10][30] = "Bienvenue et Ma�va";
	$saint[10][31] = "Quentin";
	$saint[11][1]  = "Toussaint";
	$saint[11][2]  = "D�funts";
	$saint[11][3]  = "Gwena�l et Hubert";
	$saint[11][4]  = "Aymeric";
	$saint[11][5]  = "Sylvie et Zacharie";
	$saint[11][6]  = "Bertille et L�onard";
	$saint[11][7]  = "Carine";
	$saint[11][8]  = "Dora et Geoffroy";
	$saint[11][9]  = "Maturin et Th�odore";
	$saint[11][10] = "L�on et No�";
	$saint[11][11] = "Martin et V�rane";
	$saint[11][12] = "Christian";
	$saint[11][13] = "Brice";
	$saint[11][14] = "Sidoine";
	$saint[11][15] = "Albert";
	$saint[11][16] = "Gertrude";
	$saint[11][17] = "Elisabeth";
	$saint[11][18] = "Aude";
	$saint[11][19] = "Tanguy";
	$saint[11][20] = "Edmond et Octave";
	$saint[11][21] = "Pr�sence de Marie";
	$saint[11][22] = "C�cile";
	$saint[11][23] = "Cl�ment";
	$saint[11][24] = "Flora";
	$saint[11][25] = "Catherine";
	$saint[11][26] = "Delphine";
	$saint[11][27] = "S�verin";
	$saint[11][28] = "Jacques de la Marche";
	$saint[11][29] = "Saturnin";
	$saint[11][30] = "Andr� et Tugdual";
	$saint[12][1]  = "Florence";
	$saint[12][2]  = "Viviane";
	$saint[12][3]  = "Xavier";
	$saint[12][4]  = "Barbara";
	$saint[12][5]  = "G�rald et G�rard";
	$saint[12][6]  = "Nicolas";
	$saint[12][7]  = "Ambroise";
	$saint[12][8]  = "Immacul�e Conception";
	$saint[12][9]  = "Pierre Fourier";
	$saint[12][10] = "Eulaire et Romaric";
	$saint[12][11] = "Daniel";
	$saint[12][12] = "Chantal";
	$saint[12][13] = "Jocelyn et Lucie";
	$saint[12][14] = "Odile";
	$saint[12][15] = "Ninon";
	$saint[12][16] = "Alice";
	$saint[12][17] = "Ad�la�de";
	$saint[12][18] = "Briac et Gatien";
	$saint[12][19] = "Urbain";
	$saint[12][20] = "Isaac";
	$saint[12][21] = "Pierre Canis";
	$saint[12][22] = "Fran�oise-Xavi�re et Gratien";
	$saint[12][23] = "Armand";
	$saint[12][24] = "Ad�le";
	$saint[12][25] = "Manuel";
	$saint[12][26] = "Etienne";
	$saint[12][27] = "Fabiola et Jean";
	$saint[12][28] = "Gaspard";
	$saint[12][29] = "David";
	$saint[12][30] = "Roger";
	$saint[12][31] = "Sylvestre";	

	$mois = intval($mois);
 	$jour = intval($jour);

	if ( ($mois < 1) || ($mois > 12) )
		return "";

	return ( isset($saint[$mois][$jour]) )
		? $saint[$mois][$jour]
		: "" ;
}
//---------------------------------------------------------------------------
?>