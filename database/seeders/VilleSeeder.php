<?php

namespace Database\Seeders;

use App\Models\Ville;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('villes')->truncate();
        $villes =

            [
                [
                    "nomVille" => "Casablanca",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "El Kelaa des Srarhna",
                    "regionVille" => "Marrakech-Safi"

                ],
                [
                    "nomVille" => "Fès",
                    "regionVille" => "Fès-Meknès"

                ],
                [
                    "nomVille" => "Tangier",
                    "regionVille" => "Tanger-Tétouan-Al Hoceïma"

                ],
                [
                    "nomVille" => "Marrakech",
                    "regionVille" => "Marrakech-Safi"

                ],
                [
                    "nomVille" => "Sale",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Rabat",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Meknès",
                    "regionVille" => "Fès-Meknès"

                ],
                [
                    "nomVille" => "Kenitra",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Agadir",
                    "regionVille" => "Souss-Massa"

                ],
                [
                    "nomVille" => "Oujda-Angad",
                    "regionVille" => "Oriental"

                ],
                [
                    "nomVille" => "Tétouan",
                    "regionVille" => "Tanger-Tétouan-Al Hoceïma"

                ],
                [
                    "nomVille" => "Taourirt",
                    "regionVille" => "Oriental"

                ],
                [
                    "nomVille" => "Temara",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Safi",
                    "regionVille" => "Marrakech-Safi"

                ],
                [
                    "nomVille" => "Laâyoune",
                    "regionVille" => "Dakhla-Oued Ed Dahab"

                ],
                [
                    "nomVille" => "Mohammedia",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Kouribga",
                    "regionVille" => "Béni Mellal-Khénifra"

                ],
                [
                    "nomVille" => "Béni Mellal",
                    "regionVille" => "Béni Mellal-Khénifra"

                ],
                [
                    "nomVille" => "El Jadid",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Ait Melloul",
                    "regionVille" => "Souss-Massa"

                ],
                [
                    "nomVille" => "Nador",
                    "regionVille" => "Oriental"

                ],
                [
                    "nomVille" => "Taza",
                    "regionVille" => "Fès-Meknès"

                ],
                [
                    "nomVille" => "Settat",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Barrechid",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Al Khmissat",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Inezgane",
                    "regionVille" => "Souss-Massa"

                ],
                [
                    "nomVille" => "Ksar El Kebir",
                    "regionVille" => "Tanger-Tétouan-Al Hoceïma"

                ],
                [
                    "nomVille" => "Larache",
                    "regionVille" => "Tanger-Tétouan-Al Hoceïma"

                ],
                [
                    "nomVille" => "Guelmim",
                    "regionVille" => "Guelmim-Oued Noun"

                ],
                [
                    "nomVille" => "Khénifra",
                    "regionVille" => "Béni Mellal-Khénifra"

                ],
                [
                    "nomVille" => "Berkane",
                    "regionVille" => "Oriental"

                ],
                [
                    "nomVille" => "Bouskoura",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Al Fqih Ben Çalah",
                    "regionVille" => "Béni Mellal-Khénifra"

                ],
                [
                    "nomVille" => "Oued Zem",
                    "regionVille" => "Béni Mellal-Khénifra"

                ],
                [
                    "nomVille" => "Sidi Slimane",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Errachidia",
                    "regionVille" => "Drâa-Tafilalet"

                ],
                [
                    "nomVille" => "Guercif",
                    "regionVille" => "Oriental"

                ],
                [
                    "nomVille" => "Oulad Teïma",
                    "regionVille" => "Souss-Massa"

                ],
                [
                    "nomVille" => "Ad Dakhla",
                    "regionVille" => "Dakhla-Oued Ed Dahab"

                ],
                [
                    "nomVille" => "Ben Guerir",
                    "regionVille" => "Marrakech-Safi"

                ],
                [
                    "nomVille" => "Wislane",
                    "regionVille" => "Souss-Massa"

                ],
                [
                    "nomVille" => "Tiflet",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Lqoliaa",
                    "regionVille" => "Souss-Massa"

                ],
                [
                    "nomVille" => "Taroudant",
                    "regionVille" => "Souss-Massa"

                ],
                [
                    "nomVille" => "Sefrou",
                    "regionVille" => "Fès-Meknès"

                ],
                [
                    "nomVille" => "Essaouira",
                    "regionVille" => "Marrakech-Safi"

                ],
                [
                    "nomVille" => "Fnidq",
                    "regionVille" => "Tanger-Tétouan-Al Hoceïma"

                ],
                [
                    "nomVille" => "Ait Ali",
                    "regionVille" => "Souss-Massa"

                ],
                [
                    "nomVille" => "Sidi Qacem",
                    "regionVille" => "Rabat-Salé-Kénitra"


                ],
                [
                    "nomVille" => "Tiznit",
                    "regionVille" => "Souss-Massa"

                ],
                [
                    "nomVille" => "Moulay Abdallah",
                    "regionVille" => "Casablanca-Settat"


                ],
                [
                    "nomVille" => "Tan-Tan",
                    "regionVille" => "Guelmim-Oued Noun"


                ],
                [
                    "nomVille" => "Warzat",
                    "regionVille" => "Drâa-Tafilalet"


                ],
                [
                    "nomVille" => "Youssoufia",
                    "regionVille" => "Marrakech-Safi"


                ],
                [
                    "nomVille" => "Sa’ada",
                    "regionVille" => "Marrakech-Safi"

                ],
                [
                    "nomVille" => "Martil",
                    "regionVille" => "Tanger-Tétouan-Al Hoceïma"

                ],
                [
                    "nomVille" => "Aïn Harrouda",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Skhirate",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Ouezzane",
                    "regionVille" => "Tanger-Tétouan-Al Hoceïma"

                ],
                [
                    "nomVille" => "Sidi Yahya Zaer",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Benslimane",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Al Hoceïma",
                    "regionVille" => "Tanger-Tétouan-Al Hoceïma"

                ],
                [
                    "nomVille" => "Beni Enzar",
                    "regionVille" => "Oriental"

                ],
                [
                    "nomVille" => "M’diq",
                    "regionVille" => "Tanger-Tétouan-Al Hoceïma"

                ],
                [
                    "nomVille" => "Sidi Bennour",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Midalt",
                    "regionVille" => "Drâa-Tafilalet"

                ],
                [
                    "nomVille" => "Azrou",
                    "regionVille" => "Fès-Meknès"

                ],
                [
                    "nomVille" => "Ain El Aouda",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Beni Yakhlef",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Semara",
                    "regionVille" => "Dakhla-Oued Ed Dahab"

                ],
                [
                    "nomVille" => "Ad Darwa",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Al Aaroui",
                    "regionVille" => "Oriental"

                ],
                [
                    "nomVille" => "Qasbat Tadla",
                    "regionVille" => "Béni Mellal-Khénifra"

                ],
                [
                    "nomVille" => "Boujad",
                    "regionVille" => "Béni Mellal-Khénifra"

                ],
                [
                    "nomVille" => "Jerada",
                    "regionVille" => "Oriental"

                ],
                [
                    "nomVille" => "Chefchaouene",
                    "regionVille" => "Tanger-Tétouan-Al Hoceïma"

                ],
                [
                    "nomVille" => "Mrirt",
                    "regionVille" => "Béni Mellal-Khénifra"

                ],
                [
                    "nomVille" => "Sidi Mohamed Lahmar",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Tineghir",
                    "regionVille" => "Drâa-Tafilalet"

                ],
                [
                    "nomVille" => "El Aïoun",
                    "regionVille" => "Oriental"

                ],
                [
                    "nomVille" => "Azemmour",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Temsia",
                    "regionVille" => "Souss-Massa"

                ],
                [
                    "nomVille" => "Zoumi",
                    "regionVille" => "Tanger-Tétouan-Al Hoceïma"

                ],
                [
                    "nomVille" => "Laouamra",
                    "regionVille" => "Tanger-Tétouan-Al Hoceïma"

                ],
                [
                    "nomVille" => "Zagora",
                    "regionVille" => "Drâa-Tafilalet"

                ],
                [
                    "nomVille" => "Ait Ourir",
                    "regionVille" => "Marrakech-Safi"

                ],
                [
                    "nomVille" => "Sidi Bibi",
                    "regionVille" => "Souss-Massa"

                ],
                [
                    "nomVille" => "Aziylal",
                    "regionVille" => "Béni Mellal-Khénifra"

                ],
                [
                    "nomVille" => "Sidi Yahia El Gharb",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Biougra",
                    "regionVille" => "Souss-Massa"

                ],
                [
                    "nomVille" => "Taounate",
                    "regionVille" => "Fès-Meknès"

                ],
                [
                    "nomVille" => "Bouznika",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Aourir",
                    "regionVille" => "Souss-Massa"

                ],
                [
                    "nomVille" => "Zaïo",
                    "regionVille" => "Oriental"

                ],
                [
                    "nomVille" => "Aguelmous",
                    "regionVille" => "Béni Mellal-Khénifra"

                ],
                [
                    "nomVille" => "El Hajeb",
                    "regionVille" => "Fès-Meknès"

                ],
                [
                    "nomVille" => "Mnasra",
                    "regionVille" => "Tanger-Tétouan-Al Hoceïma"

                ],
                [
                    "nomVille" => "Mediouna",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Zeghanghane",
                    "regionVille" => "Oriental"

                ],
                [
                    "nomVille" => "Imzouren",
                    "regionVille" => "Tanger-Tétouan-Al Hoceïma"

                ],
                [
                    "nomVille" => "Loudaya",
                    "regionVille" => "Marrakech-Safi"

                ],
                [
                    "nomVille" => "Oulad Zemam",
                    "regionVille" => "Béni Mellal-Khénifra"

                ],
                [
                    "nomVille" => "Bou Ahmed",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Tit Mellil",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Arbaoua",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Douar Oulad Hssine",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Bahharet Oulad Ayyad",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Mechraa Bel Ksiri",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Mograne",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Dar Ould Zidouh",
                    "regionVille" => "Béni Mellal-Khénifra"

                ],
                [
                    "nomVille" => "Asilah",
                    "regionVille" => "Tanger-Tétouan-Al Hoceïma"

                ],
                [
                    "nomVille" => "Demnat",
                    "regionVille" => "Béni Mellal-Khénifra"

                ],
                [
                    "nomVille" => "Lalla Mimouna",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Fritissa",
                    "regionVille" => "Fès-Meknès"

                ],
                [
                    "nomVille" => "Arfoud",
                    "regionVille" => "Drâa-Tafilalet"

                ],
                [
                    "nomVille" => "Tameslouht",
                    "regionVille" => "Marrakech-Safi"

                ],
                [
                    "nomVille" => "Bou Arfa",
                    "regionVille" => "Oriental"

                ],
                [
                    "nomVille" => "Sidi Smai’il",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Taza",
                    "regionVille" => "Tanger-Tétouan-Al Hoceïma"

                ],
                [
                    "nomVille" => "Souk et Tnine Jorf el Mellah",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Mehdya",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Oulad Hammou",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Douar Oulad Aj-jabri",
                    "regionVille" => "Béni Mellal-Khénifra"

                ],
                [
                    "nomVille" => "Aïn Taoujdat",
                    "regionVille" => "Fès-Meknès"

                ],
                [
                    "nomVille" => "Dar Bel Hamri",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Chichaoua",
                    "regionVille" => "Marrakech-Safi"

                ],
                [
                    "nomVille" => "Tahla",
                    "regionVille" => "Fès-Meknès"

                ],
                [
                    "nomVille" => "Bellaa",
                    "regionVille" => "Souss-Massa"

                ],
                [
                    "nomVille" => "Oulad Yaïch",
                    "regionVille" => "Béni Mellal-Khénifra"

                ],
                [
                    "nomVille" => "Ksebia",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Tamorot",
                    "regionVille" => "Tanger-Tétouan-Al Hoceïma"

                ],
                [
                    "nomVille" => "Moulay Bousselham",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Sabaa Aiyoun",
                    "regionVille" => "Fès-Meknès"

                ],
                [
                    "nomVille" => "Bourdoud",
                    "regionVille" => "Fès-Meknès"

                ],
                [
                    "nomVille" => "Aït Faska",
                    "regionVille" => "Marrakech-Safi"

                ],
                [
                    "nomVille" => "Boureït",
                    "regionVille" => "Tanger-Tétouan-Al Hoceïma"

                ],
                [
                    "nomVille" => "Lamzoudia",
                    "regionVille" => "Marrakech-Safi"

                ],
                [
                    "nomVille" => "Oulad Said",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Missour",
                    "regionVille" => "Fès-Meknès"

                ],
                [
                    "nomVille" => "Ain Aicha",
                    "regionVille" => "Fès-Meknès"

                ],
                [
                    "nomVille" => "Zawyat ech Cheïkh",
                    "regionVille" => "Béni Mellal-Khénifra"

                ],
                [
                    "nomVille" => "Bouknadel",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "El Ghiate",
                    "regionVille" => "Marrakech-Safi"

                ],
                [
                    "nomVille" => "Safsaf",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Ouaoula",
                    "regionVille" => "Béni Mellal-Khénifra"

                ],
                [
                    "nomVille" => "Douar Olad. Salem",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Oulad Tayeb",
                    "regionVille" => "Fès-Meknès"

                ],
                [
                    "nomVille" => "Echemmaia Est",
                    "regionVille" => "Marrakech-Safi"

                ],
                [
                    "nomVille" => "Oulad Barhil",
                    "regionVille" => "Souss-Massa"

                ],
                [
                    "nomVille" => "Douar ’Ayn Dfali",
                    "regionVille" => "Fès-Meknès"

                ],
                [
                    "nomVille" => "Setti Fatma",
                    "regionVille" => "Marrakech-Safi"

                ],
                [
                    "nomVille" => "Skoura",
                    "regionVille" => "Drâa-Tafilalet"

                ],
                [
                    "nomVille" => "Douar Ouled Ayad",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Zawyat an Nwaçer",
                    "regionVille" => "Casablanca-Settat"

                ],
                [
                    "nomVille" => "Khenichet-sur Ouerrha",
                    "regionVille" => "Rabat-Salé-Kénitra"

                ],
                [
                    "nomVille" => "Ayt Mohamed",
                    "regionVille" => "Béni Mellal-Khénifra"

                ],
                [
                    "nomVille" => "Gueznaia",
                    "regionVille" => "Tanger-Tétouan-Al Hoceïma"

                ],
                [
                    "nomVille" => "Oulad Hassoune",
                    "regionVille" => "Marrakech-Safi"

                ],
                [
                    "nomVille" => "Bni Frassen",
                    "regionVille" => "Fès-Meknès"

                ],
                [
                    "nomVille" => "Tifariti",
                    "regionVille" => "Dakhla-Oued Ed Dahab."
                ],
                [
                    "nomVille" => "Zawit Al Bour",
                    "regionVille" => "Souss-Massa"
                ]
            ];

        Ville::insert($villes);
    }
}
