**Shopaholics team:**

George Athanasiadis, 
Neofytos Apostolidis, 
Marios Meladianos, 
Periklis Voutsas


***
Για τη λειτουργία των διαδικασιών αποστολής και λήψης e-mail απαιτείται να συμπεριληφθεί το repository PHPMailer. (https://github.com/PHPMailer/PHPMailer.git )
Στον τοπικό φάκελο του server που τρέχει την εφαρμογή, προσθέτουμε το φάκελο phpmailer στη διαδρομή mailer/vendor.
***

Στο αρχείο send-password-reset.php, στο σύνδεσμο 

http://localhost/shopaholics/mailer/reset-password.php?token=$token 
	
απαιτείται να αντικατασταθεί το localhost/shopaholics με το εκάστοτε domain name, γιατί αυτό αποτελεί το absolute path του link που αποστέλλεται στο χρήστη μέσω e-mail για την επαναφορά του κωδικού του.

***
Η εφαρμογή είναι διαθέσιμη στις παρακάτω διευθύνσεις:

https://smarthome.primehost.ai/shopaholics
https://users.iee.ihu.gr/~meladmar
http://shopaholics24.northeurope.cloudapp.azure.com


