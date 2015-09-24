##############################################################################
#    Copyright (c) 2002-2003 by Dominique Laporte (C-E-D@wanadoo.fr)         #
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
# création de la dba des smileys
###############################################################################
insert into smileys values('', 'H', 'note',      '[!]');
insert into smileys values('', 'H', 'oui',       '[yes]');
insert into smileys values('', 'H', 'non',       '[no]');
insert into smileys values('', 'H', 'attention', '[!!]');
insert into smileys values('', 'H', 'question',  '[?:(]');
insert into smileys values('', 'H', 'idee',      '[!:)]');
insert into smileys values('', 'H', 'sourire',   '[:)]');
insert into smileys values('', 'H', 'surpris',   '[:o]');
insert into smileys values('', 'H', 'mecontent', '[:((]');
insert into smileys values('', 'T', 'mefiance',  '[>:]');
insert into smileys values('', 'T', 'censure',   '[:X]');
insert into smileys values('', 'T', 'hum',       '[>:(]');
insert into smileys values('', 'T', 'humpf',     '[<:((]');
insert into smileys values('', 'T', 'heureux',   '[:))]');
insert into smileys values('', 'T', 'help',      '[:||]');
insert into smileys values('', 'T', 'clindoeil', '[;)]');
insert into smileys values('', 'T', 'bye',       '[;>>]');
insert into smileys values('', 'T', 'bravo',     '[;>]');
insert into smileys values('', 'T', 'mad',       '[:(]');
insert into smileys values('', 'T', 'avocat',    '[cit]');
insert into smileys values('', 'T', 'langue',    '[:P]');
insert into smileys values('', 'T', 'bof',       '[:/]');
insert into smileys values('', 'T', 'soleil',    '[8))]');
insert into smileys values('', 'T', 'rigole',    '[:D]');
insert into smileys values('', 'T', 'pinte',     '[glou]');
insert into smileys values('', 'T', 'pleure',    '[cry]');
insert into smileys values('', 'T', 'raf',       '[raf]');
###############################################################################