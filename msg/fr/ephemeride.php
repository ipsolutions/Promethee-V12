<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2002-2006 by Dominique Laporte(C-E-D@wanadoo.fr)

   This file is part of Prométhée.

   Prométhée is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   Prométhée is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with Prométhée.  If not, see <http://www.gnu.org/licenses/>.
 *-----------------------------------------------------------------------*/
?>

<?php
/*
 *		module   : ephemeride.php
 *		projet   : affichage de la fête du jour
 *
 *		version  : 1.1
 *		auteur   : laporte
 *		creation : 2/11/02
 *		modif    : 4/03/06 - par D. Laporte
 *                     afiichage d'évènements : <saint|évènement>
 */


//---------------------------------------------------------------------------
// Fonction d'ephemeride
function ephemeride($jour, $mois)
{
	$saint = array();

	$saint[1][1]  = "le Jour de l'an";
	$saint[1][2]  = "Basile";
	$saint[1][3]  = "Geneviève";
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
	$saint[1][15] = "Rachel et Rémi";
	$saint[1][16] = "Marcel";
	$saint[1][17] = "Roseline";
	$saint[1][18] = "Gwendal et Prisca";
	$saint[1][19] = "Marius";
	$saint[1][20] = "Fabien et Sébastien";
	$saint[1][21] = "Agnès";
	$saint[1][22] = "Vincent";
	$saint[1][23] = "Banard";
	$saint[1][24] = "François de Sales";
	$saint[1][25] = "Conversion de Paul";
	$saint[1][26] = "Pauline et Timothé";
	$saint[1][27] = "Angèle";
	$saint[1][28] = "Manfred et Thomas d'Aquin";
	$saint[1][29] = "Gildas";
	$saint[1][30] = "Jacinthe et Martine";
	$saint[1][31] = "Marcelle";
	$saint[2][1]  = "Ella et Siméon";
	$saint[2][2]  = "Théophane";
	$saint[2][3]  = "Blaise";
	$saint[2][3]  = "Nelson et Oscar";
	$saint[2][4]  = "Véronique";
	$saint[2][5]  = "Agathe";
	$saint[2][6]  = "Dorothée et Gaston";
	$saint[2][7]  = "Eugènie";
	$saint[2][8]  = "Jacqueline";
	$saint[2][9]  = "Apolline";
	$saint[2][10] = "Arnaud";
	$saint[2][11] = "Notre Dame de Lourdes";
	$saint[2][12] = "Félix";
	$saint[2][13] = "Béatrice";
	$saint[2][14] = "Valentin";
	$saint[2][15] = "Claude";
	$saint[2][16] = "Julienne";
	$saint[2][17] = "Alexis";
	$saint[2][18] = "Bernadette";
	$saint[2][19] = "Gabin";
	$saint[2][20] = "Aimée";
	$saint[2][21] = "Damien";
	$saint[2][22] = "Isabelle";
	$saint[2][23] = "Lazare";
	$saint[2][24] = "Modeste";
	$saint[2][25] = "Roméo";
	$saint[2][26] = "Nestor";
	$saint[2][27] = "Honorine et Léandre";
	$saint[2][28] = "Romain";
	$saint[2][29] = "Auguste";
	$saint[3][1]  = "Albin";
	$saint[3][2]  = "Charles le Bon";
	$saint[3][3]  = "Guénolé et Marin";
	$saint[3][4]  = "Casimir";
	$saint[3][5]  = "Olivia";
	$saint[3][6]  = "Colette";
	$saint[3][7]  = "Félicie et Nathan";
	$saint[3][8]  = "Jean de Dieu";
	$saint[3][9]  = "Françoise";
	$saint[3][10] = "Vivien";
	$saint[3][11] = "Rosine";
	$saint[3][12] = "Justine et Pol";
	$saint[3][13] = "Rodrigue";
	$saint[3][14] = "Mathilde";
	$saint[3][15] = "Louise";
	$saint[3][16] = "Bénédicte";
	$saint[3][17] = "Patrice et Patrick";
	$saint[3][18] = "Cyrille";
	$saint[3][19] = "Joseph";
	$saint[3][20] = "le Printemps|joyeux anniversaire Dom !";
	$saint[3][21] = "Axelle et Clémence";
	$saint[3][22] = "Léa";
	$saint[3][23] = "Rébecca";
	$saint[3][23] = "Victorien";
	$saint[3][24] = "Catherine et Karine";
	$saint[3][25] = "Humbert";
	$saint[3][26] = "Larissa";
	$saint[3][27] = "Habib";
	$saint[3][28] = "Gontran";
	$saint[3][29] = "Gladys";
	$saint[3][30] = "Amédée";
	$saint[3][31] = "Benjamin";
	$saint[4][1]  = "Hugues et Valéry";
	$saint[4][2]  = "Sandrine";
	$saint[4][3]  = "Richard";
	$saint[4][4]  = "Isidore";
	$saint[4][5]  = "Irène";
	$saint[4][6]  = "Marcellin";
	$saint[4][7]  = "Clotaire et Jean-Baptiste de la Salle";
	$saint[4][8]  = "Julie";
	$saint[4][9]  = "Gautier";
	$saint[4][10] = "Fulbert";
	$saint[4][11] = "Stanislas";
	$saint[4][12] = "Jules";
	$saint[4][13] = "Ida";
	$saint[4][14] = "Ludivine et Maxime";
	$saint[4][15] = "César";
	$saint[4][16] = "Rameaux";
	$saint[4][17] = "Anicet";
	$saint[4][18] = "Parfait";
	$saint[4][19] = "Emma";
	$saint[4][20] = "Odette et Théotime";
	$saint[4][21] = "Anselme";
	$saint[4][22] = "Alexandre";
	$saint[4][23] = "Georges";
	$saint[4][24] = "Fidèle";
	$saint[4][25] = "Marc";
	$saint[4][26] = "Alida";
	$saint[4][27] = "Zita";
	$saint[4][28] = "Valérie";
	$saint[4][29] = "Catherine de Sienne";
	$saint[4][30] = "Robert";
	$saint[5][1]  = "le 1er mai";
	$saint[5][2]  = "Boris et Zoé";
	$saint[5][3]  = "Philippe";
	$saint[5][4]  = "Florian et Sylvain";
	$saint[5][5]  = "Judith";
	$saint[5][6]  = "Marien et Prudence";
	$saint[5][7]  = "Domitille et Gisèle";
	$saint[5][8]  = "Désiré";
	$saint[5][9]  = "Pacôme";
	$saint[5][10] = "Solange";
	$saint[5][11] = "Estelle et Mayeul";
	$saint[5][12] = "Achille";
	$saint[5][13] = "Maël";
	$saint[5][14] = "Aglaé et Matthias";
	$saint[5][15] = "Denise";
	$saint[5][16] = "Brendan et Honoré";
	$saint[5][17] = "Pascal";
	$saint[5][18] = "Eric";
	$saint[5][19] = "Célestin";
	$saint[5][20] = "Bernardin";
	$saint[5][21] = "Constantin";
	$saint[5][22] = "Emile";
	$saint[5][23] = "Didier";
	$saint[5][24] = "Donatien";
	$saint[5][25] = "Sophie";
	$saint[5][26] = "Bérenger";
	$saint[5][27] = "Augustin";
	$saint[5][28] = "Germain";
	$saint[5][29] = "Aymar";
	$saint[5][30] = "Ferdinand";
	$saint[5][31] = "Pétronille";
	$saint[6][1]  = "Justin et Ronan";
	$saint[6][2]  = "Blandine";
	$saint[6][3]  = "Kévin";
	$saint[6][4]  = "Clothilde";
	$saint[6][5]  = "Igor";
	$saint[6][6]  = "Norbert";
	$saint[6][7]  = "Gilbert";
	$saint[6][8]  = "Médard";
	$saint[6][9]  = "Diane";
	$saint[6][10] = "Landry";
	$saint[6][11] = "Barnabé";
	$saint[6][12] = "Guy";
	$saint[6][13] = "Antoine de Padoue";
	$saint[6][14] = "Elisée et Valère";
	$saint[6][15] = "Germaine";
	$saint[6][16] = "François-Régis et Régis";
	$saint[6][17] = "Hervé";
	$saint[6][18] = "Léonce";
	$saint[6][19] = "Gervais et Romuald";
	$saint[6][20] = "Silvère";
	$saint[6][21] = "Eté";
	$saint[6][22] = "Alban";
	$saint[6][23] = "Audrey";
	$saint[6][24] = "Jean-Baptiste";
	$saint[6][25] = "Aliénor";
	$saint[6][25] = "Prosper";
	$saint[6][26] = "Anthelme";
	$saint[6][27] = "Fernand";
	$saint[6][28] = "Irénée";
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
	$saint[7][18] = "Frédéric";
	$saint[7][19] = "Arsène et Micheline";
	$saint[7][20] = "Elie et Marina";
	$saint[7][21] = "Rodolphe";
	$saint[7][22] = "Madeleine et Wandrille";
	$saint[7][23] = "Brigitte";
	$saint[7][24] = "Christine et Ségolène";
	$saint[7][25] = "Jacques et Valentine";
	$saint[7][26] = "Anne";
	$saint[7][27] = "Aurèle et Nathalie";
	$saint[7][28] = "Samson";
	$saint[7][29] = "Béatrice";
	$saint[7][30] = "Juliette";
	$saint[7][31] = "Ignace de Loyola";
	$saint[8][1]  = "Alphonse";
	$saint[8][2]  = "Julien Eymard";
	$saint[8][3]  = "Lydie";
	$saint[8][4]  = "Vianney";
	$saint[8][5]  = "Abel";
	$saint[8][6]  = "Transfiguration";
	$saint[8][7]  = "Gaétan";
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
	$saint[8][18] = "Hélène et Laétitia";
	$saint[8][19] = "Jean Eudes";
	$saint[8][20] = "Bernard et Samuel";
	$saint[8][21] = "Christophe";
	$saint[8][22] = "Fabrice";
	$saint[8][23] = "Rose de Lima";
	$saint[8][24] = "Barthélémy";
	$saint[8][25] = "Louis";
	$saint[8][26] = "Natacha";
	$saint[8][27] = "Monique";
	$saint[8][28] = "Augustin et Elouan";
	$saint[8][29] = "Médéric et Sabine";
	$saint[8][30] = "Fiacre";
	$saint[8][31] = "Aristide";
	$saint[9][1]  = "Gilles et Jossué";
	$saint[9][2]  = "Ingrid";
	$saint[9][3]  = "Grégoire";
	$saint[9][4]  = "Rosalie";
	$saint[9][5]  = "Bertin";
	$saint[9][6]  = "Bertrand et Eva";
	$saint[9][7]  = "Reine";
	$saint[9][8]  = "Adrien";
	$saint[9][9]  = "Alain et Omer";
	$saint[9][10] = "Inès";
	$saint[9][11] = "Adelphe";
	$saint[9][12] = "Apollinaire";
	$saint[9][13] = "Aimé";
	$saint[9][14] = "Croix Glorieuse";
	$saint[9][15] = "Dolores et Roland";
	$saint[9][16] = "Edith";
	$saint[9][17] = "Hildegarde";
	$saint[9][18] = "Véra";
	$saint[9][18] = "Nadège";
	$saint[9][19] = "Emilie";
	$saint[9][20] = "Davy";
	$saint[9][21] = "Matthieu";
	$saint[9][21] = "Déborah";
	$saint[9][22] = "Maurice";
	$saint[9][23] = "Faustine";
	$saint[9][24] = "Thècle";
	$saint[9][25] = "Hermann";
	$saint[9][26] = "Côme et Damien";
	$saint[9][27] = "Vincent de Paul";
	$saint[9][28] = "Venceslas";
	$saint[9][29] = "Gabriel et Michel";
	$saint[9][29] = "Raphaël";
	$saint[9][30] = "Jérôme";
	$saint[10][1] = "Ariel";
	$saint[10][1] = "Thérèse de l'Enfant Jésus";
	$saint[10][2] = "Léger et Ruth";
	$saint[10][3] = "Gérard et Sybille";
	$saint[10][4] = "François d'assise";
	$saint[10][5] = "Caméia";
	$saint[10][6] = "Bruno";
	$saint[10][7] = "Gustave et Serge";
	$saint[10][8] = "Péagie et Thaïs";
	$saint[10][9] = "Denis";
	$saint[10][10] = "Ghislain";
	$saint[10][11] = "Firmin";
	$saint[10][12] = "Edwin";
	$saint[10][13] = "Géraud";
	$saint[10][14] = "Céleste";
	$saint[10][15] = "Thérèse d'Avila";
	$saint[10][16] = "Edwige";
	$saint[10][17] = "Baudoin et Solène";
	$saint[10][18] = "Luc";
	$saint[10][19] = "Cléo et René";
	$saint[10][20] = "Adeline et Aline";
	$saint[10][21] = "Céline et Ursule";
	$saint[10][22] = "Elodie";
	$saint[10][23] = "Jean de Capistran et Simon";
	$saint[10][24] = "Florentin";
	$saint[10][25] = "Crépin";
	$saint[10][26] = "Dimitri";
	$saint[10][27] = "Emeline";
	$saint[10][28] = "Jude et Simon";
	$saint[10][29] = "Narcisse";
	$saint[10][30] = "Bienvenue et Maéva";
	$saint[10][31] = "Quentin";
	$saint[11][1]  = "Toussaint";
	$saint[11][2]  = "Défunts";
	$saint[11][3]  = "Gwenaël et Hubert";
	$saint[11][4]  = "Aymeric";
	$saint[11][5]  = "Sylvie et Zacharie";
	$saint[11][6]  = "Bertille et Léonard";
	$saint[11][7]  = "Carine";
	$saint[11][8]  = "Dora et Geoffroy";
	$saint[11][9]  = "Maturin et Théodore";
	$saint[11][10] = "Léon et Noé";
	$saint[11][11] = "Martin et Vérane";
	$saint[11][12] = "Christian";
	$saint[11][13] = "Brice";
	$saint[11][14] = "Sidoine";
	$saint[11][15] = "Albert";
	$saint[11][16] = "Gertrude";
	$saint[11][17] = "Elisabeth";
	$saint[11][18] = "Aude";
	$saint[11][19] = "Tanguy";
	$saint[11][20] = "Edmond et Octave";
	$saint[11][21] = "Présence de Marie";
	$saint[11][22] = "Cécile";
	$saint[11][23] = "Clément";
	$saint[11][24] = "Flora";
	$saint[11][25] = "Catherine";
	$saint[11][26] = "Delphine";
	$saint[11][27] = "Séverin";
	$saint[11][28] = "Jacques de la Marche";
	$saint[11][29] = "Saturnin";
	$saint[11][30] = "André et Tugdual";
	$saint[12][1]  = "Florence";
	$saint[12][2]  = "Viviane";
	$saint[12][3]  = "Xavier";
	$saint[12][4]  = "Barbara";
	$saint[12][5]  = "Gérald et Gérard";
	$saint[12][6]  = "Nicolas";
	$saint[12][7]  = "Ambroise";
	$saint[12][8]  = "Immaculée Conception";
	$saint[12][9]  = "Pierre Fourier";
	$saint[12][10] = "Eulaire et Romaric";
	$saint[12][11] = "Daniel";
	$saint[12][12] = "Chantal";
	$saint[12][13] = "Jocelyn et Lucie";
	$saint[12][14] = "Odile";
	$saint[12][15] = "Ninon";
	$saint[12][16] = "Alice";
	$saint[12][17] = "Adélaïde";
	$saint[12][18] = "Briac et Gatien";
	$saint[12][19] = "Urbain";
	$saint[12][20] = "Isaac";
	$saint[12][21] = "Pierre Canis";
	$saint[12][22] = "Françoise-Xavière et Gratien";
	$saint[12][23] = "Armand";
	$saint[12][24] = "Adèle";
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