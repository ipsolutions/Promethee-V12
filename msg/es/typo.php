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
 *		modif    : 12/08/2007 11:30:58 a.m. Fernando Cormenzana
 *
 */

//---------------------------------------------------------------------------
static	$message = Array(

"El Num�ricos 'llave en mano' libre y gratuito",
"cerrar esta ventana",
"
<h1>
Los atajos tipogr�ficos
</h1>

<p>
Para facilitar la diagramaci�n de los documentos, el sistema propone un cierto n�mero de 'atajos' destinados a:<br/>
-> simplificar la utilizaci�n para aquellos que no conozcan HTML;<br/>
-> facilitar el procesamiento autom�tico de la diagramaci�n.
</p>

<p>
As�, usted puede usar naturalmente el c�digo HTML en sus documentos, pero lo aconsejamos usar preferentemente estos atajos de teclado, m�s sencillos de memorizar, y que permiten adem�s algunas manipulaciones autom�ticas del sistema.
</p>

<h2>
-> Fabricar listas o enumeraciones
</h2>

<p>
Se pueden fabricar listas de manera muy sencilla comenzando cada nueva l�nea con un gui�n ('-') seguido de uno de los siguientes caracteres:
</p>

-# para una numeraci�n autom�tica <br/>
-> para la vi�eta gr�fica <br/>
-\$ para la vi�eta gr�fica <br/>
-� para la vi�eta gr�fica <br/>
-* para la vi�eta gr�fica <br/>
-. para la vi�eta gr�fica <br/>
-: para la vi�eta gr�fica <br/>

<p>
Por ejemplo, <br/>
-# Linux es gratuito <br/>
-# Linux es Open Source <br/>
ser� desplegado as� : <br/>
1. Linux es gratuito <br/>
2. Linux es Open Source <br/>
</p>

<h2>
-> Negrita e it�licas
</h2>

<p>
Para indicar que un texto aparecer� en it�licas se lo debe escribir entre corchetes simples: � ...texto {en it�licas} ... �.
</p>

<p>
Para indicar un texto en negrita se lo debe escribir entre corchetes dobles: � ...texto {{en negrita}} ... �.
</p>

<p>
Para indicar un texto en negrita e it�licas se lo debe escribrir entre corchetes triples: � ...texto {{{en negrita e it�licas}}} ... �.
</p>

<h2>
-> L�nea de separaci�n horizontal
</h2>

<p>
Para una l�nea que ocupe todo el ancho del texto alcanza con escribir una l�nea conteniendo 2, 3 o 4 guiones :
</p>

----
<hr/>

---
<hr style=\"width: 75%;\" />
-- 
<hr style=\"width: 50%;\" />

<h2>
-> Cuadros
</h2>

<p>
Para crear cuadros alcanza con con crear l�neas en las que los 'casilleros' est�n separados por el s�mbolo � | � (pipe, un trazo vertical). Las l�neas comienzan y terminan con trazos verticales.
</p>

<p>
se codifica as� :
</p>

| {{Apellido}} | {{Nombre}} | {{Edad}} | <br/>
| Marso | Ben | 23 a�os | <br/>
| Capit�n | | no conocido | <br/>
| Philant | Philippe | 46 a�os | <br/>
| Cadoc | Bebe | 4 meses |

<h2>
-> T�tulo
</h2>

<p>
Por defecto, la primera l�nea de su documento es considerada el t�tulo principal. Para indicar un t�tulo alcanza con ubicar el car�cter '@' el principio de la l�nea.
</p>

As�,  @mi t�tulo se escribir�:
<h3>mi t�tulo</h3>
<hr/>

<h2>
-> Par�grafos
</h2>

<p>
Los par�grafos permiten separar las distintas partes de su documento y generar autom�ticamente un sumario. l editor admite 2 niveles de par�grafos que se representar�n de la sigueinte manera:
</p>

==par�grafo nivel 1== <br/>
===par�grafo nivel 2=== <br/>
que se desplegar�n respectivamente:
<h2>par�grafo nivel 1</h2>
<hr/>
<h3>par�grafo nivel 2</h3>
<hr/>

<h2>
-> Los v�nculos hipertexto
</h2>

<p>
Para definir un v�nculo se emplear� el siguiente c�digo: � Prom�th�e a �t� d�velopp� sous [licence GPL->http://www.april.org/]. � se convierte en � Prom�th�e a �t� d�velopp� sous licence GPL. �.
</p>

Lo mismo para una direcci�n de correo electr�nico (� [->infos@april.org] �)...

O un v�nculo que remite a otro documento colaborativo (� la [[licencia GPL]] �)...

<p>
Para hacer aparecer un comentario al sobrevolar el rat�n, alcanza con separar el comentario de la direcci�n con el car�cter '|'.Ejemplo : [licence GPL->http://www.april.org/|General Public License].
</p>

<h2>
-> Notas de pie de p�gina
</h2>

<p>
Una nota de pie de p�gina es, en general, se�alada por un n�mero ubicado dentro del texto que se repite al pie de la p�gina para proponer un complemento de informaci�n.
</p>

<p>
Una nota de pie de p�ginas se indica entre par�ntesis rectos usando par�ntesis curvos: � Una nota[(*)He aqu� un complento de informaci�n.] de pie de p�gina. � ser� desplegada bajo la forma: � Una nota [*] de pie de p�gina. �
</p>

Notas no autom�ticas

<p>
En la mayor parte de los casos, el sistema de notas autom�ticas indicado anteriormente alcanza, pero puede tambi�n administrar sus notas de manera no autom�tica.
</p>

Por ejemplo: � Puede usar las notas numeradas autom�ticamente [() no indicando nada entre par�ntesis curvos.], <br/>
-> pero tambi�n forzar la numeraci�n de la nota [(23) indicando el n�mero entre par�ntesis.], <br/>
-> usar las notas bajo forma de asteriscos [(*) indicando un asterisco entre par�ntesis curvos.], <br/>
-> dar un nombre (con todas las letras) a una nota [(Rab) Fran�ois Rabelais.];

<p>
Lo que da :
</p>

� Puede usar las notas numeradas autom�ticamente [3], <br/>
 pero tambi�n forzar la numeraci�n de la nota [23], <br/>
 usar las notas bajo forma de asteriscos [*], <br/>
 dar un nombre (con todas las letras) a una nota [Rab] ;

<hr width=\"30%\" align=\"left\" />

<p class=\"small\">
[3] No indicando nada entre par�ntesis. <br/>
[23] Indicando el n�mero de la nota entre par�ntesis. <br/>
[*] Indicando un asterisco entre par�ntesis. <br/>
[Rab] Fran�ois Rabelais.
</p>
"

);
//---------------------------------------------------------------------------
?>