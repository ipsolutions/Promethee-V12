<?php
/*
 *		module   : quizz.php
 *		projet   : définition des mnémoniques des messages
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 26/03/2007
 *		modif    : 
 *
 */

//---------------------------------------------------------------------------
static	$QUIZZ_NBRECQUESTION        = 0;
static	$QUIZZ_NEXT                 = 1;
static	$QUIZZ_PREV                 = 2;
static	$QUIZZ_QUESTION             = 3;
static	$QUIZZ_MANDATORY            = 4;
static	$QUIZZ_ANSWER               = 5;
static	$QUIZZ_TYPE                 = 6;
static	$QUIZZ_USER                 = 7;
static	$QUIZZ_DELIMAGE             = 8;
static	$QUIZZ_SELECTIMAGE          = 9;
static	$QUIZZ_MYANSWER             = 10;
static	$QUIZZ_GETANSWER            = 11;
static	$QUIZZ_POINTS               = 12;
static	$QUIZZ_MORECHOICE           = 13;
static	$QUIZZ_UPDATEQUESTION       = 14;
static	$QUIZZ_RECORD               = 15;
static	$QUIZZ_BACK                 = 16;
static	$QUIZZ_FINISH               = 17;
static	$QUIZZ_GOBACK               = 18;
static	$QUIZZ_GO2RESULT            = 19;
static	$QUIZZ_NBQUESTION           = 20;
static	$QUIZZ_TOTAL                = 21;
static	$QUIZZ_COMMENT              = 22;
static	$QUIZZ_NEXT                 = 23;
static	$QUIZZ_TERMINATED           = 24;
static	$QUIZZ_PREV                 = 25;
static	$QUIZZ_EXERCICE             = 26;
static	$QUIZZ_CLOSED               = 27;
static	$QUIZZ_MANAGEMENT           = 28;
static	$QUIZZ_CREATEQUIZZ          = 29;
static	$QUIZZ_UPDATEQUIZZ          = 30;
static	$QUIZZ_ERRQUESTION          = 31;
static	$QUIZZ_ERRANSWER            = 32;
static	$QUIZZ_BADFORMAT            = 33;
static	$QUIZZ_MODOF                = 34;
static	$QUIZZ_MODOM                = 35;
static	$QUIZZ_NOMODO               = 36;
static	$QUIZZ_EXERCICERESULT       = 37;
static	$QUIZZ_PICTO                = 38;
static	$QUIZZ_SHOWPOINTS           = 39;
static	$QUIZZ_CREATEBY             = 40;
static	$QUIZZ_NEXTPREV             = 41;
static	$QUIZZ_TOTALPTS             = 42;
static	$QUIZZ_RATIO                = 43;
static	$QUIZZ_MIN                  = 44;
static	$QUIZZ_MAX                  = 45;
static	$QUIZZ_AVERAGE              = 46;
static	$QUIZZ_ECTYPE               = 47;
static	$QUIZZ_ONLINE               = 48;
static	$QUIZZ_UPDEXERCICE          = 49;
static	$QUIZZ_NEWEXERCICE          = 50;
static	$QUIZZ_DOWNLOAD             = 51;
static	$QUIZZ_MODIFICATION         = 52;
static	$QUIZZ_MATTER               = 53;
static	$QUIZZ_STATUS               = 54;
static	$QUIZZ_AUTHOR               = 55;
static	$QUIZZ_WARNING              = 56;
static	$QUIZZ_IDENT                = 57;
static	$QUIZZ_DESCRIPTION          = 58;
static	$QUIZZ_PERM                 = 59;
static	$QUIZZ_PERSONNAL            = 60;
static	$QUIZZ_SHOWRESULT           = 61;
static	$QUIZZ_FRONTBACK            = 62;
static	$QUIZZ_LEVEL                = 63;
static	$QUIZZ_EASY                 = 64;
static	$QUIZZ_MEAN                 = 65;
static	$QUIZZ_HARD                 = 66;
static	$QUIZZ_SHARE                = 67;
static	$QUIZZ_LIST                 = 68;
static	$QUIZZ_DATABANK             = 69;
static	$QUIZZ_CHOOSEMATTER         = 70;
static	$QUIZZ_CHOOSECLASS          = 71;
static	$QUIZZ_ALLCLASS             = 72;
static	$QUIZZ_ADDEXERCICE          = 73;
static	$QUIZZ_TITLE                = 74;
static	$QUIZZ_DATE                 = 75;
static	$QUIZZ_HIT                  = 76;
static	$QUIZZ_QUESTIONLABEL        = 77;
static	$QUIZZ_LEVELLABEL           = 78;
static	$QUIZZ_CLOSEXO              = 79;
static	$QUIZZ_OPENEXO              = 80;
static	$QUIZZ_ADDQUESTION          = 81;
static	$QUIZZ_RESET                = 82;
static	$QUIZZ_DELETE               = 83;
static	$QUIZZ_UPDATEXO             = 84;
static	$QUIZZ_ALLMATTER            = 85;
static	$QUIZZ_BY                   = 86;
static	$QUIZZ_HASENDED             = 87;
static	$QUIZZ_RUNNING              = 88;
static	$QUIZZ_NOTBEGUN             = 89;
static	$QUIZZ_UPDTEXERCICE         = 90;
static	$QUIZZ_DELTEST              = 91;
static	$QUIZZ_HELP                 = 92;
static	$QUIZZ_RANDOM               = 93;
static	$QUIZZ_MANDATORINPUT        = 94;
static	$QUIZZ_ERRMANDATORY         = 95;
static	$QUIZZ_OR                   = 96;
static	$QUIZZ_PERMALINK            = 97;
static	$QUIZZ_DELQUESTION          = 98;
static	$QUIZZ_PAGE                 = 99;
static	$QUIZZ_DELAY                = 100;
static	$QUIZZ_PREFERENCES          = 101;
static	$QUIZZ_NUMBER               = 102;
static	$QUIZZ_NEWDIR               = 103;
static	$QUIZZ_ROOTDIR              = 104;
static	$QUIZZ_DIR                  = 105;
static	$QUIZZ_MODO                 = 106;
static	$QUIZZ_NONE                 = 107;
static	$QUIZZ_PRIVATE              = 108;
static	$QUIZZ_CLOSEDIR             = 109;
static	$QUIZZ_WRITER               = 110;
static	$QUIZZ_READER               = 111;
static	$QUIZZ_DECLARE              = 112;
static	$QUIZZ_CREAT                = 113;
static	$QUIZZ_DIRMANAGEMENT        = 114;
static	$QUIZZ_UPDATING             = 115;
static	$QUIZZ_CLOSING              = 116;
static	$QUIZZ_OPENING              = 117;
static	$QUIZZ_INSERTION            = 118;
static	$QUIZZ_ADD                  = 119;
static	$QUIZZ_IMPORT               = 120;
static	$QUIZZ_CONFIRM              = 121;
static	$QUIZZ_LIMIT                = 122;
static	$QUIZZ_INPUTNEW             = 123;
static	$QUIZZ_INPUTREPLY           = 124;
static	$QUIZZ_INPUTOK              = 125;
static	$QUIZZ_INPUTCANCEL          = 126;
//---------------------------------------------------------------------------
?>
