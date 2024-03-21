<?php

class Pays
{
    private int $codePays;
    private int $nbhabitant;

    
    /*
    // Constructeur 
    public function __construct ( $cdP , $nbH )
     {
           $this -> codePays = (int)$cdP;
           $this -> nbhabitant = (int)$nbH;
    }
    */


public function hydrate(array $donnees)
{
  foreach ($donnees as $key => $value)
  {
    // On récupère le nom du setter correspondant à l'attribut.
    $method = 'set'.ucfirst($key);
        
    // Si le setter correspondant existe.
    if (method_exists($this, $method))
    {
      // On appelle le setter.
      $this->$method($value);
    }
  }
}

     // Setters
    public function setCodePays($code)
    {
        $this -> codePays = (int)$code;
    }

    public function setNbhabitant($nb)
    {
        $this -> nbhabitant = (int)$nb;
    }

     // Getters
    public function getCodePays()
    {
        return $this -> codePays;
    }

    public function getNbhabitant()
    {
        return $this -> nbhabitant;
    }

     // 
}

class Moment
{
    private int $jour;

    /*
     // Constructeur 
    public function __construct ( $j )
    {
           $this -> jour = (int)$j;
    }
    */

public function hydrate(array $donnees)
{
  foreach ($donnees as $key => $value)
  {
    // On récupère le nom du setter correspondant à l'attribut.
    $method = 'set'.ucfirst($key);
        
    // Si le setter correspondant existe.
    if (method_exists($this, $method))
    {
      // On appelle le setter.
      $this->$method($value);
    }
  }
}

     // Setters
    public function setJour($_jour)
    {
        $this -> jour = (int)$_jour;
    } 

     // Getters
    public function getJour()
    {
        return $this -> jour;
    }
}

class Musee 
{
    private int $numMus;
    private string $nomMus;
    private int $nblivres;
    private int $codePays;


     // Constructeur 
    /*public function __construct ( $numM , $nomM , $nbL , $cdP )
    {
          $this -> numMus = (int)$numM;
          $this -> nomMus = $nomM;
          $this -> nblivres = (int)$nbL;
          $this -> codePays = (int)$cdP;
    }*/

public function hydrate(array $donnees)
{
  foreach ($donnees as $key => $value)
  {
    // On récupère le nom du setter correspondant à l'attribut.
    $method = 'set'.ucfirst($key);
        
    // Si le setter correspondant existe.
    if (method_exists($this, $method))
    {
      // On appelle le setter.
      $this->$method($value);
    }
  }
}


     // Setters
    public function setNumMus($num)
    {
        $this -> numMus= $num;
    }

    public function setNomMus($nom)
    {
        $this -> nomMus= $nom;
    }

    public function setNblivres($nbL)
    {
        $this -> nblivres= $nbL;
    }

    public function setCodePays($code)
    {
        $this -> codePays= $code;
    }

     // Getters
     public function getNumMus()
     {
         return $this -> numMus;
     }

     public function getNomMus()
     {
         return $this -> nomMus;
     }

     public function getNblivres()
     {
         return $this -> nblivres;
     }

     public function getCodePays()
     {
         return $this -> codePays;
     }
}


class Visiter
{
  private int $numMus;
  private int $jour;
  private int $nbvisiteurs;

public function hydrate(array $donnees)
  { 
    foreach ($donnees as $key => $value)
    {
      // On récupère le nom du setter correspondant à l'attribut.
      $method = 'set'.ucfirst($key);
          
      // Si le setter correspondant existe.
      if (method_exists($this, $method))
      {
        // On appelle le setter.
        $this->$method($value);
      }
    }
  }

  public function setNumMus($nm)
  {
    global $numMus;
    $this -> $numMus = (int)$nm;
  }
  public function setJour($jr)
  {
    global $jour;
    $this -> $jour = (int)$jr;
  }
  public function setNbvisiteurs($nv)
  {
    global $nbvisiteurs;
    $this ->$nbvisiteurs = (int)$nv;
  }

  public function getNumMus()
  {
      return $this -> numMus;
  }
  public function getJour()
  {
    return $this -> jour;
  }
  public function getNbvisiteurs()
  {
    return $this -> nbvisiteurs;
  }
}

class Ouvrage
{
    private int $ISBN;
    private int $nbPage;
    private string $titre;
    private int $codePays;

/*
     // Constructeur 
    public function __construct ( $i , $nP , $t , $cP )
    {
          $this -> ISBN = (int)$i;
          $this -> nbPage = (int)$nP;
          $this -> titre = $t;
          $this -> codePays = (int)$cP;
    }
*/

public function hydrate(array $donnees)
{
  foreach ($donnees as $key => $value)
  {
    // On récupère le nom du setter correspondant à l'attribut.
    $method = 'set'.ucfirst($key);
        
    // Si le setter correspondant existe.
    if (method_exists($this, $method))
    {
      // On appelle le setter.
      $this->$method($value);
    }
  }
}

     // Setters
    public function setISBN($a)
    {
        $this -> ISBN = (int)$a;
    }

    public function setNbPage($nbP)
    {
        $this -> nbPage = (int)$nbP;
    }

    public function setTitre($t)
    {
        $this -> titre = $t;
    }

    public function setCodePays($cdeP)
    {
        $this -> codePays = (int)$cdeP;
    }

     //Getters
     public function getISBN()
     {
         return $this -> ISBN;
     }

     public function getNbPage()
     {
         return $this -> nbPage;
     }

     public function getTitre()
     {
         return $this -> titre;
     }

     public function getCodePays()
     {
         return $this -> codePays;
     }
}

class Bibliothèque 
{
    private int $numMus;
    private int $ISBN;
    private string $dateAchat;

/*
     // Constructeur 
    public function __construct ( $num , $i , $dA )
    {
          $this -> numMus = $num;
          $this -> ISBN = $i;
          $this -> dateAchat = $dA;
    }
*/
public function hydrate(array $donnees)
{
  foreach ($donnees as $key => $value)
  {
    // On récupère le nom du setter correspondant à l'attribut.
    $method = 'set'.ucfirst($key);
        
    // Si le setter correspondant existe.
    if (method_exists($this, $method))
    {
      // On appelle le setter.
      $this->$method($value);
    }
  }
}

     // Setters
    public function setISBN($a)
    {
         $this -> ISBN = (int)$a;
    }

    public function setNumMus($nm)
    {
         $this -> numMus = (int)$nm;
    }

    public function setDateAchat($date)
    {
         $this -> dateAchat = $date;
    }

     // Getters
    public function getISBN()
    {
         return $this -> ISBN;
    }

    public function getNumMus()
    {
          return $this -> numMus;
    }

    public function getDateAchat()
    {
          return $this -> dateAchat;
    }
}

class Site
{
    private string $nomSite;
    private string $anneedecouv;
    private int $codePays;

/*
     // Constructeur 
    public function __construct ( $nomS , $annee , $cP )
    {
          $this -> nomSite = $nomS;
          $this -> anneedecouv = (int)$annee;
          $this -> codePays = (int)$cP;
    }
*/

public function hydrate(array $donnees)
{
  foreach ($donnees as $key => $value)
  {
    // On récupère le nom du setter correspondant à l'attribut.
    $method = 'set'.ucfirst($key);
        
    // Si le setter correspondant existe.
    if (method_exists($this, $method))
    {
      // On appelle le setter.
      $this->$method($value);
    }
  }
}

     // Setters
    public function setNomSite($nomS)
    {
         $this -> nomSite = $nomS;
    }

    public function setAnneedecouv($anneeD)
    {
         $this -> anneedecouv = $anneeD;
    }

    public function setCodePays($cdeP)
    {
        $this -> codePays = (int)$cdeP;
    }

     // Getters
    public function getNomSite()
    {
        return $this -> nomSite;
    }

    public function getAnneedecouv()
    {
        return $this -> anneedecouv;
    }

    public function getCodePays()
    {
         return $this -> codePays;
    }
}

class Referencer 
{
    private string $nomSite;
    private int $numeroPage;
    private int $ISBN;

/*
     // Constructeur 
    public function __construct ( $nomS , $n , $i )
    {
          $this -> nomSite = $nomS;
          $this -> numeroPage = (int)$n;
          $this -> ISBN = (int)$i;
    }
*/

public function hydrate(array $donnees)
{
  foreach ($donnees as $key => $value)
  {
    // On récupère le nom du setter correspondant à l'attribut.
    $method = 'set'.ucfirst($key);
        
    // Si le setter correspondant existe.
    if (method_exists($this, $method))
    {
      // On appelle le setter.
      $this->$method($value);
    }
  }
}

     // Setters
    public function setNomSite($nomS)
    {
          $this -> nomSite = $nomS;
    }

    public function setNumeroPage($numP)
    {
         $this -> numeroPage = $numP;
    }

    public function setISBN($a)
    {
         global $ISBN;
         $this -> ISBN = (int)$a;
    }

     // Getters
    public function getNomSite()
    {
         return $this -> nomSite;
    }

    public function getNumeroPage()
    {
         return $this -> numeroPage;
    }

    public function getISBN()
    {
         return $this -> ISBN;
    }
}

class Relier
{
    private string $nomSite1;
    private string $nomSite2;
    private int $distance;
/*
     // Constructeur 
    public function __construct ( $nomS1 , $nomS2 , $d )
    {
         $this -> nomSite1 = $nomS1;
         $this -> nomSite2 = $nomS2;
         $this -> distance = $d;
    }
*/

public function hydrate(array $donnees)
{
  foreach ($donnees as $key => $value)
  {
    // On récupère le nom du setter correspondant à l'attribut.
    $method = 'set'.ucfirst($key);
        
    // Si le setter correspondant existe.
    if (method_exists($this, $method))
    {
      // On appelle le setter.
      $this->$method($value);
    }
  }
}


     // Setters
    public function setNomSite1($nomSa)
    {
           $this -> nomSite1 = $nomSa;
    }

    public function setNomSite2($nomSb)
    {
          $this -> nomSite2 = $nomSb;
    }

    public function setDistance($d)
    {
          $this -> distance = (int)$d;
    }

     // Getters
    public function getNomSite1()
    {
         return $this -> nomSite1;
    }

    public function getNomSite2()
    {
         return $this -> nomSite2;
    }

    public function getDistance()
    {
         return $this -> distance;
    }
}
