/*
	dialdirect
*/

/*-----------------------------------------------------------------------*
   Copyright (c) 2005 by Louédin Stéphane (stef@neni.org)

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


/* Cette methode permet d'envoyer une fonction à à autre objet */
Function.prototype.bind = function(object) {
	var __method = this;
	return function() {
		return __method.apply(object, arguments);
	}
}


/* METHODE D'INITIALISATION DE l'OBJET
	cible    -> id du div qui va contenir le chat
	url       -> script du service php
	temps -> temps de rafraichissement en ms
	ident   -> identifiant de l'utilisateur (le nom?)
	genre  -> identifiant du type d'utilisateur (eleve, prof, etc...)
	salle   -> identifiant de la salle (la matière)
*/
	
var dialDirect = function(cible, url, temps, ident, genre, salle){
	// définition des variables de bases
	this.cible = cible;
	this.url = url;
	this.tps = temps;
	this.ident = ident;
	this.genre = genre;
	this.salle = salle;
	this.lasttps = 'connect';
	
	// deco par default
	this.decofin = this.decodebut = '';

	// initialisation du titre
	this.etitre = document.getElementById(this.cible+'_titre');
	this.etitre.innerHTML = salle;
	this.etitre.onclick = this.doSenderTous.bind(this);
	
	// bouton de fermeture de message prive
	document.getElementById(this.cible+'_close').onclick = this.doSenderTous.bind(this);
	
	// initialisation du bouton d'envoie
	document.getElementById(this.cible+'_ok').onclick = this.sendMessage.bind(this);
		
	// initialisation de la touche [entrer] pour l'input de saisie
	this.esaisie = document.getElementById(this.cible+'_saisie');
	this.esaisie.onkeypress = this.isEnter.bind(this);
		
	// le bouton d'etat
	this.eetat = document.getElementById(this.cible+'_etat');
	this.eetat.onclick = this.refreshMessage.bind(this);

	// autres elements 
	this.eenvoie = document.getElementById(this.cible+'_envoie_txt');
	this.eenvoieGraph = document.getElementById(this.cible+'_envoie');
	this.electure = document.getElementById(this.cible+'_lecture');
		
	// initiation du dialogue
	this.doSenderTous();
	this.loadMessage('');
}
	
dialDirect.prototype = {

	/* CHANGE L'INTRELOCUTEUR
		nom -> l'identifiant interlocuteur (vide:tous)
	*/
	doSender:function(nom){ 
		this.eenvoie.innerHTML = 'Private Message -> <b>'+nom+'</b>';
		this.interloc = nom;
		this.eenvoieGraph.className = "envoie";
		this.esaisie.focus();
		return false;
	},

	/* CHANGE INTERLOCUTEUR A TOUS */
	doSenderTous:function(){ 
		this.eenvoie.innerHTML = this.interloc = '';
		this.eenvoieGraph.className = "rien";
		this.esaisie.focus();
		return false;
	},

	/* envoie le message si la touche enter appuyée */
	isEnter:function(event){
		// pour IE
		if (window.event){ if(window.event.keyCode == 13){this.sendMessage(); }
		}else if( event.keyCode == 13 ){ this.sendMessage(); }
	},

	/* AJOUTE DU TEXTE */
	addTexte:function(txt){
		// ne postionne le text en bas que si le scroll en bas (tolerence 10 pixels)
		var scroll = ( this.electure.scrollTop +  this.electure.offsetHeight - this.electure.scrollHeight + 10 ) >0 ;
		this.electure.innerHTML += txt;
		if ( scroll ){ this.electure.scrollTop = this.electure.scrollHeight; }
	},
	
	/* ETAT DE LA REQUETE HTTP : RECUP INFO DU SERVEUR */
	onChangeEtat:function(){
		// le resultat est arrivé
		if (this.ajax.readyState == 4){
			// il n'y a pas de problème
//			if(this.ajax.status == 200) {
				// on fabrique le message
				var sortie = '';
				// recuperation de la chaine texte arrivée du serveur
				var m = this.ajax.responseText.split("\n");
				//alert(this.ajax.responseText);
				// recuperation du temps serveur
				this.lasttps = m[0];
				// parcours des messages
				var p = m.length -3;
				//alert(m.length +' - '+this.ajax.responseText);
				for(var j=1; j<p; j+=5){
					
					// deco en plus
					str = this.decodebut;
					
					// ajoute les logos d'info (privé, prof)
					var prive = false;
					var o = m[j+3].split("\t");
					var n = o.length;
					for(var i=0; i<n; i++){ 
						str += '<div class="'+o[i]+'"> </div>';
						if(o[i] == 'prive'){prive=true;}
					}
					
					// ajoute envoyeur et date
					var o = m[j+2].split("\t");
					str += '<b><a href="#" onClick="'+this.cible+'.doSender(\''+o[0]+'\'); return false;" title="Converser avec '+o[0]+'">'+o[0]+'</a> '+o[1]+'</b><br/>';
					
					// ajoute le message en lui même
					str += m[j+4];
					
					str += this.decofin;
					str += '</div>';
					
					sortie +=  '<div class="'+ ( (prive)? 'messageprive': 'message' ) +'">' + str;
				}
				this.addTexte(sortie);
//			}else{
//				// une erreur...
//				this.addTexte('<div class="erreur">'+this.decodebut+'erreur de connexion : '+this.ajax.status+this.decofin+'</div>'); 
//			}

			this.eetat.className = "etat";
			// relance la requete plus tard
			this.timeout = setTimeout( this.cible+".refreshMessage()" , this.tps);
		}
	},
	
	/* ENVOIE DU MESSAGE */
	sendMessage:function(){
		// verification message pas vide
		if(this.esaisie.value != ''){
			// fabrication du message envoyé au serveur
			var str= this.interloc +"\n"+  ((this.interloc=='')?'':"prive\t") + this.genre +"\n"+this.esaisie.value;
			// envoie message
			this.loadMessage(str);	
			// efface le input de saise
			this.esaisie.value = '';
			this.esaisie.focus();
		}
		return false;
	},
	
	refreshMessage:function(){
		this.loadMessage('');
		return false;
	},
	
	loadMessage:function(msg){
		// stop le timout
		clearTimeout(this.timeout);
		// fabrication du HttpRequest
		this.ajax = (window.ActiveXObject)? new ActiveXObject('Microsoft.XMLHTTP') : (window.XMLHttpRequest) ? new XMLHttpRequest() : false;
		this.ajax.open('post', this.url, true);
		this.ajax.onreadystatechange = this.onChangeEtat.bind(this);
// pour version PHP <= 4.2.0 commenter la ligne ci-dessous
		this.ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		if (this.ajax.overrideMimeType) { this.ajax.setRequestHeader('Connection', 'close'); }
		// envoie message
		this.ajax.send(this.salle +"\n"+ this.lasttps +"\n"+ this.ident +"\n"+ msg);
		this.eetat.className = "etat2";
	},

	/* sortie du dialogue */
	sortir:function(){
		this.lasttps = 'deconnect';
		this.refreshMessage();
	}
	
};

