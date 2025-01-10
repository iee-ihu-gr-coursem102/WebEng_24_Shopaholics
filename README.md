**Shopaholics team:**

George Athanasiadis, 
Neofytos Apostolidis, 
Marios Meladianos, 
Periklis Voutsas


***
Για τη λειτουργία των διαδικασιών αποστολής και λήψης e-mail απαιτείται να συμπεριληφθεί το repository PHPMailer. (https://github.com/PHPMailer/PHPMailer.git )
Στον τοπικό φάκελο του server που τρέχει την εφαρμογή, προσθέτουμε το φάκελο phpmailer στη διαδρομή mailer/vendor.
***

Στο αρχείο send-password-reset.php, στο σημείο 

'Click <a href="http://localhost/shopaholics/mailer/reset-password.php?token=$token">here</a> 
    to reset your password.' 
	
απαιτείται να αντικατασταθεί το localhost/shopaholics με το εκάστοτε domain name, γιατί αυτό αποτελεί το absolute path του link που αποστέλλεται στο χρήστη μέσω e-mail για την επαναφορά του κωδικού του.
