<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class APIController extends AbstractController
{
    /**
     * @Route("/api/IMC/", name="api_IMC" ,methods={"POST"})
     */
    public function index(Request $request): Response
    {
        $json =$request->getContent();
        // transformer en objet PHP
        $obj = json_decode($json);

        $IMC = $obj->poids / ($obj->taille * $obj->taille);
        $analyse = "";

        if($IMC < 18.5){
            $analyse = "maigre";
        }else if($IMC > 18.5 && $IMC < 25){
            $analyse = "normal";
        }else if($IMC > 25){
            $analyse = "en surpoids";
        }

        $tab["message"]= "Votre IMC est de " . $IMC . " Vous etes " . $analyse;

        return $this->json($tab);
    }

    
}
