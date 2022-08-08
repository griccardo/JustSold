<div class="mb-6">
    <h1 class="text-2xl font-bold mb-4 "><?=count($annunci)?> annunci inerenti alla tua ricerca</h1>
    
    <div class="w-full grid grid-cols-1 gap-4">
        <!-- <a href="/" class="">
            <img src="https://img.clasf.it/2020/05/10/Apple-iPhone-11-128-gb-rosso-usato-20200510105059.8139650015.jpg" alt="img" class="w-full h-44 object-cover mb-3 rounded-xl">
            <h1 class="text-xl font-semibold mx-1">Titolo</h1>
            <h2 class="text-md font-semibold mt-0 mx-1 text-gray-400 ">Mira, Venezia, Veneto</h2>
            <h1 class="text-xl font-semibold mt-0 mb-1 mx-1 text-black">50.00 €</h1>
        </a> -->
        <?php
        if($preferiti != null) $checkpref = array_flip(array_column($preferiti, "annuncio_id"));
        
            foreach ($annunci as $key => $annuncio) {
               
                $annuncio['prefe'] = isset($checkpref[$annuncio['annuncio_id']]);
                
                echo view('advertisement/cardlarge', $annuncio);
            }
        ?>
    </div>
</div>