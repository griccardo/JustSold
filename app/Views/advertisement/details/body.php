<div class="w-full flex flex-col md:flex-row">
    <div class="w-full md:w-1/2">
        <img id="main_img" src="<?= (empty($annuncio[0]['path'])?'/img/adv_images/no-image.jpg':'/'.$annuncio[0]['path']) ?>" alt="<?=$annuncio[0]['titolo']?>" class="w-full h-[20rem] md:h-[30rem] object-cover mb-3 rounded-xl border">
        <div class="w-full flex flex-nowrap overflow-x-auto scroll-smooth gap-2">
            <?php
                foreach ($annuncio as $key => $a) {
                    echo '<img onclick="changeimg(event);" src="'.(empty($a['path'])?'/img/adv_images/no-image.jpg':'/'.$a['path']).'" alt="'.$a['titolo'].'" class="hover:cursor-pointer transition-all hover:scale-105 hover:shadow-lg hover:brightness-90 w-12 md:w-28 h-12 md:h-28 object-cover mb-3 rounded-xl border">';
                }
            ?>
        </div>
    </div>
    <div class="w-full md:w-1/2 md:ml-4 p-3 flex flex-col">
        <h3 class="w-full text-gray-400">Pubblicato il <?=$annuncio[0]['data_pubblicazione']?></h3>
        <h1 class="text-xl sm:text-4xl font-bold mt-6"><?=$annuncio[0]['titolo']?></h1>
        <a href="<?=base_url()?>/annunci?categoria=<?=$annuncio[0]['categoria']?>" class="text-md font-semibold mt-6 block p-2 rounded-md bg-gray-200 text-gray-400 w-fit"><?=$annuncio[0]['categoria']?></a>
        <a class="text-lg font-semibold mt-6 text-gray-800 capitalize block" target="blank" href="https://www.google.it/maps?q=<?=$annuncio[0]['comune']?>, <?=$annuncio[0]['provincia']?>, <?=$annuncio[0]['regione']?>"><i class="fa-solid fa-location-dot mr-4"></i><?=$annuncio[0]['comune']?>, <?=$annuncio[0]['provincia']?>, <?=$annuncio[0]['regione']?></a>
        <div class="mt-auto mb-32">
            <h1 class="text-xl sm:text-4xl text-violet-500 font-bold mb-2 p-2 rounded-lg bg-violet-200 w-fit"><?=$annuncio[0]['prezzo']?> €</h1>
            <?php
                if(!isset($_SESSION['user_id']) || ($_SESSION['user_id'] != $annuncio[0]['utente_venditore'])){
                    echo '<a class="block mb-4 p-3 bg-violet-500 text-white w-fit text-2xl font-semibold rounded-lg hover:bg-violet-600 hover:shadow-md '. (isset($_SESSION['user_id']) ? '" href="mailto:'.$annuncio[0]['email_venditore'].'?subject=Annuncio '.$annuncio[0]['titolo'].'&body=Ciao, ti contatto perché sono interessato all\'annuncio '.$annuncio[0]['titolo'].' che hai pubblicato su JustSold, ..."':' cursor-not-allowed bg-violet-500/40 hover:bg-violet-500/40"'  ).' >Contatta il venditore</a>';
                }else{
                    
                    echo '<div class="flex"><a class="block mb-4 p-3 bg-slate-500 text-white w-fit text-2xl font-semibold rounded-lg hover:bg-slate-600 hover:shadow-md" href="'.base_url().'/annunci/disponibilita/'.$annuncio[0]['annuncio_id'].'" > imposta '.($annuncio[0]['is_disponibile']=="DISPONIBILE"?"non":"").' disponibile</a>';
                    echo '<a class="block mb-4 ml-2 w-auto p-3 bg-red-500 text-white w-fit text-2xl font-semibold rounded-lg hover:bg-red-600 hover:shadow-md" href="'.base_url().'/annunci/elimina/'.$annuncio[0]['annuncio_id'].'"><i class="fa-solid fa-trash mr-2"></i>elimina</a></div>';
                }
            ?>
            <h3 class="text-lg font-semibold  text-gray-800 capitalize block capitalize" ><i class="fa-solid fa-user-tie mr-4"></i><?=$annuncio[0]['nome_venditore']?></h3>
        </div>

    </div>
</div>
<div class="mt-4">
    
    <?php
        if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != $annuncio[0]['utente_venditore'])
        echo '<a class="block mb-8 mt-2 p-2 bg-red-400 text-white w-fit text-lg font-semibold rounded-lg hover:bg-red-500 hover:shadow-md' .
            (isset($_SESSION['user_id'])?'':' hidden ') . '" href="'.
            (is_null($annuncio[0]['preferito'])?base_url().'/annunci/aggiungipreferito/'.$annuncio[0]['annuncio_id'] : base_url().'/annunci/rimuovipreferito/'.$annuncio[0]['preferito']).
            '"><i class="fa-solid '.(is_null($annuncio[0]['preferito'])?'fa-heart':'fa-heart-circle-xmark').
            ' mr-2"></i>'.(is_null($annuncio[0]['preferito'])?"Aggiungi ai preferiti":"Rimuovi dai preferiti").
            '</a>';
    ?>

    <h1 class="text-gray-900 text-3xl mb-4 font-semibold">Informazioni sull'annuncio</h1>

    <h1 class="text-gray-900 text-xl mb-4"><?=$annuncio[0]['titolo']?></h1>
    <hr>

    <h2 class="text-gray-900 text-2xl font-semibold mb-2 mt-4">Descrizione</h2>
    <p class="text-gray-900 text-xl mb-4"><?=$annuncio[0]['descrizione']?></p>
    <hr>

    <h2 class="text-gray-900 text-2xl font-semibold mb-2 mt-4 ">Condizioni articolo</h2>
    <p class="text-gray-900 text-xl mb-4"><?=$annuncio[0]['condizioni']?></p>
    <hr>

    <h2 class="text-gray-900 text-2xl font-semibold mb-2 mt-4">Categoria articolo</h2>
    <p class="text-gray-900 text-xl mb-4"><?=$annuncio[0]['categoria']?></p>
    <hr>

    <h2 class="text-gray-900 text-2xl font-semibold mb-2 mt-4">Modalità consegna</h2>
    <p class="text-gray-900 text-xl mb-4"><?=
        ($annuncio[0]['is_spedibile']=="SPEDIBILE"?
            "Ritirabile a mano presso <span class='capitalize'>" . $annuncio[0]['comune'] .", " . $annuncio[0]['provincia'].", ". $annuncio[0]['regione'] ."</span> o spedibile (costo spedizione a carico dell'acquirente).":
            "Ritirabile solo a mano presso <span class='capitalize'>" . $annuncio[0]['comune'] .", " . $annuncio[0]['provincia'].", ". $annuncio[0]['regione'] .".</span> Spedizione non disponibile.")?>
    </p>


</div>