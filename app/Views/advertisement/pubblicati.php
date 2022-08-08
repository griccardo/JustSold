<h1 class="text-2xl font-bold mb-4 ">Annunci pubblicati</h1>
    
<div class="grid grid-cols-2 md:grid-cols-3 2xl:grid-cols-4 gap-4">
    <!-- <a href="/" class="">
        <img src="https://img.clasf.it/2020/05/10/Apple-iPhone-11-128-gb-rosso-usato-20200510105059.8139650015.jpg" alt="img" class="w-full h-44 object-cover mb-3 rounded-xl">
        <h1 class="text-xl font-semibold mx-1">Titolo</h1>
        <h2 class="text-md font-semibold mt-0 mx-1 text-gray-400 ">Mira, Venezia, Veneto</h2>
        <h1 class="text-xl font-semibold mt-0 mb-1 mx-1 text-black">50.00 €</h1>
    </a> -->
    <?php
        foreach ($annunci as $key => $annuncio) {
            //var_dump($annuncio);
            echo view('advertisement/card', $annuncio);
        }
    ?>
</div>