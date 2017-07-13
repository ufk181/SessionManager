# Php Basic Level Session Class Manager

Bu Sınıf ile basit seviyede session oluşturma,yoketme ve benzeri işlemleri yapabilirsiniz. 


# Usage 
-------------------------------------------------------------

# Oluşturma

$Session = SessionManager::Instance();

# Session İsmi belirtme ve hazırlama 

$Session->CreateSession('Session_Name');

//Arrays 
$Session->CreateSession('Session_Name',true);

# Session Data Push

$Session->setSession('Session_Name','Deneme');

//Arrays
$Session->SetSession('Session_Name',['Oturum' => 'On','User' => 'ufk181']);


#Session Destroy 

$Session->SessionKiller('Session_Name');



Not : Sınıfın bazı bölgeleri hala bitmemiştir. Zamanla Commitlenecektir. Ya da alıp kendiniz de geliştirip "Pull Request" Yapabilirsiniz. 


İletişim : codercrasher1@gmail.com


