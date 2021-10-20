<?php
namespace App\Tests\Service;

use App\Service\Convertisseur;
use App\Service\Fusion;
use PHPUnit\Framework\TestCase;

class FusionTest extends TestCase{
    public function testMelangeEntrelace(){

        $file1 = "./src/miniFrGer/small-french-client.csv";

        $file2 = "./src/miniFrGer/small-german-client.csv";

        $typeMelange = "Entrelacé";



        $tab = Fusion::fusion($file1,$file2,$typeMelange);

        $this->assertEquals("France",$tab[0]["CountryFull"]);
        $this->assertEquals("Germany",$tab[1]["CountryFull"]);
    }

    public function testMelangeSequentiel(){

        $file1 = "./src/miniFrGer/small-french-client.csv";

        $file2 = "./src/miniFrGer/small-german-client.csv";

        $typeMelange = "Séquentiel";

        $tab = Fusion::fusion($file1,$file2,$typeMelange);

        $this->assertEquals("France",$tab[0]["CountryFull"]);
        $this->assertEquals("France",$tab[1]["CountryFull"]);
    }
}
?>