<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2007 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : typo.php
 *		projet   : d�finition des messages
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 30/03/2007
 *		modif    : 
 *
 */

//---------------------------------------------------------------------------
static	$message = Array(

"l'ENT � clef en main � Libre et gratuit",
"fermer cette fen�tre",
"
<h1>
Les raccourcis typographiques
</h1>

<p>
Pour faciliter la mise en page des documents, le syst�me propose un certain nombre de � raccourcis � destin�s :<br/>
-> � simplifier l'utilisation par des utilisateurs ne connaissant pas le HTML ;<br/>
-> � faciliter le traitement automatique de la mise en page.
</p>

<p>
Ainsi, vous pouvez naturellement utiliser du code HTML dans vos documents, mais nous vous conseillons d'utiliser de pr�f�rence ces quelques raccourcis, plus simples � m�moriser, et permettant surtout quelques manipulations automatiques par le syst�me.
</p>

<h2>
-> Fabriquer des listes ou des �num�rations
</h2>

<p>
On peut fabriquer des listes, il suffit de revenir � la ligne et de commencer la nouvelle ligne avec un tiret (� - �) suivi d'un des caract�res suivants :
</p>

-# pour une num�rotation automatique. <br/>
-> pour la puce graphique <br/>
-\$ pour la puce graphique <br/>
-� pour la puce graphique <br/>
-* pour la puce graphique <br/>
-. pour la puce graphique <br/>
-: pour la puce graphique <br/>

<p>
Par exemple, <br/>
-# Linux est gratuit <br/>
-# Linux est Open Source <br/>
sera affich� ainsi : <br/>
1. Linux est gratuit <br/>
2. Linux est Open Source <br/>
</p>

<h2>
-> Gras et italique
</h2>

<p>
On indique simplement du texte en italique en le pla�ant entre des accolades simples : � ...du texte {en italique} en... �.
</p>

<p>
On indique du texte en gras en le pla�ant entre des accolades doubles : � ...du texte {{en gras}} en... �.
</p>

<p>
On indique du texte en gras italique en le pla�ant entre des accolades triples : � ...du texte {{{en gras italique}}} en... �.
</p>

<h2>
-> Trait de s�paration horizontal
</h2>

<p>
Il est tr�s simple d'ins�rer un trait de s�paration horizontal sur toute la largeur du texte : il suffit de placer une ligne ne contenant qu'une succession de quatre, trois ou deux tirets, ainsi :
</p>

----
<hr/>

---
<hr style=\"width: 75%;\" />
-- 
<hr style=\"width: 50%;\" />

<h2>
-> Tableaux
</h2>

<p>
Pour r�aliser des tableaux, il suffit de faire des lignes dont les � cases � sont s�par�es par le symbole � | � (pipe, un trait vertical), lignes commen�ant et se terminant par des traits verticaux.
</p>

<p>
se code ainsi :
</p>

| {{Nom}} | {{Pr�nom}} | {{Age}} | <br/>
| Marso | Ben | 23 ans | <br/>
| Capitaine | | non connu | <br/>
| Philant | Philippe | 46 ans | <br/>
| Cadoc | B�b� | 4 mois |

<h2>
-> Titre
</h2>

<p>
Par d�faut, la premi�re ligne qui d�bute votre document est prise comme titre principal. Pour indiquer un titre, il suffit de placer le caract�re  @  en d�but de ligne.
</p>

Ainsi,  @mon titre , deviendra :
<h3>mon titre</h3>
<hr/>

<h2>
-> Paragraphes
</h2>

<p>
Les paragraphes permettent de s�parer des parties distinctes de votre document et de g�n�rer automatiquement un sommaire. L'�diteur g�re 2 niveaux de paragraphe que l'on repr�sente de la fa�on suivante :
</p>

==paragraphe niveau 1== <br/>
===paragraphe niveau 2=== <br/>
qui s'affichent respectivement :
<h2>paragraphe niveau 1</h2>
<hr/>
<h3>paragraphe niveau 2</h3>
<hr/>

<h2>
-> Les liens hypertextes
</h2>

<p>
On fabriquera facilement un lien hypertexte avec le code suivant : � Prom�th�e a �t� d�velopp� sous [licence GPL->http://www.april.org/]. � devient � Prom�th�e a �t� d�velopp� sous licence GPL. �.
</p>

De m�me pour une adresse email (� [->infos@april.org] �)...

Ou un lien qui renvoie � un autre document collaboratif (� la [[licence GPL]] �)...

<p>
Pour faire appara�tre un commentaire sur le survol de la souris, il suffit de s�parer votre commentaire de l'adresse par le caract�re |. Exemple : [licence GPL->http://www.april.org/|General Public License].
</p>

<h2>
-> Notes de bas de page
</h2>

<p>
Une note de bas de page est, habituellement, signal�e par un num�ro plac� � l'int�rieur du texte, num�ro repris en bas de page et proposant un compl�ment d'information.
</p>

<p>
Une note de bas de page est indiqu�e entre crochets avec des parenth�ses : � Une note[(*)Voici un compl�ment d'information.] de bas de page. � sera affich� sous la forme : � Une note [*] de bas de page. �
</p>

Des notes non automatiques

<p>
Dans la plupart des cas, le syst�me de notes automatiques indiqu� ci-dessus suffit amplement. Cependant, vous pouvez g�rer les notes d'une mani�re non automatique.
</p>

Par exemple : � Vous pouvez utiliser les notes num�rot�es automatiques[() En n'indiquant rien entre parenth�ses.], <br/>
-> mais aussi forcer la num�rotation de la note[(23) En indiquant le num�ro de la note entre parenth�ses.], <br/>
-> utiliser des notes sous forme d'ast�risques [(*) En pla�ant simplement une ast�risque entre parenth�ses.], <br/>
-> donner un nom (en toutes lettres) � une note[(Rab) Fran�ois Rabelais.];

<p>
Ce qui donne :
</p>

� Vous pouvez utiliser les notes num�rot�es automatiques [3], <br/>
 mais aussi forcer la num�rotation de la note [23], <br/>
 utiliser des notes sous forme d'ast�risques [*], <br/>
 donner un nom (en toutes lettres) � une note [Rab] ;

<hr width=\"30%\" align=\"left\" />

<p class=\"small\">
[3] En n'indiquant rien entre parenth�ses. <br/>
[23] En indiquant le num�ro de la note entre parenth�ses. <br/>
[*] En pla�ant simplement une ast�risque entre parenth�ses. <br/>
[Rab] Fran�ois Rabelais.
</p>
"

);
//---------------------------------------------------------------------------
?>