<a href="<?=base_url()?>/annunci/scheda/<?=$annuncio_id?>" class="group">
    <img src="<?= (empty($path)?'/img/adv_images/no-image.jpg':'/'.$path) ?>" alt="<?=$titolo?>" class="w-full h-44 object-cover mb-3 rounded-xl border group-hover:cursor-pointer transition-all group-hover:scale-105 group-hover:shadow-lg group-hover:brightness-90 <?= $is_disponibile == "DISPONIBILE"?"":" brightness-50 group-hover:brightness-50" ?>">
    <h1 class="text-xl font-semibold mx-1"><?=(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $utente_venditore ? '<i class="fa-solid fa-user text-violet-500/50 text-md mr-2" title="un tuo annuncio"></i>':'') . $titolo?></h1>
    <h2 class="text-md font-semibold mt-0 mx-1 text-gray-400 capitalize"><?=$comune?>, <?=$provincia?>, <?=$regione?></h2>
    <h1 class="text-xl font-semibold mt-0 mb-1 mx-1 text-black"><?=$is_disponibile == "DISPONIBILE"?$prezzo." €":"NON DISPONIBILE"?> </h1>
</a>