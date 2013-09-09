<?php
session_start();

/* Caractères possibles du Captcha */
$caracteres_aleatoire = str_shuffle('123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');

/* On génère le code du captcha */
$_SESSION['captcha'] = substr($caracteres_aleatoire, 0, 6);

/* On créer l'image */ 
header ("Content-type: image/png");

/* On définit sa taille */
$image = imagecreate(315,40);

/* On attribut une police au code et aux lettres du fond */
putenv('GDFONTPATH=' . realpath('.'));
$police = 'arialbd';
$police_fond = 'arial';
 
/* On définie la couleur du fond aléatoirement mais pas trop claire non plus */
$couleur_fond = imagecolorallocate($image, mt_rand(0, 155), mt_rand(0, 155), mt_rand(0, 155));
$blanc = imagecolorallocate($image, 255, 255, 255);
$noir = imagecolorallocate($image, 0, 0, 0);
 
/* Liste des caractères du fond possible */
$lettres_aleatoire = str_shuffle('123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');

$couleur_lettre = array(imagecolorallocate($image, 130, 60, 0),
						imagecolorallocate($image, 228, 128, 19),
						imagecolorallocate($image, 200, 200, 200),
						imagecolorallocate($image, 0, 255, 0),
						imagecolorallocate($image, 255, 0, 0),
						imagecolorallocate($image, 0, 0, 255),
						imagecolorallocate($image, 62, 126, 37),
						imagecolorallocate($image, 81, 243, 69),
						imagecolorallocate($image, 28, 35, 7),
						imagecolorallocate($image, 252, 139, 189),
						imagecolorallocate($image, 98, 120, 242),
						imagecolorallocate($image, 181, 61, 15),
						imagecolorallocate($image, 224, 135, 83),
						imagecolorallocate($image, 136, 198, 174),
						imagecolorallocate($image, 255, 0, 255),
						imagecolorallocate($image, 255, 255, 0),
						imagecolorallocate($image, 5, 16, 242),
						imagecolorallocate($image, 0, 0, 0),
						imagecolorallocate($image, 150, 150, 150));
							
/* On génère 35 lettres sur le fond */
for ($lettres = 0 ; $lettres < 35 ; $lettres++)
{
	/* On prend une couleur aléatoire différente du blanc */
	/* On autorise un angle quelconque et on affiche le caractère */
	imagettftext($image, 15, mt_rand(0, 180), mt_rand(0, 315), mt_rand(0, 40), $couleur_lettre[array_rand($couleur_lettre)], $police_fond, $lettres_aleatoire{$lettres});
}
 
/* On affiche une bordure noire */
ImageRectangle ($image, 0, 0, 314, 39, $noir);
 
/* On peut afficher les 6 caracètes du code de sécurité */
for ($caracteres = 0 ; $caracteres <= 5 ; $caracteres++)
{
	$caractere = $caracteres_aleatoire{$caracteres};
	
	/* On lui donne un angle faible */
	$rotation = mt_rand(-45,45);
	$nouvelle_position_x = 12 + ($caracteres * 50);
	$nouvelle_position_y = mt_rand(20, 30);
	
	/* On affiche l'ombre du caractère */
	imagettftext($image, 20, $rotation, $nouvelle_position_x - 2, $nouvelle_position_y - 2, $noir, $police, $caractere);
	
	/* On affiche le caractère */
	imagettftext($image, 20, $rotation, $nouvelle_position_x, $nouvelle_position_y, $blanc, $police, $caractere);
}
 
/* On génère définitivement l'image */
imagepng($image);
?>